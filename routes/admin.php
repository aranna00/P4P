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
        Route::group(["prefix"=>"klanten/kvk"], function () {
            Route::any("checkRegisterNumber",
                "BusinessController@checkRegisterNumber")->name("kvk.check.register.number");
            Route::any("getRegisterNumber", "BusinessController@getRegisterNumber")->name("kvk.get.register.number");
            Route::any("getFullRegisterInfo",
                "BusinessController@getFullRegisterInfo")->name("kvk.get.full.register.info");
        });
        Route::resource("categorieen","CategoryController");
        Route::resource("bestellingen", "OrderController");
        Route::get("bestellingen/open/producten", "OrderController@products")->name("order.open.products");
        Route::resource("gebruikers", "UserController");
        Route::resource("belastingen", "TaxController");
        Route::resource("eigenschappen","AttributeGroupController");
    });
