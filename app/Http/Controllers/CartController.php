<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class CartController extends Controller
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
        $cart = $user->cart;

        $total = $cart->map(function($item, $key){
            return $item->price * $item->pivot->amount;
        })->sum();

        return view('cart.index', compact('cart', 'total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $product = $request->get("id");
        $amount = $request->get("amount");

        /** @var User $user */
        $user = \Sentinel::check();

        // if product is already in cart, add the amount to it
        if ($user->cart()->wherePivot("product_id", "=", $product)->count() > 0)
        {
            $current_amount = $user->cart()->wherePivot("product_id", "=", $product)->get()->first()->pivot->amount;
//            dd($current_amount);
            $amount += $current_amount;
            $user->cart()->detach($product);
        }
        $user->cart()->attach($product, ["amount" => $amount]);
    
        return \Redirect::back();
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $product = $request->get("id");
        $amount = $request->get("amount");

        /** @var User $user */
        $user = \Sentinel::check();

        $user->cart()->detach($product);

        if ($amount > 0) {
            $user->cart()->attach($product, ["amount" => $amount]);
        }

        return \Redirect::action("CartController@index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
