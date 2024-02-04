<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    //index
    public function index()
    {
        $products = \App\Models\Product::paginate(5);
        return view('pages.product.index', compact('products'));
    }

    //create
    public function create()
    {
        $categories = \App\Models\Category::all();
        return view('pages.product.create', compact('categories'));
    }

    // edit
    public function edit($id)
    {
        $product = \App\Models\Product::find($id);
        $categories = \App\Models\Category::all();
        return view('pages.product.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = \App\Models\Product::find($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = (int) $request->price;
        $product->stock = (int) $request->stock;
        $product->category_id = $request->category_id;
        if ($request->image) {
            if (file_exists(public_path( 'img/products/' . basename($product->image)))) {
                unlink(public_path( 'img/products/' . basename($product->image)));
            }

            $filename = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path( 'img/products' ), $filename);
            $product->image = url('img/products/' . $filename);
        }
        $product->updated_at = now();
        $product->save();
        return redirect()->route('product.index');
    }

    // destroy
    public function destroy($id)
    {
        $product = \App\Models\Product::find($id);
        $product->delete();
        return redirect()->route('product.index');
    }

    //store
    public function store(Request $request)
    {
        $filename = time() . '.' . $request->image->extension();
        $request->image->storeAs('public/products', $filename);
        // $data = $request->all();

        $product = new \App\Models\Product;
        $product->name = $request->name;
        $product->price = (int) $request->price;
        $product->stock = (int) $request->stock;
        $product->category_id = $request->category_id;
        $product->image = $filename;
        $product->save();

        return redirect()->route('product.index');
    }
}
