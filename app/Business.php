<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Business
 *
 * @property int                                                        $id
 * @property string                                                     $bestaandehandelsnaam
 * @property string                                                     $dossiernummer
 * @property string                                                     $subdossiernummer
 * @property string                                                     $handelsnaam
 * @property string                                                     $handelsnaam_url
 * @property string                                                     $statutairehandelsnaam
 * @property int                                                        $billing_address
 * @property int                                                        $shipping_address
 * @property \Carbon\Carbon                                             $created_at
 * @property \Carbon\Carbon                                             $updated_at
 * @property-read \App\Address                                          $billingAddress
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Order[] $orders
 * @property-read \App\Address                                          $shippingAddress
 * @method static \Illuminate\Database\Query\Builder|\App\Business whereBestaandehandelsnaam($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Business whereBillingAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Business whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Business whereDossiernummer($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Business whereHandelsnaam($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Business whereHandelsnaamUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Business whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Business whereShippingAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Business whereStatutairehandelsnaam($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Business whereSubdossiernummer($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Business whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Business extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function billingAddress(){
        return $this->hasOne(Address::class);
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function shippingAddress(){
        return $this->hasOne(Address::class);
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function orders(){
        return $this->hasManyThrough(Order::class, User::class);
    }
}
