<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::orderBy('created_at', 'DESC')->get();

        return view('admin.category.index', compact('category'));
    }
    public function create()
    {
        return view('admin.category.create');
    }
    public function store(Request $request)
    {
        // Validate the incoming request
        $data= $request->validate([
            'category_name' => 'required|string|max:255', // Assuming you're validating a name field
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate the image
        ]);

        if ($request->hasFile('image')) {
            $categoryImage = $request->file('image');
            $categoryImageName = time() . '_category.' . $categoryImage->getClientOriginalExtension();
            $categoryImage->move(public_path('images'), $categoryImageName);
            $data['image'] = $categoryImageName;
        }

        // Create the category with the image path if applicable
        Category::create($data);

        return redirect()->route('category')->with('success', 'Category added successfully');
    }

    // public function showCategory(){
    //     $category = Category::all();
    //     return view ('welcome', compact('category'));
    // }
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.show', compact('category'));
    }

    public function edit($id){
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        // Find the existing category
        $category = Category::findOrFail($id);

        // Validate the incoming request
        $data = $request->validate([
            'category_name' => 'required|string|max:255', // Assuming you're validating a name field
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate the image
        ]);

        // Check if a new image has been uploaded
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($category->image) {
                $oldImagePath = public_path('images/' . $category->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath); // Delete the old image file
                }
            }

            // Upload the new image
            $categoryImage = $request->file('image');
            $categoryImageName = time() . '_category.' . $categoryImage->getClientOriginalExtension();
            $categoryImage->move(public_path('images'), $categoryImageName);
            $data['image'] = $categoryImageName; // Set the new image name
        } else {
            // If no new image, keep the old image
            $data['image'] = $category->image;
        }

        // Update the category with the new data
        $category->update($data);

        return redirect()->route('category')->with('success', 'Category updated successfully');
    }

    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);

        //Soft Delete
        $category->delete();
        // Force Delete
        // $category->forceDelete();

        return redirect()->route('category')->with('success', 'Category deleted successfully');
    }

    //View all soft deleted category
    // public function restore(string $id)
    // {
    //     $category = Category::withTrashed()->findOrFail($id);
    //     $category->restore();
    //     return redirect()->route('');
    // }
}
