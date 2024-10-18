<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\SendVerificationMailer;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth/register');
    }

    public function registerSave(Request $request)
    {
        Validator::make($request->all(), [
            'name' => ['required', 'regex:/^[A-z a-z]+$/', 'string', 'max:255'],
            'role' => 'required',
            'email' => ['required', 'regex:/^[A-z a-z 0-9 @_.]+$/', 'string', 'max:255', 'email', 'unique:users'],
            'password' => ['required', 'confirmed', Password::min(8)
                ->mixedCase()
                ->letters()
                ->numbers(1)
                ->uncompromised()],
            'password_confirmation' => 'required',
            'phone' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:11'], // Adjusted for 11-digit phone numbers
        ])->validate();

        User::create([
            'name' => $request->name,
            'role' => $request->role,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone, // Add phone field
            'level' => 'Admin',
        ]);

        return redirect()->route('dashboard');
    }

    public function login()
    {
        return view('auth/login');
    }

    public function loginAction(Request $request)
    {
        Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ])->validate();

        // Check login credentials
        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        $request->session()->regenerate();

        // Log activity after successful login
        $dt = Carbon::now('Asia/Manila');
        $todayDate = $dt->toDayDateTimeString();

        $activityLog = [
            'email' => $request->email,
            'description' => 'has logged in',
            'date_time' => $todayDate,
        ];
        DB::table('activity_logs')->insert($activityLog);

        return redirect()->route('dashboard'); // Redirect to the dashboard or desired page
    }

    public function logout(Request $request)
    {
        // Process activity log
        if (Auth::check()) {
            $user = Auth::user();
            $dt = Carbon::now('Asia/Manila');
            $todayDate = $dt->toDayDateTimeString();

            $activityLog = [
                'name' => $user->name,
                'email' => $user->email,
                'description' => 'Last logged out',
                'date_time' => $todayDate,
            ];
            DB::table('activity_logs')->insert($activityLog);
        }

        Auth::guard('web')->logout();
        $request->session()->invalidate();

        return redirect('login')->with('success', 'Successfully logged out');
    }

    public function profile()
    {
        return view('profile');
    }

    public function findUserToChangePass(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        // Inside your function/method
        Session::put('reset_email', $request->input('email'));
        Session::put('reset_otp_code', random_int(000000, 999999));
        Session::put('otp_expiration', Carbon::now()->addSecond(180));
        Mail::to(Session::get('reset_email'))->send(new SendVerificationMailer());

        return view('new-password');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:5|max:16|confirmed',
            'otp' => 'required',
        ]);
        
        $otp_expiration = Session::get('otp_expiration');

        if (Session::get('reset_otp_code') != $request->input('otp')) {
            return redirect('re-new-password')->with('failed', 'The OTP is invalid');
        } else if ($otp_expiration < Carbon::now()) {
            return redirect('re-new-password')->with('failed', 'The OTP is expired');
        } else if (Session::get('reset_otp_code') == $request->input('otp')) {
            $user = User::where('email', Session::get('reset_email'))->first();
            if ($user) {
                $user->password = Hash::make($request->input('password'));
                $user->save();
            } else {
                return redirect('login')->with('failed', 'We can\'t seem to find that user');
            }
            return redirect('login')->with('success', 'You changed your password successfully');
        } else {
            return redirect('re-new-password')->with('failed', 'Invalid OTP code');
        }
    }

    public function newPassword()
    {
        // Your logic for the /new-password route goes here
        if (!auth()->check()) {
            return redirect('/login')->with('error', 'You must be logged in to access this page.');
        }

        return view('new-password');
    }
}
