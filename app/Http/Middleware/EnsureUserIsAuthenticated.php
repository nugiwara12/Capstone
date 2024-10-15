<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class EnsureUserIsAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            Session::flash('error', 'You need to be logged in to access this page.');
            return redirect()->route('login');
        }

        // Allow access only for regular users (not Admin or Seller)
        if (Auth::user()->role !== 'User') {
            Session::flash('error', 'You do not have access to this page.');
            return redirect()->route('dashboard'); // or wherever you want to redirect them
        }

        return $next($request);
    }
}
