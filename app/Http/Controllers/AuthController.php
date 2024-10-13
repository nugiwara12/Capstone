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
use Exception;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use App\Models\activityLog;
use App\Models\Product;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth/register');
    }

    public function registerSave(Request $request)
    {
        Validator::make($request->all(), [
            'name' => ['required','regex:/^[A-z a-z]+$/','string','max:255'],
            'role' => 'required',
            'email' => ['required','regex:/^[A-z a-z 0-9 @_.]+$/','string','max:255','email','unique:users'],
            'password' => ['required', 'confirmed', Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers(1)
                    ->uncompromised(),
            'password_confirmation' => 'required',
            'phone' => ['required', 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:11'], // Adjusted for 11-digit phone numbers
            ],
        ])->validate();

        $user = User::create([
            'name' => $request->name,
            'role' => $request->role,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => 'Admin',
            'phone' => $request->phone, // Add phone field
        ]);

        Auth::login($user);

        if ($request->role === 'Admin') {
            return redirect()->route('dashboard');
        }
        else if ($request->role === 'User') {
            $product = Product::all();
            return redirect()->route('home');
        }

    }

    public function login()
    {
        return view('auth/login');
    }

    public function loginAction(Request $request)
    {
        Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ])->validate();

        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed')
            ]);
        }

        $request->session()->regenerate();

        $userRole = Auth::user()->role;

        // Redirect based on role
        if ($userRole === 'Admin') {
            return redirect()->route('dashboard'); // Admin dashboard
        } else if ($userRole === 'Seller') {
            return redirect()->route('seller_dashboard');
        } elseif ($userRole === 'User') {
            return redirect()->route('home'); // User dashboard
        }
    }

    public function logout(Request $request)
    {
        //process activity log
        $user = Auth::User();
        Session::put('user', $user);
        $user=Session::get('user');


        $name       = $user->name;
        $email      = $user->email;
        $dt         = Carbon::now('Asia/Manila');
        $todayDate  = $dt->toDayDateTimeString();

        $activityLog = [

            'name'        => $name,
            'email'       => $email,
            'description' => 'last log in and log out',
            'date_time'   => $todayDate,
        ];
        DB::table('activity_logs')->insert($activityLog);


        Auth::guard('web')->logout();

        $request->session()->invalidate();

        return redirect('login')->with('success','Successfully Log out');


    }

        //OTP notifications
    public function profile()
    {
        return view('profile');
    }
    public  function  findUserToChangePass(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        // Inside your function/method
        Session::put('reset_email', $request->input('email'));
        Session::put('reset_otp_code', random_int(000000,999999));
        Session::put('otp_expiration', Carbon::now()->addSecond(180));
        Mail::to(Session::get('reset_email'))->send(new SendVerificationMailer());

        return view('new-password');
    }
    public function resetPassword(Request $request){
        $request->validate([
            'password'=>'required | min:5 | max:16 | confirmed',
            'password_confirmation' => 'required',
            'otp'=>'required'
        ]);
        $otp_expiration = Session::get('otp_expiration');

        if(Session::get('reset_otp_code') != $request->input('otp')){
            return redirect('re-new-password')->with('failed','The otp is invalid');
        }
        else if($otp_expiration < Carbon::now()){
            return redirect('re-new-password')->with('failed','The otp is expired');

        }
        else if(Session::get('reset_otp_code') == $request->input('otp')){
            $selectedUser = new user;
            $user = user::where('email', Session::get('reset_email'))
                ->first();
        if($user){
            $user->password = $request->input('password');
            $user->save();
        }else{
            return redirect('login')->with('failed','We can\'t seem to find that user');

        }
            return redirect('login')->with('success','You changed your password successfully');
        }else{
            return redirect('re-new-password')->with('failed','Invalid OTP code');

        }


    }

    public function newPassword()
    {
        // Your logic for the /new-password route goes here
        if (!auth()->check()) {
            // Redirect to the login page if not authenticated
            return redirect('/login')->with('error', 'You must be logged in to access this page.');
        }

        // Retrieve the reset email from the session
        $resetEmail = Session::get('reset_password');

        // You can add more logic here based on your requirements

        // Example: Pass data to the view and render it
        return view('new-password', ['resetEmail' => $resetEmail]);
    }
}


