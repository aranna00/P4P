<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Wishlist
 *
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Product[] $products
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 * @method static \Illuminate\Database\Query\Builder|\App\Wishlist whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Wishlist whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Wishlist whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Wishlist whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Wishlist extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users(){
        return $this->belongsToMany(User::class, "users_wishlists");
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products(){
        return $this->belongsToMany(Product::class,"products_wishlists");
    }
}
