<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $pageTitle = 'Category';
        $categories = Category::paginate(15);
        return view('category.index', compact('categories', 'pageTitle'));
    }

    public function store(CategoryRequest $request)
    {
        $category = Category::create([
            'name' => $request->name
        ]);

        if ($category) {
            return redirect()->back()->with('success', 'Operation Successful');
        }
        return redirect()->back()->with('errors', 'Operation failed');
    }

    public function show(Category $category)
    {
        if (!is_null($category)) {
            return response()->json([
                'status' => true,
                'data' => $category,
                'message' => 'success'
            ]);
        }

        return response()->json([
            'status' => false,
            'data' => $category,
            'message' => 'failed'
        ]);
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $update = Category::find($category->id)->update([
            'name' => $request->name
        ]);

        if ($update) {
            return redirect()->back()->with('success', 'Operation Successful');
        }
        return redirect()->back()->with('errors', 'Operation failed');
    }
}
