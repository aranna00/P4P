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
    
    Route::group(["prefix"=>"beheer", "namespace"=>"Admin", "middleware"=>"sentinel.role:admin,auth"], function () {
    
        Route::get('/', 'HomeController@index')->name('admin.home');
        Route::resource("producten","ProductController");
        Route::resource("merken","BrandController");
        Route::resource("klanten","BusinessController");
        Route::resource("categorieen","CategoryController");
        Route::resource("Bestellingen", "OrderController");
        Route::resource("gebruikers", "UserController");
        Route::resource("belastingen", "TaxController");
        Route::resource("eigenschappen","AttributeGroupController");
    });
