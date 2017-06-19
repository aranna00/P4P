<?php
    
    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;
    
    class BaseMigrations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wishlists', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name");
            $table->timestamps();
        });
    
    
        Schema::create('taxes', function (Blueprint $table) {
            $table->increments("id");
            $table->string("name");
            $table->float("value");
            $table->timestamps();
        });
    
    
        Schema::create('brands', function (Blueprint $table) {
            $table->increments("id");
            $table->string("name");
            $table->text("description")->nullable();
            $table->timestamps();
        });
        
        Schema::create('products', function (Blueprint $table) {
            $table->increments("id");
            $table->string("name");
            $table->text("description")->nullable();
            $table->string("code");
            $table->float("price");
            $table->date("available_from");
            $table->date("available_until")->nullable();
            $table->integer("coli")->default(1);
            $table->boolean("subtracts")->default(false);
            $table->integer("stock")->default(0);
            $table->boolean("active")->default(true);
            $table->integer("weight")->nullable();
            $table->integer("volume")->nullable();
            $table->float("statie_geld")->nullable();
            $table->unsignedInteger("tax_id")->index();
            $table->unsignedInteger("brand_id")->index();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign("tax_id")->references("id")->on("taxes");
            $table->foreign("brand_id")->references("id")->on("brands");
            
        });
        
        Schema::create('categories', function (Blueprint $table) {
            $table->increments("id");
            $table->string("name");
            $table->text("description")->nullalble();
            $table->unsignedInteger("parent_id")->index()->nullable();
            $table->foreign("parent_id")->references("id")->on("categories");
            $table->timestamps();
        });
        
        Schema::create('attribute_groups', function (Blueprint $table) {
            $table->increments("id");
            $table->string("name");
            $table->text("description")->nullalble();
            $table->timestamps();
        });
    
        Schema::create('attributes', function (Blueprint $table) {
            $table->increments("id");
            $table->string("name")->nullable();
            $table->string("value");
            $table->unsignedInteger("attribute_group_id")->index();
            $table->foreign("attribute_group_id")->references("id")->on("attribute_groups");
            $table->timestamps();
        });
    
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments("id");
            $table->string("plaats");
            $table->string("postcode");
            $table->string("straat");
            $table->string("straat_url");
            $table->integer("huisnummer");
            $table->string("huisnummertoevoeging")->nullable();
            $table->timestamps();
        });
        
        Schema::create('businesses', function (Blueprint $table) {
            $table->increments("id");
            $table->string("bestaandehandelsnaam");
            $table->string("dossiernummer")->index();
            $table->string("subdossiernummer")->index();
            $table->string("handelsnaam");
            $table->string("handelsnaam_url");
            $table->string("statutairehandelsnaam")->nullable();
            $table->unsignedInteger("billing_address")->index();
            $table->unsignedInteger("shipping_address")->index();
            $table->foreign("billing_address")->references("id")->on("addresses");
            $table->foreign("shipping_address")->references("id")->on("addresses");
            $table->timestamps();
        });
        
        Schema::create('orders', function (Blueprint $table) {
            $table->increments("id");
            $table->unsignedInteger("user_id")->index();
            $table->date("delivery");
            $table->boolean("processed")->default(false);
            $table->timestamps();
            $table->foreign("user_id")->references("id")->on("users");
        });
    
        Schema::create('images', function (Blueprint $table) {
            $table->increments("id");
            $table->string("url");
            $table->integer("imageable_id");
            $table->string("imageable_type");
            $table->timestamps();
        });
    
    
        Schema::create('orders_products', function (Blueprint $table) {
            $table->increments("id");
            $table->unsignedInteger("order_id")->index();
            $table->unsignedInteger("product_id")->index();
            $table->integer("amount");
            $table->foreign("order_id")->references("id")->on("orders");
            $table->foreign("product_id")->references("id")->on("products");
            $table->unique(["order_id",'product_id']);
            $table->timestamps();
        });
    
    
        Schema::create('cart', function (Blueprint $table) {
            $table->increments("id");
            $table->unsignedInteger("user_id")->index();
            $table->unsignedInteger("product_id")->index();
            $table->integer("amount");
            $table->foreign("user_id")->references("id")->on("users");
            $table->foreign("product_id")->references("id")->on("products");
            $table->unique(["user_id",'product_id']);
            $table->timestamps();
        });
    
        Schema::create('categories_products', function (Blueprint $table) {
            $table->increments("id");
            $table->unsignedInteger("category_id")->index();
            $table->unsignedInteger("product_id")->index();
            $table->foreign("category_id")->references("id")->on("categories");
            $table->foreign("product_id")->references("id")->on("products");
            $table->unique(["category_id",'product_id']);
            $table->timestamps();
        });
    
        Schema::create('users_wishlists', function (Blueprint $table) {
            $table->increments("id");
            $table->unsignedInteger("user_id")->index();
            $table->unsignedInteger("wishlist_id")->index();
            $table->foreign("user_id")->references("id")->on("users");
            $table->foreign("wishlist_id")->references("id")->on("wishlists");
            $table->timestamps();
            $table->unique(["user_id",'wishlist_id']);
        });
    
    
        Schema::create('products_wishlists', function (Blueprint $table) {
            $table->increments("id");
            $table->unsignedInteger("product_id")->index();
            $table->unsignedInteger("wishlist_id")->index();
            $table->foreign("product_id")->references("id")->on("products");
            $table->foreign("wishlist_id")->references("id")->on("wishlists");
            $table->unique(["wishlist_id",'product_id']);
            $table->timestamps();
        });
    
        Schema::create('products_attributes', function (Blueprint $table) {
            $table->increments("id");
            $table->unsignedInteger("attribute_id")->index();
            $table->unsignedInteger("product_id")->index();
            $table->foreign("attribute_id")->references("id")->on("attributes");
            $table->foreign("product_id")->references("id")->on("products");
            $table->unique(["attribute_id",'product_id']);
            $table->timestamps();
        });
    
    
        Schema::create('related_products', function (Blueprint $table) {
            $table->increments("id");
            $table->unsignedInteger("main_product_id")->index();
            $table->unsignedInteger("related_product_id")->index();
            $table->foreign("main_product_id")->references("id")->on("products");
            $table->foreign("related_product_id")->references("id")->on("products");
            $table->unique(["main_product_id",'related_product_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images');
    }
}
