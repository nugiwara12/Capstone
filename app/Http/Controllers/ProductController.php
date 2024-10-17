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
    public function index()
    {
        $product = Product::orderBy('created_at', 'DESC')->get();

        return view('seller.products.index', compact('product'));
    }

    // Display All Product in User page
    public function showProduct()
    {
        $featured = Product::where('featured', true)->get();
        $best_seller = Product::where('best_seller', true)->get();
        $category=Category::all();
        return view('welcome', compact('featured', 'best_seller', 'category'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category =Category::all();
        return view('seller.products.create', compact('category'));
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
            'best_seller'=> 'required|boolean',
            'featured'=> 'required|boolean',
            'customization_width' => 'nullable|numeric|min:0|max:100',
            'customization_height' => 'nullable|numeric|min:0|max:100',
            'customization_top' => 'nullable|numeric|min:0|max:100',
            'customization_left' => 'nullable|numeric|min:0|max:100',
            'main_image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
            'img_gallery.*' => 'image|mimes:jpg,jpeg,png,gif|max:2048',
            'customizingImage' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
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

        $user=Auth::user();
        $name       = $user->name;
        $email      = $user->email;
        $dt         = Carbon::now('Asia/Manila');
        $todayDate  = $dt->toDayDateTimeString();

        $activityLog = [

            'name'        => $name,
            'email'       => $email,
            'description' => $name .' added a new product',
            'date_time'   => $todayDate,
        ];
        DB::table('activity_logs')->insert($activityLog);


        // Create the product with the image paths and other data
        Product::create($data);

        // Redirect with success message
        return redirect()->route('products')->with('success', 'Product added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        $category =Category::all();
        $product->img_gallery = json_decode($product->img_gallery);

        return view('seller.products.show', compact('product', 'category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $category =Category::all();

        return view('seller.products.edit', compact('product','category'));
    }

    /**
     * Update the specified resource in storage.
     */

    //  public function update(Request $request, string $id)
    //  {
    //      // Validate request
    //      $request->validate([
    //          'title' => 'required|string|max:255',
    //          'description' => 'required|string',
    //          'category' => 'required|string|exists:categories,category_name', // Validate by category name
    //          'quantity' => 'required|integer|min:1',
    //          'price' => 'required|numeric|min:0',
    //          'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Allow image to be nullable, restrict types and size
    //      ]);

    //      // Find product by id
    //      $product = Product::findOrFail($id);

    //      // Handle category validation and assignment
    //      $category = Category::where('category_name', $request->category)->firstOrFail();

    //      // Prepare data for update
    //      $data = [
    //          'title' => $request->title,
    //          'description' => $request->description,
    //          'category' => $request->category,
    //          'quantity' => $request->quantity,
    //          'price' => $request->price
    //      ];

    //      // If image is uploaded, handle the image and add to data array
    //      if ($request->hasFile('image')) {
    //          $image = $request->file('image');
    //          $imagename = time().'.'.$image->getClientOriginalExtension();
    //          $image->move(public_path('images'), $imagename);
    //          $data['image'] = $imagename;

    //          if ($product->image && file_exists(public_path('images/'.$product->image))) {
    //             unlink(public_path('images/'.$product->image)); // Deletes the old image
    //         }
    //      }

    //      // Update product with the data array
    //      $product->update($data);

    //      // Redirect back with success message
    //      return redirect()->route('products')->with('success', 'Product updated successfully');
    //  }


    //chatgpt new update function
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
    ]);

    // Prepare data for updating
    $data = $request->all();

    // Process main image
    if ($request->hasFile('main_image')) {
        // Delete old main image if it exists
        if ($product->main_image) {
            unlink(public_path('images/'.$product->main_image)); // Deletes the old image
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
                unlink(public_path('images/'.$oldImage)); // Deletes the old image
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
            unlink(public_path('images/'. $product->customizing_image)); // Deletes the old image
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
    $data['canvas_width'] = $request->input('customization_width', $product->canvas_width);
    $data['canvas_height'] = $request->input('customization_height', $product->canvas_height);
    $data['canvas_top'] = $request->input('customization_top', $product->canvas_top);
    $data['canvas_left'] = $request->input('customization_left', $product->canvas_left);
    $data['customizable'] = $request->input('customizable', $product->customizable);
    $data['best_seller'] = $request->input('best_seller', $product->best_seller);
    $data['featured'] = $request->input('featured', $product->featured);

        $user=Auth::user();
        $name       = $user->name;
        $email      = $user->email;
        $dt         = Carbon::now('Asia/Manila');
        $todayDate  = $dt->toDayDateTimeString();

        $activityLog = [

            'name'        => $name,
            'email'       => $email,
            'description' => $name .' updated a product '. $product->title,
            'date_time'   => $todayDate,
        ];
        DB::table('activity_logs')->insert($activityLog);

    // Update the product with the new data
    $product->update($data);

    // Redirect with success message
    return redirect()->route('products')->with('success', 'Product updated successfully');
}

    //  If the update function at the top fail
    // public function update(Request $request, string $id)
    // {
    //     $request->validate([
    //         'title' => 'required|string|max:255',
    //         'description' => 'required|string',
    //         'category' => 'required|string|exists:categories,category_name', // Validate by category name
    //         'quantity' => 'required|integer|min:1',
    //         'price' => 'required|numeric|min:0',
    //         'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Allow image to be nullable, restrict types and size
    //     ]);

    //     $product=product::find($id);
    //     $category = Category::where('category_name', $request->category)->firstOrFail();
    //     $product->title=$request->title;
    //     $product->description=$request->description;
    //     $product->category=$request->category;
    //     $product->quantity=$request->quantity;
    //     $product->price=$request->price;
    //     $image=$request->image;
    //     if ($image){
    //         $imagename=time().'.'.$image->getClientOriginalExtension();
    //         $request->image->move('product',$imagename);
    //         $product->image = $imagename;
    //     }
    //     $product->save();

    //     return redirect()->route('products')->with('success', 'Product updated successfully');


    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        $user=Auth::user();
        $name       = $user->name;
        $email      = $user->email;
        $dt         = Carbon::now('Asia/Manila');
        $todayDate  = $dt->toDayDateTimeString();

        $activityLog = [

            'name'        => $name,
            'email'       => $email,
            'description' => $name .' deleted a product '. $product->title,
            'date_time'   => $todayDate,
        ];
        DB::table('activity_logs')->insert($activityLog);

        //Soft Delete
        $product->delete();

        // Force Delete
        // $product->forceDelete();

        return redirect()->route('products')->with('success', 'Product deleted successfully');
    }

    //View all soft deleted product
    // public function restore(string $id)
    // {
    //     $product = Product::withTrashed()->findOrFail($id);
    //     $product->restore();
    //     return redirect()->route('');
    // }


}
