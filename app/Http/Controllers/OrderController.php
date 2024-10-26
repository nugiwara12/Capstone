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
    
    public function index(Request $request) {
        if (!in_array(Auth::user()->role, ['admin', 'seller'])) {
            abort(404); // Return a 404 error if user is unauthorized
        }
        // Get the search query if available
        $search = $request->input('search');
    
        // Query the orders, applying search if necessary
        $orders = Order::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%")
                         ->orWhere('phone', 'like', "%{$search}%")
                         ->orWhere('product_title', 'like', "%{$search}%");
        })->orderBy('created_at', 'DESC')->paginate(10); // Adjust pagination limit as needed
    
        return view('order.index', compact('orders', 'search'));
    }    

    public function delivered(Request $request, $id) {
        return $this->updateOrderStatus($id, 'Delivered', $request);
    }

    public function shipped(Request $request, $id) {
        return $this->updateOrderStatus($id, 'Shipped', $request);
    }

    public function packed(Request $request, $id) {
        return $this->updateOrderStatus($id, 'Packed', $request);
    }

    public function preparing(Request $request, $id) {
        return $this->updateOrderStatus($id, 'Preparing', $request);
    }

    private function updateOrderStatus($id, $status, Request $request) {
        $order = Order::find($id);
        $order->delivery_status = $status;
        $order->save();

        // Send email to the buyer
        Mail::to($order->email)->send(new DeliveryStatusUpdated($order));

        return redirect()->back()->with('success', 'Delivery status updated to ' . $status . ' and email sent!');
    }

    public function delete($id) {
        $order = Order::findOrFail($id);
        $order->delete();
        
        return redirect()->back()->with('success', 'Order deleted successfully!');
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'payment_method' => 'required|string',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'email' => 'required|email',
            'product_title' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'price' => 'required|numeric',
            'screenshot' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Optional screenshot validation
        ]);
    
        // Handle file upload if a screenshot is provided
        $screenshotPath = null;
        if ($request->hasFile('screenshot')) {
            $screenshotPath = $request->file('screenshot')->store('uploads/gcash_screenshots', 'public');
        }
    
        // Create a new order record
        $order = new Order;
        $order->name = $validated['name'];
        $order->address = $validated['address'];
        $order->price = $validated['price'];
        $order->email = $validated['email'];
        $order->product_title = $validated['product_title'];
        $order->phone = $validated['phone'];
        $order->screenshot = $screenshotPath;
        $order->delivery_status = 'Pending';
        $order->save();
    
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Order submitted successfully!');
    }

    public function cardStore() {
        
    }
    
    public function placeOrder(Request $request) {
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
            $order->image = $item->image;
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
