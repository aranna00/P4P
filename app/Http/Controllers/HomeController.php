<?php

namespace App\Http\Controllers;

use App\Product;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('sentinel.auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $new = Product::where('available_from', '<', Carbon::now())->orderBy('available_from', 'desc')->limit(5)->orderBy('created_at', 'desc')->get();

        $featured = Product::where('featured', '=', '1')->limit(5)->get();

        return view('home', compact(['new','featured']));
    }
}
