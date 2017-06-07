<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function billingAddress(){
        return $this->hasOne(Adress::class);
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function shippingAddress(){
        return $this->hasOne(Adress::class);
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function orders(){
        return $this->hasManyThrough(Order::class, User::class);
    }
}
