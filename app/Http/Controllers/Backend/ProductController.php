<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('backend.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('status',1)->select('name','id')->get();
        return view('backend.product.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // Product::storeProduct($request);

        // return back()->with('message','Product Added Successfully!');

        $request->validate([
            'category_id' => 'required',
            'name' => 'required | max:250',
            'price' => 'required | numeric | min:0 | not_in:0',
            'image' => 'image',
        ]);

        $image = $request->image;
        if($image){
            $path = 'product-images/';
            $imgName = 'product-image'.time().rand().'.'.$image->extension();
            $image->move($path,$imgName);
            $imgUrl = $path.$imgName;
        }

        Product::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'price' => $request->price,
            'desc' => $request->desc,
            'image' => $imgUrl
        ]);

        return back()->with('message','Product Added Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        return view('backend.product.edit',compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::find($id);
        $image = $request->image;
        if($image){
            if(file_exists($product->image)){
                unlink($product->image);
            }
            $path = 'product-images/';
            $imgName = 'product-image'.time().rand().'.'.$image->extension();
            $image->move($path,$imgName);
            $imgUrl = $path.$imgName;
        }

        $product->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'price' => $request->price,
            'desc' => $request->desc,
            'image' => $imgUrl
        ]);

        return to_route('products.index')->with('message','Product Updated Successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);

        if(file_exists($product->image)){
            unlink($product->image);
        }
        $product->delete();
        return back()->with('message','Product Deleted Successfully!');
    }
}
