<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class DashboardController extends Controller
{
    private function checkAuthorization(array $roles)
{
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'You need to be logged in to access this page');
    }

    $user = Auth::user();

    // Check if the user's role is in the allowed roles
    if (!in_array($user->role, $roles)) {
        return redirect()->route($user->role === 'Admin' ? 'dashboard' : 'seller_dashboard')
                         ->with('error', 'You do not have permission to access this page');
    }

    return $user; // Authorized user
}


    public function dashboard()
    {
        // Check authorization for admin
        $user = $this->checkAuthorization(['Admin']);
        if ($user instanceof \Illuminate\Http\RedirectResponse) {
            return $user; // Redirect if not authorized
        }

        return view('dashboard'); // Show the admin dashboard
    }

    public function sellerDashboard()
    {
        // Check authorization for seller
        $user = $this->checkAuthorization(['Seller']);
        if ($user instanceof \Illuminate\Http\RedirectResponse) {
            return $user; // Redirect if not authorized
        }

        // Gather order data if authorized
        $orders = Order::all();
        $total_revenue = $orders->sum('price');

        return view('seller_dashboard', compact('total_revenue')); // Show seller dashboard
    }
}
