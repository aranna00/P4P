<?php
    
    /*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register web routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | contains the "web" middleware group. Now create something great!
    |
    */
    
    Route::get("login", "Auth\LoginController@showLoginForm")->name("login");
    Route::post("login", "Auth\LoginController@login");
    
    Route::get("getImage", "ImageController@getImage");
    
    Route::group(["middleware"=>"sentinel.auth"], function () {
        Route::post("logout", "Auth\LoginController@logout")->name("logout");
        Route::get('/', 'HomeController@index')->name('home');
        
        Route::get('/filter', 'ProductController@index')->name('producten');
        Route::get('/filter/{category}', 'ProductController@filtered')->name('filtered');
        Route::any("producten/ajax", "ProductController@filtered_products")->name("filter.ajax");
        
        Route::get('/product/{product_id}', 'ProductController@show')->name('product');
        
        Route::resource('/favorieten', 'WishlistController');
        Route::get('/favorieten/add/{product_id}/{wishlist_id}', 'WishlistController@add');
        Route::get('/favorieten/remove/{product_id}/{wishlist_id}', 'WishlistController@remove');
        
        Route::resource('/winkelwagen', 'CartController');
        
        Route::resource('/orders', 'OrderController');
        
        Route::get('/checkout', 'CheckoutController@index')->name('checkout');
        Route::post('/checkout', 'CheckoutController@checkout')->name('checkout');
        
        Route::get('/contact', 'ContactController@index')->name('contact');
        Route::group(["middleware"=>"sentinel.role:ceo,auth"], function () {
            Route::
        });
    });
