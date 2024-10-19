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
        return view('usermanagement.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'regex:/^[A-z a-z]+$/', 'string', 'max:255'],
            'role' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => 'required|confirmed',
            'description' => ['required', 'string', 'max:255'],
        ]);

        User::create([
            'name' => $validatedData['name'],
            'role' => $validatedData['role'],
            'email' => $validatedData['email'],
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
        // Fetch a single user instance
        $user = User::findOrFail($id);
    
        // Pass the single user instance to the view
        return view('components.modal.usermanagement.edit', compact('user'));
    }
    
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'regex:/^[A-z a-z]+$/', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
        ]);
    
        $user = User::findOrFail($id);
        $user->update($validatedData);
    
        return response()->json([
            'message' => 'User updated successfully.',
            'user' => $user,
        ]);
    }

    public function destroy(string $id)
    {
        $users = User::findOrFail($id);
  
        $users->delete();
  
        return redirect()->route('usermanagement')->with('success', 'UserManagement deleted successfully');
    }
    public function activity()
    {
        $activityLog = DB::table('activity_logs')->get();
        return view ('activity_log', compact('activityLog'));
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
