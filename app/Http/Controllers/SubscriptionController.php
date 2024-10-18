<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Subscriber;

class SubscriptionController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request
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

        // Create a new subscriber record
        Subscriber::create([
            'email' => $request->input('email'),
        ]);

        // Return a JSON response indicating success
        return response()->json([
            'success' => true,
            'message' => 'You have successfully subscribed!',
        ]);
    }
}
