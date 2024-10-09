<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ShopController extends Controller
{
    // Show the Shop Page
   public function shop()
   {
        $product = Product::all();
        $category = Category::all();
       return view('shop', (compact('product', 'category')));
   }

   public function aboutUs()
{
    return view('about_us');
}

    public function cart(){
        return view('cart');
    }

    public function checkout(){
        return view('checkout');
    }

    public function show($id)
    {
        $product= Product::findOrFail($id);
        return view('product-details', compact('product'));
    }

    public function add_to_cart(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        return redirect()->route('components.add-to-cart.cart')->with('success', 'Product added to cart successfully');
    }

}

