<?php

namespace App\Http\Controllers;

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
//        $products = $products->get();

//        dd($products);

        return view('product', compact(["categories", "products"]));
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

        $breadcrumbs = [[$parent->id,$parent->name]];
        while($parent->parent_id != null){
            $parent = $parent->parent;
//            $breadcrumbs[$parent->id]=($parent->name);
            array_push($breadcrumbs,[$parent->id, $parent->name]);
        }

//        dd($breadcrumbs);

        return view('product', compact(["categories", "breadcrumbs"]));
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
