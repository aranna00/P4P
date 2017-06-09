<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Brand
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Product[] $products
 * @method static \Illuminate\Database\Query\Builder|\App\Brand whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Brand whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Brand whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Brand whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Brand whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Brand extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products(){
        return $this->hasMany(Product::class);
    }
}
