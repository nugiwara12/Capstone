<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Order;
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

    public function my_account()
    {
        $id = Auth::id(); // Get the currently authenticated user's ID
        $order = Order::where('user_id', $id)->get();
        $orderCount = Order::where('user_id', $id)->count();
        $orderPendingCount = Order::where('user_id', $id)->where('delivery_status', 'Pending')->count();
        return view('my_account', compact('order', 'orderCount', 'orderPendingCount'));
    }

    public function thankYou(){
        return view('thank-you');
    }
    public function show($id)
    {
        $product= Product::findOrFail($id);
        $allproduct=Product::all();
        $shuffle= $allproduct->shuffle();
        return view('product-details', compact('product', 'shuffle'));
    }

    public function customize($id){
        $product=Product::findOrFail($id);
        return view('customize', compact('product'));
    }

}

