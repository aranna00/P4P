<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adress extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function BillingBusiness(){
        return $this->belongsTo(Business::class,"billing_address");
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ShippingBusiness(){
        return $this->belongsTo(Business::class,"shipping_address");
    }
}
