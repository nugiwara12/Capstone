<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Order;


use Stripe;

class StripePaymentController extends Controller
{
    /**

     * success response method.

     *

     * @return \Illuminate\Http\Response

     */




     public function stripePost(Request $request)
     {
         Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

         // Validate incoming request data
         $validated = $request->validate([
             'first_name' => 'required|string|max:255',
             'last_name' => 'required|string|max:255',
             'address' => 'required|string|max:255',
             'province' => 'required|string',
             'city' => 'required|string',
             'barangay' => 'required|string',
             'stripeToken' => 'required', // Ensure the token is present
             'total_amount' => 'required|numeric', // Validate total amount
         ]);

         try {
             // Create a charge with Stripe
             Stripe\Charge::create([
                 "amount" => $validated['total_amount'] * 100, // Convert to cents
                 "currency" => "php",
                 "source" => $validated['stripeToken'],
                 "description" => "Order for " . $validated['first_name'] . ' ' . $validated['last_name'],
                 "statement_descriptor" => "GawangGamat", // Replace with your store name
             ]);

             $user = Auth::user();
             $userId = $user->id;

             // Retrieve cart items for the authenticated user
             $cartItems = Cart::where('user_id', $userId)->get();

             if ($cartItems->isEmpty()) {
                 Session::flash('error', 'Your cart is empty.');
                 return redirect()->back();
             }

             // Create orders for each item in the cart
             foreach ($cartItems as $item) {
                 $order = new Order();
                 $order->fill([
                     'user_id' => $userId,
                     'name' => $validated['first_name'] . ' ' . $validated['last_name'],
                     'email' => $user->email,
                     'phone' => $item->phone,
                     'product_id' => $item->product_id,
                     'product_title' => $item->product_title,
                     'price' => $item->price,
                     'image' => $item->image,
                     'quantity' => $item->quantity,
                     'payment_status' => 'Paid',
                     'delivery_status' => 'Pending',
                     'address' => $validated['address'],
                     'province' => $validated['province'],
                     'city' => $validated['city'],
                     'barangay' => $validated['barangay'],
                 ]);
                 $order->save();
             }

             // Clear the cart after placing the order
             Cart::where('user_id', $userId)->delete();

             Session::flash('success', 'Payment successful!');
             return redirect()->route('thank-you'); // Redirect to a specific route

         } catch (\Stripe\Exception\CardException $e) {
             Session::flash('error', 'Payment failed: ' . $e->getMessage());
             return redirect()->back();
         } catch (\Exception $e) {
             Session::flash('error', 'An error occurred: ' . $e->getMessage());
             return redirect()->back();
         }
     }


    // public function stripePost(Request $request, $value)

    // {

    //     Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));



    //     Stripe\Charge::create ([

    //             "amount" => $value * 100,

    //             "currency" => "php",

    //             "source" => $request->stripeToken,

    //             "description" => "Test payment successful"

    //     ]);

    //     $user = Auth::user();
    // $userId = $user->id;

    // // Validate incoming request data
    // $validated = $request->validate([
    //     'first_name' => 'required|string|max:255',
    //     'last_name' => 'required|string|max:255',
    //     'address' => 'required|string|max:255',
    //     'province' => 'required|string',
    //     'city' => 'required|string',
    //     'barangay' => 'required|string',
    // ]);

    // // Retrieve cart items for the authenticated user
    // $cartItems = Cart::where('user_id', $userId)->get();

    // // Create orders for each item in the cart
    // foreach ($cartItems as $item) {
    //     $order = new Order;
    //     $order->user_id = $userId; // Store user ID
    //     $order->name = $validated['first_name'] . ' ' . $validated['last_name']; // Combine first and last name
    //     $order->email = $user->email; // Assuming the email is from the authenticated user
    //     $order->phone = $item->phone; // Assuming phone is stored in the cart
    //     $order->product_id = $item->product_id;
    //     $order->product_title = $item->product_title;
    //     $order->price = $item->price;
    //     $order->image=$item->image;
    //     $order->quantity = $item->quantity;
    //     $order->payment_status = 'Paid'; // Update based on payment method if necessary
    //     $order->delivery_status = 'Pending';

    //     // You can add shipping address here if you want to store it with the order
    //     $order->address = $validated['address'];
    //     $order->province = $validated['province'];
    //     $order->city = $validated['city'];
    //     $order->barangay = $validated['barangay'];

    //     $order->save();
    // }

    // // Optionally, you can clear the cart after placing the order
    // Cart::where('user_id', $userId)->delete();


    //     Session::flash('success', 'Payment successful!');



    //     return redirect()->back();
    // }
}
