<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{
    public function filtering(Request $request)
    {
        // Get all categories
        $category = Category::all();
    
        // Fetch products based on selected categories
        $products = Product::when($request->input('category'), function ($query) use ($request) {
            return $query->whereIn('category', $request->input('category')); // Ensure 'category_id' exists in the products table
        }, function ($query) {
            return $query; // If no category is selected, return all products
        })->get();
    
        return view('shop', compact('products', 'category'));
    }
    

    

    public function index(Request $request)
    {
        // Determine how many entries to show per page
        $perPage = $request->input('per_page', 10); // Default to 10 if not specified
    
        // Get the search term
        $search = $request->input('search');
    
        // Retrieve categories with pagination and search functionality
        $categories = Category::when($search, function ($query, $search) {
            // Search for both category name and ID
            return $query->where(function($query) use ($search) {
                $query->where('category_name', 'like', '%' . $search . '%')
                      ->orWhere('id', $search); // Search by ID
            });
        })
        ->orderBy('created_at', 'DESC')
        ->paginate($perPage);
    
        return view('admin.category.index', compact('categories', 'search')); // Pass search to view
    }     

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'category_name' => 'required|string|max:255', // Validate the category name
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate the image
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $categoryImage = $request->file('image');
            $categoryImageName = time() . '_category.' . $categoryImage->getClientOriginalExtension();
            $categoryImage->move(public_path('images'), $categoryImageName);
            $validatedData['image'] = $categoryImageName;
        }

        // Create the category
        $category = Category::create($validatedData);

        // Return JSON response for Ajax
        return response()->json([
            'success' => true,
            'message' => 'Category added successfully!',
            'category' => $category
        ]);
    }

    public function show($id)
    {
        // Use findOrFail to handle invalid IDs
        try {
            $category = Category::findOrFail($id);
            return view('admin.category.show', compact('category'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Category not found');
        }
    }

    public function edit(string $id)
    {
        try {
            $category = Category::findOrFail($id);
            return view('admin.category.edit', compact('category'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Category not found');
        }
    }

    public function update(Request $request, string $id)
    {
        // Find the existing category
        try {
            $category = Category::findOrFail($id);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Category not found'], 404);
        }

        // Validate the incoming request
        $validatedData = $request->validate([
            'category_name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle new image upload
        if ($request->hasFile('image')) {
            if ($category->image) {
                $oldImagePath = public_path('images/' . $category->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $categoryImage = $request->file('image');
            $categoryImageName = time() . '_category.' . $categoryImage->getClientOriginalExtension();
            $categoryImage->move(public_path('images'), $categoryImageName);
            $validatedData['image'] = $categoryImageName;
        } else {
            $validatedData['image'] = $category->image;
        }

        // Update the category
        $category->update($validatedData);

        // Return JSON response for Ajax
        return response()->json([
            'success' => true,
            'message' => 'Category updated successfully!',
            'category' => $category
        ]);
    }

    public function destroy($id)
    {
        try {
            $category = Category::findOrFail($id);

            // Optionally delete the image associated with the category
            if ($category->image) {
                $imagePath = public_path('images/' . $category->image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            // Delete the category
            $category->delete();

            // Return JSON response for Ajax
            return response()->json([
                'success' => true,
                'message' => 'Category deleted successfully!',
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Category not found'], 404);
        }
    }
}
