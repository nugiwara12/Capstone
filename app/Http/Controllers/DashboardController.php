<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class DashboardController extends Controller
{
    public function dashboard() {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You need to be logged in to access this page');
        }

        $user = Auth::user(); // Get the authenticated user

        // Check if the user is not an admin
        if ($user->role !== 'Admin') {
            return redirect()->route('login')->with('error', 'You do not have permission to access this page');
        }

        return view('dashboard'); // User is admin, show the dashboard
    }

    public function sellerDashboard(){

        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You need to be logged in to access this page');
        }

        $user = Auth::user(); // Get the authenticated user

        // Check if the user is not an admin
        if ($user->role !== 'Seller') {
            return redirect()->route('login')->with('error', 'You do not have permission to access this page');
        }
        $orders = Order::all(); // Changed to $orders to avoid conflict
        $total_revenue = 0;

        foreach ($orders as $order) { // Loop through $orders
            $total_revenue += $order->price; // Accumulate the total revenue
        }
        return view('seller_dashboard', compact('total_revenue')); // User is admin, show the dashboard
    }


}
