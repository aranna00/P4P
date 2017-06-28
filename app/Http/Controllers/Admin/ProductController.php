<?php

namespace App\Http\Controllers\ Admin;

use App\Brand;
use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use App\Tax;
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
        $categories = Category::select(['name', 'id', 'parent_id'])->orderBy('name', 'asc')->get();
        $brands_arr = [];
        $categories->load('children');
        foreach ($brands as $brand) {
            $brands_arr[$brand->id] = $brand->name;
        }
        asort($brands_arr);
        $brands_sel = [];

        if (isset($_REQUEST['brand'])) {
            $brands_sel[] = $_REQUEST['brand'];
        }
        natcasesort($brands_arr);

        $tax = Tax::all();

        return view('admin.products.create',
            ['brands' => $brands_arr, 'categories' => $categories, 'brands_sel' => $brands_sel, 'tax' => $tax]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $product = new Product();
        $product->name = $request->get("name");
        $product->code = $request->get("code");
        $product->featured = (bool)$request->get("featured");

        $product->brand_id = $request->get("brand");
        $product->description = $request->get("description");

        $product->coli = $request->get("coli");

        $product->active = (bool)$request->get("active");
        $product->price = $request->get("price");
        $product->statie_geld = $request->get("statie_geld");
        $product->stock = $request->get("stock");
        $product->tax_id = $request->get("tax");

        $product->weight = $request->get("weight");
        $product->volume = $request->get("volume");

        $product->available_from = date_create_from_format("d-m-Y", $request->get("available_from"), new \DateTimeZone("Europe/Amsterdam"));

        if ($request->get("available_until") != 0) {
            $product->available_until = date_create_from_format("d-m-Y", $request->get("available_until"), new \DateTimeZone("Europe/Amsterdam"));
        }

        $product->save();

        $product->categories()->sync($request->get("categories"));

        return redirect()->action("Admin\ProductController@index");
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
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $brands = Brand::select(['name', 'id'])->orderBy('name', 'asc')->get();
        $categories = Category::select(['name', 'id', 'parent_id'])->orderBy('name', 'asc')->get();
        $categories->load('children');
        $brands_arr = [];
        $categories_sel = [];
        foreach ($brands as $brand) {
            $brands_arr[$brand->id] = $brand->name;
        }
        natcasesort($brands_arr);
        foreach ($product->categories as $category) {
            $categories_sel[] = $category->id;
        }
        $images = $product->images;

        $tax = Tax::all();

        return view('admin.products.edit', [
            'product' => $product,
            'brands' => $brands_arr,
            'categories' => $categories,
            'categories_sel' => $categories_sel,
            "images" => $images,
            "tax" => $tax
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        /** @var Product $product */
        $product = Product::findOrFail($id);

        $product->name = $request->get("name");
        $product->code = $request->get("code");
        $product->featured = (bool)$request->get("featured");

        $product->brand_id = $request->get("brand");
        $product->description = $request->get("description");

        $product->coli = $request->get("coli");

        $product->active = (bool)$request->get("active");
        $product->price = $request->get("price");
        $product->statie_geld = $request->get("statie_geld");
        $product->stock = $request->get("stock");
        $product->tax_id = $request->get("tax");

        $product->weight = $request->get("weight");
        $product->volume = $request->get("volume");

//        dd($request->get("available_from"));

        // other format (Y-m-d)
        $product->available_from = date_create_from_format("d-m-Y", $request->get("available_from"), new \DateTimeZone("Europe/Amsterdam"));

        if ($request->get("available_until") != 0) {
            $product->available_until = date_create_from_format("d-m-Y", $request->get("available_until"), new \DateTimeZone("Europe/Amsterdam"));
        }

        $product->save();

        $product->categories()->sync($request->get("categories"));

        return redirect()->action("Admin\ProductController@index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->back();
    }

    public function featured($id){
        $product = Product::findOrFail($id);

        $product->featured = !$product->featured;

        $product->save();

        return redirect()->back();
    }
}
