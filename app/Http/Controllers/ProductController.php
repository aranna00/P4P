<?php

namespace App\Http\Controllers;

use App\AttributeGroup;
use App\Category;
use App\Product;
use Illuminate\Http\Request;
use function Sodium\add;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::whereNull("parent_id");
        $categories = $categories->get();

        $products = Product::all();
        $products->load("brand");

//        dd($products);

        return view('product.index', compact(["categories", "products"]));
    }

    /**
     * Display a listing of the resource.
     *
     * @param int $parent_id
     * @return \Illuminate\Http\Response
     */
    public function filtered($parent_id)
    {
        $categories = Category::whereParentId($parent_id);
        $categories = $categories->get();

        $parent = Category::find($parent_id);

        $products = $parent->products;

        $attribute_groups = AttributeGroup::all();

        $breadcrumbs = [[$parent->id,$parent->name]];
        while($parent->parent_id != null){
            $parent = $parent->parent;
            array_push($breadcrumbs,[$parent->id, $parent->name]);
        }

        return view('product', compact(["categories", "breadcrumbs", "products", "attribute_groups"]));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
}
