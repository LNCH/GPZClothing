<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use App\Models\Products\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('admin.product-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.product-categories.create');
    }

    public function store(Request $request)
    {
        $category = Category::create($request->all());

        return redirect(route('admin.product-categories.index'))
            ->with('success', 'Category created successfully!');
    }

    public function show(Category $productCategory)
    {
        return view('admin.product-categories.show', ['category' => $productCategory]);
    }

    public function edit(Category $productCategory)
    {
        return view('admin.product-categories.edit', ['category' => $productCategory]);
    }

    public function update(Category $productCategory, Request $request)
    {
        $productCategory->update($request->all());

        return redirect(route('admin.product-categories.show', $productCategory))
            ->with('success', 'Category updated successfully!');
    }

    public function destroy(Category $productCategory)
    {
        $productCategory->delete();

        return redirect(route('admin.product-categories.index'))
            ->with('success', 'Category deleted successfully!');
    }
}
