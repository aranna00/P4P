<?php

namespace App\Http\Controllers;

use App\User;
use App\Wishlist;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class WishlistController extends Controller
{
    public function index()
    {
        $user = User::find(Sentinel::check()->getUserId());
        $wishlists = $user->wishlists;

        return view('wishlist.index', compact("wishlists"));
    }

    public function create()
    {
        return view('wishlist.create');
    }

    public function store(Request $request)
    {
        $wishlist = new Wishlist();
        $wishlist->name = $request->get("name");
        $wishlist->save();

        User::find(Sentinel::check()->getUserId())->wishlists()->attach($wishlist);

        //Toastr::success("De favorietenlijst is successvol aangemaakt");

        return Redirect::action("WishlistController@index");
    }

    public function show(Wishlist $wishlist)
    {
        //
    }

    public function edit($id)
    {
        $wishlist = Wishlist::findOrFail($id);

        return view('wishlist.edit', compact("wishlist"));
    }

    public function update(Request $request, $id)
    {
        $wishlist = Wishlist::findOrFail(($id));
        $wishlist->name = $request->get("name");
        $wishlist->save();

        //Toastr::success("De favorietenlijst is successvol bijgewerkt");

        return Redirect::action("WishlistController@index");
    }

    public function destroy($id)
    {
        $wishlist = Wishlist::findOrFail($id);

        User::find(Sentinel::check()->getUserId())->wishlists()->detach($wishlist);

        if ($wishlist != null){
            $wishlist->delete();

            //Toastr::success("De favorietenlijst ". $wishlist->name ." is successvol verwijderd");
        }

        return Redirect::action("WishlistController@index");
    }
}
