<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:categories,name',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if($request->hasFile('image')){
            $path = $request->file('image')->store('categories','public');
            $validated['image'] = $path;
        }

        Category::create($validated);
        return redirect()->route('admin.categories.index')->with('success','Category created');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => ['required','string','max:100', Rule::unique('categories','name')->ignore($category->id)],
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if($request->hasFile('image')){
            $path = $request->file('image')->store('categories','public');
            $validated['image'] = $path;
        }

        $category->update($validated);
        return redirect()->route('admin.categories.index')->with('success','Category updated');
    }

    public function destroy(Category $category)
    {
        // optionally delete image file
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success','Category deleted');
    }
}
