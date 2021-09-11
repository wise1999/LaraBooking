<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::paginate(10);

        return view('admin.categories.index', compact('categories'));
    }

    public function create() {
        return view('admin.categories.create');
    }

    public function store(StoreCategoryRequest $request) {

        $validated = $request->validated();

        Category::create([
            'name' => $validated['name']
        ]);

        return redirect()->route('categories.index')->with('message', 'Category added.');
    }

    public function edit(Category $category) {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(StoreCategoryRequest $request, Category $category) {
        $validated = $request->validated();

        $category->update([
            'name' => $validated['name']
        ]);

        return redirect()->route('categories.index')->with('message', 'Category updated.');
    }

    public function destroy(Category $category) {
        $category->delete();

        return redirect()->back()->with('message', 'Category Has Been Deleted.');
    }
}
