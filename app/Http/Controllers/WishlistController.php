<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\User;
use App\Wishlist;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /** @var User $user */
        $user = \Sentinel::check();
        $wishlists = $user->wishlists;

        return view('wishlist.index', compact("wishlists"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('wishlist.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        /** @var User $user */
        $user = \Sentinel::check();

        $wishlist = new Wishlist();
        $wishlist->name = $request->get("name");
        $wishlist->save();

        $user->wishlists()->attach($wishlist);
        \Toastr::success("De favorietenlijst is successvol aangemaakt");

        return \Redirect::action("WishlistController@index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $wishlist = Wishlist::findOrFail($id);

        return view('wishlist.edit', compact("wishlist"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $wishlist = Wishlist::findOrFail(($id));
        $wishlist->name = $request->get("name");
        $wishlist->save();

        if ($request->has("delete"))
        {
            $wishlist->products()->detach($request->get("delete"));
        }

        \Toastr::success("De favorietenlijst is successvol bijgewerkt");

        return \Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $wishlist = Wishlist::findOrFail($id);

        $wishlist->users()->detach();
        $wishlist->products()->detach();

        if ($wishlist != null) {
            $wishlist->delete();

            \Toastr::success("De favorietenlijst ". $wishlist->name ." is successvol verwijderd");
        }

        return \Redirect::action("WishlistController@index");
    }

    public function remove($product_id, $wishlist_id)
    {
        $wishlist = Wishlist::whereId($wishlist_id)->get()->first();

        $product = Product::whereId($product_id)->get()->first();

        if ($wishlist->products()->wherePivot("product_id", "=", $product_id)->count() > 0) {

            $wishlist->products()->detach($product_id);
            \Toastr::success($product->name . " is verwijderd uit " . $wishlist->name);
        } else {
            \Toastr::warning($product->name . " staat niet in " . $wishlist->name);
        }

        return \Redirect::back();
    }

    public function add($product_id, $wishlist_id)
    {

        $wishlist = Wishlist::whereId($wishlist_id)->get()->first();

        $product = Product::whereId($product_id)->get()->first();

        if ($wishlist->products()->wherePivot("product_id", "=", $product_id)->count() == 0) {

            $wishlist->products()->attach($product_id);
            \Toastr::success($product->name . " is toegevoegd aan " . $wishlist->name);
        } else {
            \Toastr::warning($product->name . " staat al in " . $wishlist->name);
        }

        return \Redirect::back();

    }
}
