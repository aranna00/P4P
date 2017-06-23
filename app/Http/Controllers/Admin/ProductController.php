<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with(["brand", "tax"])->paginate(8);
        
        return view("admin.products.index", compact("products"));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::all();
        $categories = Category::select(['name', 'id', 'parent_id'])->orderBy('name', 'asc')->get(); // ->where("visible","=",true)
        $categories_sel = $categories->load('children');


        return view('admin.products.create', ['brands'=>$brands, 'categories'=>$categories, 'categories_sel'=>$categories_sel]);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Product $product
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product $product
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Product             $product
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product $product
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
