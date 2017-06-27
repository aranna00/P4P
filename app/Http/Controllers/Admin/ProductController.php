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
        $brands=Brand::all();
        $categories=Category::select(['name', 'id', 'parent_id'])->orderBy('name', 'asc')->get();
        $brands_arr=[];
        $categories->load('children');
        foreach ($brands as $brand) {
            $brands_arr[$brand->id]=$brand->name;
        }
        asort($brands_arr);
        $brands_sel=[];
    
        if (isset($_REQUEST['brand'])) {
            $brands_sel[]=$_REQUEST['brand'];
        }
        natcasesort($brands_arr);
    
        return view('admin.products.create',
            ['brands'=>$brands_arr, 'categories'=>$categories, 'brands_sel'=>$brands_sel]);
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
     * @param  int $product
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product=Product::find($id);
        $brands=Brand::select(['name', 'id'])->orderBy('name', 'asc')->get();
        $categories=Category::select(['name', 'id', 'parent_id'])->orderBy('name', 'asc')->get();
        $categories->load('children');
        $brands_arr=[];
        $categories_sel=[];
        foreach ($brands as $brand) {
            $brands_arr[$brand->id]=$brand->name;
        }
        natcasesort($brands_arr);
        foreach ($product->categories as $category) {
            $categories_sel[]=$category->id;
        }
        $images=$product->images;
    
        return view('admin.products.edit', [
            'product'       =>$product,
            'brands'        =>$brands_arr,
            'categories'    =>$categories,
            'categories_sel'=>$categories_sel,
            "images"        =>$images
        ]);
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
