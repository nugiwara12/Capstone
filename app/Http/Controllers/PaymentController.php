<?php


namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'payment_method' => 'required|string|in:gcash,maya',
            'screenshot' => 'nullable|image|max:2048',
        ]);

        $screenshotPath = $request->file('screenshot') 
                          ? $request->file('screenshot')->store('screenshots', 'public') 
                          : null;

        Payment::create([
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'payment_method' => $request->input('payment_method'),
            'screenshot' => $screenshotPath,
        ]);

        return redirect()->route('thankyou')->with('success', 'Payment details submitted successfully!');
    }
}

