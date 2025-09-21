<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{   
    public function index()
    {   
        $categories = Category::all();
        return response()->json($categories,200);
    }

    public function create(Request $request)
    {   
        $this->authorize('create', Category::class);
        $request->validate([
            'name' => 'required | string | unique:categories | max:255',
        ]);
        $category = Category::create([
            'name' => $request->name,
        ]);
        return response()->json([
            'message'=>'Category Created Successfully',
            'category'=> $category,
        ], 201) ;
    }

    public function show(Category $category)
    {   
        return response()->json($category, 200);
    }
    public function update(Request $request, Category $category)
    {   
        $this->authorize('update', $category);
        $request->validate(['required | string | unique:categories | max:255']);
        $category = Category::update([
            'name'=>$request->name
        ]);
        return response()->json([
            'message' => 'Category updated successfully',
            'category' => $category,
        ], 200);
    }

    public function destroy(Category $category)
    {
        $this->authorize('delete', $category);
        $category->delete();
        return response()->json([
            'message' => 'Category deleted successfully'
        ],200);
    }

    public function posts (Category $category)
    {
        $posts = $category->posts()->with('user')->latest()->paginate(12);
        return response()->json($posts,200);
    }
}

