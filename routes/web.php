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
    
    
    Route::post("logout", "Auth\LoginController@logout")->name("logout");
    Route::get('/', 'HomeController@index')->name('home');

Route::get('/filter', 'ProductController@index')->name('product');

Route::get('/filter/{category}', 'ProductController@filtered')->name('filtered');

Route::resource('/favorieten', 'WishlistController');

Route::get('/favorieten/{product_id}/{wishlist_id}', 'WishlistController@add');

Route::resource('/winkelwagen', 'CartController');

Route::get('/contact', 'ContactController@index')->name('contact')->middleware('sentinel.auth');
