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
        if (!in_array(Auth::user()->role, ['admin', 'seller'])) {
            abort(404); // Return a 404 error if user is unauthorized
        }
        $product = Product::where('item_sold', '>', 0)->get();

        return view('components.sales.filter-date', compact('product'));
    }

    public function index(Request $request)
    {
        if (!in_array(Auth::user()->role, ['admin', 'seller'])) {
            abort(404); // Return a 404 error if user is unauthorized
        }
        $query = Product::query();
    
        if ($request->filled('search')) {
            $searchTerm = '%' . $request->search . '%';
    
            $query->where(function ($q) use ($searchTerm) {
                $q->where('id', 'like', $searchTerm)
                  ->orWhere('product_code', 'like', $searchTerm)
                  ->orWhere('title', 'like', $searchTerm)
                  ->orWhere('category', 'like', $searchTerm)
                  ->orWhere('price', 'like', $searchTerm);
            });
        }
    
        // Get only non-deleted products with pagination
        $perPage = $request->input('per_page', 10); // Default to 10 products per page
        $products = $query->whereNull('deleted_at')->paginate($perPage);
    
        // Calculate total products and sold products
        $totalProducts = Product::whereNull('deleted_at')->count();
        $soldProducts = Product::where('status', 'sold')->whereNull('deleted_at')->count(); // Adjust status as needed
    
        // Calculate percentage of sold products
        $percentageSold = $totalProducts > 0 ? ($soldProducts / $totalProducts) * 100 : 0;
    
        return view('products.index', compact('products', 'totalProducts', 'percentageSold'));
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
        if (!in_array(Auth::user()->role, ['admin', 'seller'])) {
            abort(404); // Return a 404 error if user is unauthorized
        }
        $category = Category::all();
        return view('products.create', compact('category'));
    }

    /**
     * Store a newly created resource in 
     * .
     */
    public function store(Request $request)
    {
        // Validate the input
        $validatedData = $request->validate([
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
            'variant_images.*' => 'image|mimes:jpg,jpeg,png,gif|max:2048', // Validate variant images
        ]);

        // Prepare data for storing
        $data = $validatedData;

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

        // Process variant images
        if ($request->hasFile('variant_images')) {
            $variantImages = [];
            foreach ($request->file('variant_images') as $variantImage) {
                $variantImageName = time() . '_' . uniqid() . '.' . $variantImage->getClientOriginalExtension();
                $variantImage->move(public_path('images'), $variantImageName);
                $variantImages[] = $variantImageName;
            }
            $data['variant_images'] = json_encode($variantImages); // Store as JSON string in the database
        }

        // Prepare additional customization fields, if they exist
        $data['canvas_width'] = $request->input('customization_width');
        $data['canvas_height'] = $request->input('customization_height');
        $data['canvas_top'] = $request->input('customization_top');
        $data['canvas_left'] = $request->input('customization_left');
        $data['customizable'] = $request->input('customizable', 0); // Defaults to 0 if not set
        $data['best_seller'] = $request->input('best_seller', 0);
        $data['featured'] = $request->input('featured', 0);

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
        if (!in_array(Auth::user()->role, ['admin', 'seller'])) {
            abort(404); // Return a 404 error if user is unauthorized
        }
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
        if (!in_array(Auth::user()->role, ['admin', 'seller'])) {
            abort(404); // Return a 404 error if user is unauthorized
        }
        $product = Product::findOrFail($id);
        $category = Category::all();

        return view('products.edit', compact('product', 'category'));
    }

    // chatgpt new update function
    public function update(Request $request, $id)
    {
        if (!in_array(Auth::user()->role, ['admin', 'seller'])) {
            abort(404); // Return a 404 error if user is unauthorized
        }
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
        return view('products.best-seller', compact('products'));
    }
    

    public function featured()
    {
        // Fetch all best seller products
        $products = Product::where('featured', true)->get();

        // Return view with the products
        return view('products.featured', compact('products'));
    }

    public function shop(Request $request) {
        // Get selected categories from the request
        $selectedCategories = $request->input('categories', []);
    
        // Load products with their associated category, filtering by selected categories if any
        $products = Product::with('category')
            ->when(!empty($selectedCategories), function ($query) use ($selectedCategories) {
                return $query->whereIn('category_id', $selectedCategories);
            })
            ->get();
    
        // Load all categories
        $categories = Category::all();
    
        // Debugging: Log products without categories
        foreach ($products as $product) {
            if (!$product->category) {
                \Log::info('Product without category:', ['product_id' => $product->id]);
            }
        }
    
        return view('shop', compact('products', 'categories'));
    }      
    
    public function filterProducts(Request $request)
    {
        $categoryIds = $request->get('categories', []);
    
        // Fetch products based on selected categories
        $products = Product::when($categoryIds, function ($query) use ($categoryIds) {
            return $query->whereIn('category_id', $categoryIds);
        })->get();
    
        return response()->json($products);
    }

    public function allProducts(Request $request)
    {
        $perPage = $request->input('per_page', 2); // Default to 2 products per page
        $products = Product::where('status', 1)->paginate($perPage);
    
        if ($request->ajax()) {
            return view('partials.products', compact('products'))->render();
        }
    
        return view('user.index', compact('products'));
    }    

    public function storingcustom(Request $request)
    {
        // Validate that the request contains 'img_gallery'
        $request->validate([
            'img_gallery' => 'required|string',
        ]);
    
        // Extract base64 image data
        $imageData = $request->input('img_gallery');
    
        // Remove 'data:image/png;base64,' from the string
        $img_gallery = str_replace('data:image/png;base64,', '', $imageData);
        $img_gallery = str_replace(' ', '+', $img_gallery);
    
        // Decode the base64 image
        $decodedImage = base64_decode($img_gallery);
        if ($decodedImage === false) {
            return response()->json(['success' => false, 'message' => 'Image decoding failed!'], 400);
        }
    
        // Create images directory if it doesn't exist
        if (!file_exists(public_path('images'))) {
            mkdir(public_path('images'), 0755, true);
        }
    
        // Save the image file in the 'public/images' directory
        $galleryImageName = 'image_' . time() . '.png';
        $imagePath = public_path('images/' . $galleryImageName);
        file_put_contents($imagePath, $decodedImage); // Save the decoded image to the file
    
        // Store the file path in the 'img_gallery' database table
        Product::create([
            'img_gallery' => 'images/' . $galleryImageName, // Store relative path
        ]);
    
        // Fetch all images for the gallery
        $images = Product::all(); // Assuming you have a Product model for img_gallery
    
        // Return a success response along with the images
        return response()->json(['success' => true, 'message' => 'Image saved successfully!', 'images' => $images]);
    }

    public function saveCustomization(Request $request)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'product_id' => 'required|integer',
            'customization.text' => 'required|string',
            'customization.images' => 'array', // Adjust validation based on your needs
            'customization.shapes' => 'array', // Adjust validation based on your needs
            'customization.backgroundColor' => 'required|string',
        ]);
    
        // Process the customization data
        try {
            // Assuming you have a model to save customization data
            $customization = new Customization();
            $customization->product_id = $validatedData['product_id'];
            $customization->text = $validatedData['customization']['text'];
            $customization->images = json_encode($validatedData['customization']['images']); // If needed, adjust based on your DB structure
            $customization->shapes = json_encode($validatedData['customization']['shapes']); // If needed, adjust based on your DB structure
            $customization->background_color = $validatedData['customization']['backgroundColor'];
            $customization->save();
    
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Customization save error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Unable to save customization.'], 500);
        }
    }
    // public function saveImage(Request $request) {
    //     $request->validate([
    //         'image' => 'required|string', // Validate the image data
    //         'product_code' => 'required|string', // Validate the product code
    //         'title' => 'required|string', // Validate the title
    //     ]);
    
    //     // Decode the base64 image data
    //     $dl_customize = $request->input('image');
    
    //     // Remove the 'data:image/png;base64,' part of the string
    //     $dl_customize = str_replace('data:image/png;base64,', '', $dl_customize);
    //     $dl_customize = str_replace(' ', '+', $dl_customize);
    
    //     // Decode to store the image in binary format
    //     $imageBinary = base64_decode($dl_customize);
    
    //     // Save image to products table
    //     DB::table('products')->insert([
    //         'dl_customize' => $imageBinary, // Store the image data
    //     ]);
    
    //     return response()->json(['success' => true]);
    // }
    
    
    
    
    
    
    
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
        if (!in_array(Auth::user()->role, ['admin', 'seller'])) {
            abort(404); // Return a 404 error if user is unauthorized
        }
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
