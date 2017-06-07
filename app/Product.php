<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tax(){
        return $this->hasOne(Tax::class);
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories(){
        return $this->belongsToMany(Category::class);
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function brand(){
        return $this->hasOne(Brand::class);
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attributes(){
        return $this->hasMany(Attribute::class);
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function attributeGroups(){
        return $this->hasManyThrough(AttributeGroup::class,Attribute::class);
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function relatedProducts(){
        return $this->belongsToMany(Product::class,"related_products","related_product_id",'main_product_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function orders(){
        return $this->belongsToMany(Order::class);
    }
}
