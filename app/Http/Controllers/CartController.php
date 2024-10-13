<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
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

    public function add_to_cart(Request $request, $id)
    {
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'You cannot add to cart if you are not logged in');
    }
    $user= Auth::user();
    $product= Product::findOrFail($id);
    $cart = new Cart;
    $cart->user_id=$user->id;
    $cart->name=$user->name;
    $cart->email=$user->email;
    $cart->phone=$user->phone;
    $cart->product_id=$product->id;
    $cart->product_title=$product->title;
    $cart->price=$product->price;
    $cart->image=$product->main_image;

    $cart->quantity=$request->quantity;

    $cart->save();

    return redirect()->route('product-details',['id' => $id])->with('success', 'Product added to cart successfully');
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
