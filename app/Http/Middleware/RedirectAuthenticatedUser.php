<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RedirectAuthenticatedUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            // Redirect authenticated admin or seller users away from home
            if ($user->role === 'Admin') {
                // Session::flash('error', 'You are already logged in as an Admin.');
                return redirect()->route('dashboard');
            } elseif ($user->role === 'Seller') {
                Session::flash('error', 'You are already logged in as a Seller.');
                return redirect()->route('seller_dashboard');
            }
        }

        return $next($request);
    }
}
