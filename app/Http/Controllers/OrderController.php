<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\DeliveryStatusUpdated;

class OrderController extends Controller
{

    public function index(){
        $order = Order::orderBy('created_at', 'DESC')->get();
        return view('seller.order.index', compact('order'));
    }

    public function delivered(Request $request, $id)
{
    $order = Order::find($id);
    $order->delivery_status = "Delivered";
    $order->save();

    // Send email to the buyer
    Mail::to($order->email)->send(new DeliveryStatusUpdated($order));

    return redirect()->back()->with('success', 'Delivery status updated and email sent!');
}

    public function shipped($id) {
        $order = Order::findOrFail($id);
        $order->delivery_status = "Shipped";
        $order->save();

        return redirect()->back()->with('success', 'Order Delivery Status Updated successfully');
    }

    public function placeOrder(Request $request)
    {
    $user = Auth::user();
    $userId = $user->id;

    // Validate incoming request data
    $validated = $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'province' => 'required|string',
        'city' => 'required|string',
        'barangay' => 'required|string',
    ]);

    // Retrieve cart items for the authenticated user
    $cartItems = Cart::where('user_id', $userId)->get();

    // Create orders for each item in the cart
    foreach ($cartItems as $item) {
        $order = new Order;
        $order->user_id = $userId; // Store user ID
        $order->name = $validated['first_name'] . ' ' . $validated['last_name']; // Combine first and last name
        $order->email = $user->email; // Assuming the email is from the authenticated user
        $order->phone = $item->phone; // Assuming phone is stored in the cart
        $order->product_id = $item->product_id;
        $order->product_title = $item->product_title;
        $order->price = $item->price;
        $order->image=$item->image;
        $order->quantity = $item->quantity;
        $order->payment_status = 'Paid'; // Update based on payment method if necessary
        $order->delivery_status = 'Pending';

        // You can add shipping address here if you want to store it with the order
        $order->address = $validated['address'];
        $order->province = $validated['province'];
        $order->city = $validated['city'];
        $order->barangay = $validated['barangay'];

        $order->save();
    }

    // Optionally, you can clear the cart after placing the order
    Cart::where('user_id', $userId)->delete();

    return redirect()->route('cart')->with('success', 'Order placed successfully!');
}

}
