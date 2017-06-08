<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Adress
 *
 * @property-read \App\Business $BillingBusiness
 * @property-read \App\Business $ShippingBusiness
 * @mixin \Eloquent
 * @property int $id
 * @property string $plaats
 * @property string $postcode
 * @property string $straat
 * @property string $straat_url
 * @property int $huisnummer
 * @property string $huisnummertoevoeging
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Address whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Address whereHuisnummer($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Address whereHuisnummertoevoeging($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Address whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Address wherePlaats($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Address wherePostcode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Address whereStraat($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Address whereStraatUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Address whereUpdatedAt($value)
 */
class Address extends Model
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
