<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart(){
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You cannot access the cart if you are not logged in');
        }
        $id = Auth::user()->id;
        $cart = Cart::where('user_id', $id)->get();
        return view('cart', compact('cart'));
    }
    // Show the product details
    public function show($id)
    {
        $product = Product::findOrFail($id);
        
        // Shuffle other products for "Customers Also Bought These" section
        $shuffle = Product::inRandomOrder()->take(4)->get(); // Adjust the count as needed

        return view('product-details', compact('product', 'shuffle'));
    }

    // Add product to cart
    public function addToCart(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to add items to the cart.');
        }

        $product = Product::findOrFail($id);

        // Create or update the cart entry
        Cart::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'product_id' => $product->id,
            ],
            [
                'name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'phone' => Auth::user()->phone,
                'product_title' => $product->title,
                'price' => $product->price,
                'image' => $product->main_image,
                'quantity' => $request->quantity,
            ]
        );

        return redirect()->route('product-details', ['id' => $id])->with('success', 'Product added to cart successfully');
    }
    public function checkout() {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You cannot access the checkout if you are not logged in');
        }

        $id = Auth::user()->id;
        $cart = Cart::where('user_id', $id)->get();

        // Check if the cart is empty
        if ($cart->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Your cart is empty. Please add items before checking out.');
        }

        return view('checkout', compact('cart'));
    }
    public function destroy(string $id)
    {
        $cart = cart::findOrFail($id);

        //Soft Delete
        $cart->delete();

        // Force Delete
        // $cart->forceDelete();

        return redirect()->back();
    }
}
