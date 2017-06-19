<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CheckoutController extends Controller
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

        if ($cart->count() == 0) {
            return \Redirect::action('CartController@index');
        }

        $business = $user->business;
        $shipping = $business->shipping;
        $billing = $business->billing;

        $total = $cart->map(function($item, $key){
            return $item->price * $item->pivot->amount;
        })->sum();

        $tax = $cart->map(function($item, $key){
            return $item->tax->value * $item->price * $item->pivot->amount / 100;
        })->sum();

        return view('checkout', compact('cart', 'total', 'tax', 'business', 'shipping', 'billing'));
    }

    public function checkout(Request $request)
    {
        /** @var User $user */
        $user = \Sentinel::check();

        $cart = $user->cart;

        // TODO: Still -2 hours...
        $date = date_create_from_format("d-m-Y", $request->get('date'), new \DateTimeZone("Europe/Amsterdam"));

        $order = new Order();
        $order->user_id = $user->id;
        $order->delivery = $date;
        $order->save();

        foreach ($cart as $product)
        {
            $order->products()->attach($product->id, ["amount" => $product->pivot->amount]);
        }

        $user->cart()->detach();

        return \Redirect::action("ProductController@index");
    }
}
