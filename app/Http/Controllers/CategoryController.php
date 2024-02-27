<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    //index
    public function index()
    {
        $categories = DB::table('categories')->when(request()->name, function ($query, $name) {
            return $query->where('name', 'like', '%' . $name . '%');
        })->paginate(5);
        return view('pages.category.index', compact('categories'));
    }

    //create
    public function create()
    {
        return view('pages.category.create');
    }

    // store
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:100'
        ]);

        $category = \App\Models\Category::create($validated);
        return redirect()->route('category.index')->with('success', 'Category created successfully');
    }

    // delete
    public function destroy($id)
    {
        $category = \App\Models\Category::find($id);
        $category->delete();
        return redirect()->route('category.index')->with('success', 'Category deleted successfully');
    }

    // edit
    public function edit($id)
    {
        $category = \App\Models\Category::find($id);
        return view('pages.category.edit', compact('category'));
    }

    // update
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:100'
        ]);

        $category = \App\Models\Category::findOrFail($id);
        $category->update($validated);
        return redirect()->route('category.index')->with('success', 'Category updated successfully');
    }
}
