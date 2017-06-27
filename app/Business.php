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
 * @property-read \App\Address                                         $billing
 * @property-read \App\Address                                         $shipping
 * @property string                                                    $kvk
 * @property int                                                       $relatie_nummer
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 * @method static \Illuminate\Database\Query\Builder|\App\Business whereKvk($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Business whereRelatieNummer($value)
 */
class Business extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function billing()
    {
        return $this->belongsTo(Address::class, "billing_address");
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shipping()
    {
        return $this->belongsTo(Address::class, "shipping_address");
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function orders(){
        return $this->hasManyThrough(Order::class, User::class);
    }
    
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
