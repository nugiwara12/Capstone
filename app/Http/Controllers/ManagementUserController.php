<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rules\Password;
// use App\Models\MatchOldPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Hash;

class ManagementUserController extends Controller
{
    public function index(Request $request)
    {
        if (!in_array(Auth::user()->role, ['admin'])) {
            abort(404); // Return a 404 error if user is unauthorized
        }
        // Get the search query if any
        $search = $request->input('search');
    
        // Get the per-page value (default to 10 if not provided)
        $entriesPerPage = $request->input('per_page', 10);
    
        // Query the users based on the search input
        $users = User::when($search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%')
                         ->orWhere('email', 'like', '%' . $search . '%')
                         ->orWhere('role', 'like', '%' . $search . '%');
        })
        ->paginate($entriesPerPage);
    
        // Pass the users, search query, and perPage value to the view
        return view('usermanagement.index', compact('users', 'search', 'entriesPerPage'));
    }      

    public function create()
    {
        if (!in_array(Auth::user()->role, ['admin'])) {
            abort(404); // Return a 404 error if user is unauthorized
        }
        return view('usermanagement.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'regex:/^[A-z a-z]+$/', 'string', 'max:255'],
            'role' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'digits:11'],
            'password' => 'required|confirmed',
            'description' => ['required', 'string', 'max:255'],
        ]);

        User::create([
            'name' => $validatedData['name'],
            'role' => $validatedData['role'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'password' => Hash::make($validatedData['password']),
            'description' => $validatedData['description'],
        ]);
 
        return redirect()->route('usermanagement')->with('success', 'User added successfully');
    }

    public function show(string $id)
    {
        $users = User::findOrFail($id);
  
        return view('usermanagement.show', compact('users'));
    }
    public function edit(string $id)
    {
        if (!in_array(Auth::user()->role, ['admin'])) {
            abort(404); // Return a 404 error if user is unauthorized
        }
        // Fetch a single user instance
        $user = User::findOrFail($id);
    
        // Pass the single user instance to the view
        return view('components.modal.usermanagement.edit', compact('user'));
    }
    
    public function update(Request $request, string $id)
    {
        if (!in_array(Auth::user()->role, ['admin'])) {
            abort(404); // Return a 404 error if user is unauthorized
        }
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => ['required', 'regex:/^[A-z a-z]+$/', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'digits:11'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id], // Ensure email is unique except for this user
            'description' => ['required', 'string', 'max:255'],
        ]);
    
        try {
            // Find the user by ID or fail
            $user = User::findOrFail($id);
    
            // Update the user's data with the validated data
            $user->update($validatedData);
    
            // Return success response
            return response()->json([
                'message' => 'User updated successfully.',
                'user' => $user,
            ], 200);
    
        } catch (\Exception $e) {
            // Return error response if something goes wrong
            return response()->json([
                'message' => 'Failed to update user.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }    

    public function destroy(string $id)
    {
        if (!in_array(Auth::user()->role, ['admin'])) {
            abort(404); // Return a 404 error if user is unauthorized
        }
        $users = User::findOrFail($id);
  
        $users->delete();
  
        return redirect()->route('usermanagement')->with('success', 'UserManagement deleted successfully');
    }
    public function activity(Request $request)
    {
        $entries = $request->input('entries', 10); // Default to 10 entries if none selected
        $activityLog = DB::table('activity_logs')->paginate($entries);
        
        return view('activity_log', compact('activityLog'));
    }
    
    public function changePasswordView()
    {
        return view('usermanagement.change_password');
    }
    
    public function changePasswordDB(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
   
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
        return redirect()->route('dashboard');
    }
}
