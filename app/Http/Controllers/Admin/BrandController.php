<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Toastr;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::select(["id","name","description","created_at"])->paginate(8);
        
        return view("admin.brands.index",compact(["brands"]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.brands.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $brand = new Brand();
        $brand->name = $request->get("name");
        $brand->description = $request->get("description");
        $brand->save();
    
        Toastr::success("Het merk is succesvol aangemaakt");
    
        return Redirect::action("Admin\BrandController@index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
        
        return view("admin.brands.edit",compact(["brand"]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Brand  $brand
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $brand = Brand::findOrFail($id);
        $brand->name = $request->get("name");
        $brand->description = $request->get("description");
        $brand->save();
    
        Toastr::success("Het merk is succesvol bijgewerkt");
        
        return Redirect::action("Admin\BrandController@index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Brand  $brand
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $brand=Brand::find($id);
        if($brand==null){
            Toastr::error("Dit merk bestaat niet");
        }else{
            $brand->delete();
        
            Toastr::success("Het merk ". $brand->name ." is succesvol verwijderd");
        }
    
        return Redirect::action("Admin\BrandController@index");
    }
}
