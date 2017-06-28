<?php
    
    namespace App\Http\Controllers;
    
    class BusinessController extends Controller
    {
        public function index()
        {
            /** @var \App\User $user */
            $user=\Sentinel::check();
            $business=$user->business;
            $businessUsers=$business->users;
            $orders=$business->orders()->paginate(10);
            $orders->load("user");
            
            return view("business.index", compact(["user", "business", "businessUsers", "orders"]));
        }
    }
