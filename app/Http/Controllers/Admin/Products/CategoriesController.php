<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use App\Models\Products\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        return view('admin.product-categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = Category::create($request->all());

        return redirect(route('admin.product-categories.index'))
            ->with('success', 'Category created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param Category $productCategory
     * @return \Illuminate\Http\Response
     */
    public function show(Category $productCategory)
    {
        return view('admin.product-categories.show', ['category' => $productCategory]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $productCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $productCategory)
    {
        return view('admin.product-categories.edit', ['category' => $productCategory]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Category                 $productCategory
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Category $productCategory, Request $request)
    {
        $productCategory->update($request->all());

        return redirect(route('admin.product-categories.show', $productCategory))
            ->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $productCategory
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Category $productCategory)
    {
        $productCategory->delete();

        return redirect(route('admin.product-categories.index'))
            ->with('success', 'Category deleted successfully!');
    }
}
