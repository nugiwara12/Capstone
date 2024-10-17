<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $role
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            Session::flash('error', 'You need to be logged in to access this page.');
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Check if the user has the required role
        if (!$user->hasRole($role)) {
            Session::flash('error', 'You do not have permission to access this page.');

            // Redirect based on the user's role
            switch ($user->role) {
                case 'Admin':
                    return redirect()->route('dashboard');
                case 'Seller':
                    return redirect()->route('seller_dashboard');
                case 'User':
                    return redirect()->route('my_account');
                default:
                    return redirect()->route('home'); // Fallback for unknown roles
            }
        }

        return $next($request); // Authorized user
    }
}
