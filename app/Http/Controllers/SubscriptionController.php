<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Subscriber;
use App\Mail\SendEmail;
use Illuminate\Support\Facades\Mail;

class SubscriptionController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request without checking for uniqueness
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        // Check for validation errors
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422); // Unprocessable Entity
        }

        // Create a new subscriber record (even if the email already exists)
        $subscriber = Subscriber::create([
            'email' => $request->input('email'),
        ]);

        // Send Thank You email
        Mail::to($subscriber->email)->send(new SendEmail($subscriber->email));

        // Return a JSON response indicating success
        return response()->json([
            'success' => true,
            'message' => 'You have successfully subscribed!',
        ]);
    }

    public function showThankYou()
    {
        return view('emails.subscription_confirmation');
    }
}
