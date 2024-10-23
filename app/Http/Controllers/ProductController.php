<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Models\Product;
use App\Models\Category;
use App\Models\Contact;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\activityLog;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function listSoldProducts()
    {
        $product = Product::where('item_sold', '>', 0)->get();

        return view('sales.products.index', compact('product'));
    }
    public function index(Request $request)
    {
        $query = Product::query();
        
        if ($request->filled('search')) {
            $searchTerm = '%' . $request->search . '%';
            
            $query->where(function ($q) use ($searchTerm) {
                $q->where('id', 'like', $searchTerm)                // Search by ID
                  ->orWhere('product_code', 'like', $searchTerm)   // Search by Product Code
                  ->orWhere('title', 'like', $searchTerm)           // Search by Title
                  ->orWhere('category', 'like', $searchTerm)        // Search by Category
                  ->orWhere('price', 'like', $searchTerm);          // Search by Price
            });
        }
        
        // Get only non-deleted products
        $products = $query->whereNull('deleted_at')->get();
    
        return view('products.index', compact('products'));
    }     

    // Display All Product in User page
    public function showProduct()
    {
        $featured = Product::where('featured', true)->get();
        $best_seller = Product::where('best_seller', true)->get();
        $category = Category::all();
        return view('welcome', compact('featured', 'best_seller', 'category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all();
        return view('products.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the input
        $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric',
            'product_code' => 'required|string|max:100',
            'description' => 'nullable|string',
            'category' => 'required|string|max:100',
            'quantity' => 'required|integer',
            'customizable' => 'required|boolean',
            'best_seller' => 'required|boolean',
            'featured' => 'required|boolean',
            'customization_width' => 'nullable|numeric|min:0|max:100',
            'customization_height' => 'nullable|numeric|min:0|max:100',
            'customization_top' => 'nullable|numeric|min:0|max:100',
            'customization_left' => 'nullable|numeric|min:0|max:100',
            'main_image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
            'img_gallery.*' => 'image|mimes:jpg,jpeg,png,gif|max:2048',
            'customizingImage' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'color' => 'nullable|string|max:50', // Add color validation
        ]);

        // Prepare data for storing
        $data = $request->all();

        // Process main image
        if ($request->hasFile('main_image')) {
            $mainImage = $request->file('main_image');
            $mainImageName = time() . '_main.' . $mainImage->getClientOriginalExtension();
            $mainImage->move(public_path('images'), $mainImageName);
            $data['main_image'] = $mainImageName;
        }

        // Process img_gallery (multiple images)
        if ($request->hasFile('img_gallery')) {
            $galleryImages = [];
            foreach ($request->file('img_gallery') as $galleryImage) {
                $galleryImageName = time() . '_' . uniqid() . '.' . $galleryImage->getClientOriginalExtension();
                $galleryImage->move(public_path('images'), $galleryImageName);
                $galleryImages[] = $galleryImageName;
            }
            $data['img_gallery'] = json_encode($galleryImages); // Store as JSON string in the database
        }

        // Process customizingImage
        if ($request->hasFile('customizingImage')) {
            $customizingImage = $request->file('customizingImage');
            $customizingImageName = time() . '_customizing.' . $customizingImage->getClientOriginalExtension();
            $customizingImage->move(public_path('images'), $customizingImageName);
            $data['customizing_image'] = $customizingImageName;
        }

        // Prepare additional customization fields, if they exist
        $data['canvas_width'] = $request->input('customization_width');
        $data['canvas_height'] = $request->input('customization_height');
        $data['canvas_top'] = $request->input('customization_top');
        $data['canvas_left'] = $request->input('customization_left');
        $data['customizable'] = $request->input('customizable', 0); // Defaults to 0 if not set
        $data['best_seller'] = $request->input('best_seller', 0);
        $data['featured'] = $request->input('featured', 0);

        // Include the color in the data array
        $data['color'] = $request->input('color', null); // Defaults to null if not provided

        $user = Auth::user();
        $name = $user->name;
        $email = $user->email;
        $dt = Carbon::now('Asia/Manila');
        $todayDate = $dt->toDayDateTimeString();

        $activityLog = [
            'name' => $name,
            'email' => $email,
            'description' => $name . ' added a new product',
            'date_time' => $todayDate,
        ];
        DB::table('activity_logs')->insert($activityLog);

        // Create the product with the image paths and other data
        Product::create($data);

        // Redirect with success message
        return redirect()->route('products')->with('success', 'Product added successfully');
    }

    // In ProductController
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'customizingImage' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        // Get the product
        $product = Product::findOrFail($request->product_id);

        // Prepare cart item
        $cartItem = [
            'product_id' => $product->id,
            'price' => $product->price,
            'name' => $product->name,
            'customizing_image' => null,
        ];

        // Handle customizing image
        if ($request->hasFile('customizingImage')) {
            $customizingImage = $request->file('customizingImage');
            $customizingImageName = time() . '_customizing.' . $customizingImage->getClientOriginalExtension();
            $customizingImage->move(public_path('images'), $customizingImageName);
            $cartItem['customizing_image'] = $customizingImageName;
        }

        // Assuming you have a cart session
        $cart = session()->get('cart', []);
        $cart[] = $cartItem;
        session()->put('cart', $cart);

        return response()->json(['message' => 'Product added to cart successfully!']);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        $category = Category::all();
        $product->img_gallery = json_decode($product->img_gallery);

        return view('products.show', compact('product', 'category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $category = Category::all();

        return view('products.edit', compact('product', 'category'));
    }

    // chatgpt new update function
    public function update(Request $request, $id)
    {
        // Find the product by ID
        $product = Product::findOrFail($id);

        // Validate the input including the image files and customization fields
        $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric',
            'product_code' => 'required|string|max:100',
            'description' => 'nullable|string',
            'category' => 'required|string|max:100',
            'quantity' => 'required|integer',
            'customizable' => 'required|boolean',
            'best_seller' => 'required|boolean',
            'featured' => 'required|boolean',
            'customization_width' => 'nullable|numeric|min:0|max:100',
            'customization_height' => 'nullable|numeric|min:0|max:100',
            'customization_top' => 'nullable|numeric|min:0|max:100',
            'customization_left' => 'nullable|numeric|min:0|max:100',
            'main_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'img_gallery.*' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'customizingImage' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'color' => 'nullable|string|max:50', // Add color validation
        ]);

        // Prepare data for updating
        $data = $request->all();

        // Process main image
        if ($request->hasFile('main_image')) {
            // Delete old main image if it exists
            if ($product->main_image) {
                unlink(public_path('images/' . $product->main_image)); // Deletes the old image
            }
            $mainImage = $request->file('main_image');
            $mainImageName = time() . '_main.' . $mainImage->getClientOriginalExtension();
            $mainImage->move(public_path('images'), $mainImageName);
            $data['main_image'] = $mainImageName;
        } else {
            // Keep the old main image
            $data['main_image'] = $product->main_image;
        }

        // Process img_gallery (multiple images)
        if ($request->hasFile('img_gallery')) {
            // Delete old gallery images if they exist
            if ($product->img_gallery) {
                $oldGalleryImages = json_decode($product->img_gallery);
                foreach ($oldGalleryImages as $oldImage) {
                    unlink(public_path('images/' . $oldImage)); // Deletes the old image
                }
            }

            $galleryImages = [];
            foreach ($request->file('img_gallery') as $galleryImage) {
                $galleryImageName = time() . '_' . uniqid() . '.' . $galleryImage->getClientOriginalExtension();
                $galleryImage->move(public_path('images'), $galleryImageName);
                $galleryImages[] = $galleryImageName;
            }
            $data['img_gallery'] = json_encode($galleryImages); // Store as JSON string in the database
        } else {
            // Keep the old gallery images
            $data['img_gallery'] = $product->img_gallery;
        }

        // Process customizingImage
        if ($request->hasFile('customizingImage')) {
            // Delete old customizing image if it exists
            if ($product->customizing_image) {
                unlink(public_path('images/' . $product->customizing_image)); // Deletes the old image
            }
            $customizingImage = $request->file('customizingImage');
            $customizingImageName = time() . '_customizing.' . $customizingImage->getClientOriginalExtension();
            $customizingImage->move(public_path('images'), $customizingImageName);
            $data['customizing_image'] = $customizingImageName;
        } else {
            // Keep the old customizing image
            $data['customizing_image'] = $product->customizing_image;
        }

        // Prepare additional customization fields, if they exist
        $data['canvas_width'] = $request->input('customization_width');
        $data['canvas_height'] = $request->input('customization_height');
        $data['canvas_top'] = $request->input('customization_top');
        $data['canvas_left'] = $request->input('customization_left');
        $data['customizable'] = $request->input('customizable', 0); // Defaults to 0 if not set
        $data['best_seller'] = $request->input('best_seller', 0);
        $data['featured'] = $request->input('featured', 0);

        // Include the color in the data array
        $data['color'] = $request->input('color', $product->color); // Defaults to old color if not provided

        // Update the product with the new data
        $product->update($data);

        // Redirect with success message
        return redirect()->route('products')->with('success', 'Product updated successfully');
    }

    public function bestSellers()
    {
        // Fetch best-selling products from the database
        $products = Product::where('best_seller', true)->get();

        // Return the view with the products data
        return view('user.best-seller', compact('products'));
    }

    public function featured()
    {
        // Fetch all best seller products
        $products = Product::where('featured', true)->get();

        // Return view with the products
        return view('user.featured', compact('products'));
    }
    public function shops()
    {
        // Fetch the products you want to display
        $products = Product::all(); // or any specific query you need

        // Pass the products to the view
        return view('user.productshop', compact('products')); // Replace 'your_view_name' with your actual view name
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Find the product by ID
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['error' => 'Unable to locate the product'], 404);
        }

        // Set the status to 0 (soft delete)
        $product->status = 0;
        $product->save();

        return response()->json(['id' => $id]);
    }

    public function restore($id)
    {
        $product = Product::findOrFail($id);
        
        // Check if the product is already marked as deleted
        if ($product->status === 0) {
            // Restore the product by setting the status back to 1
            $product->status = 1;
            $product->save();
        }

        return response()->json(['success' => true]);
    }
}
