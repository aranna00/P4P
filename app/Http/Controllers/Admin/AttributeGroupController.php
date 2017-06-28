<?php

namespace App\Http\Controllers\Admin;

use App\AttributeGroup;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Toastr;

class AttributeGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attributeGroups = AttributeGroup::with(["attributes"])->paginate(8);

        return view("admin.attributeGroups.index", compact("attributeGroups"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.attributeGroups.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $attributeGroup = new AttributeGroup();
        $attributeGroup->name = $request->get("name");
        $attributeGroup->description = $request->get("description");
        $attributeGroup->type = $request->get("type");
        $attributeGroup->save();

        Toastr::success("De producteigenschap is succesvol aangemaakt");

        return Redirect::action("Admin\AttributeGroupController@index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AttributeGroup $attributeGroup
     * @return \Illuminate\Http\Response
     */
    public function show(AttributeGroup $attributeGroup)
    {
//
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $attributeGroup = AttributeGroup::findOrFail($id);

        return view("admin.attributeGroups.edit", compact("attributeGroup"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $attributeGroup = AttributeGroup::findOrFail($id);
        $attributeGroup->name = $request->get("name");
        $attributeGroup->description = $request->get("description");
        $attributeGroup->save();

        Toastr::success("De producteigenschap is succesvol bijgewerkt");

        return Redirect::action("Admin\AttributeGroupController@index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $attributeGroup=AttributeGroup::find($id);
        if($attributeGroup==null){
            Toastr::error("Deze eigenschap bestaat niet");
        }else{
            $attributeGroup->delete();

            Toastr::success("De eigenschap ". $attributeGroup->name ." is succesvol verwijderd");
        }

        return Redirect::action("Admin\AttributeGroupController@index");
    }
}
