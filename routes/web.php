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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/producten', 'ProductController@index')->name('product');

Route::get('/producten/{category}', 'ProductController@filtered')->name('filtered');

Route::resource('/favorieten', 'WishlistController');

Route::get('/contact', 'ContactController@index')->name('contact');