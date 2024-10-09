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
        Category::create($request->all());

        return redirect()->route('category')->with('success', 'Category added successfully');
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
