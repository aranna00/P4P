<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Tax
 *
 * @property int $id
 * @property string $name
 * @property float $value
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Product[] $products
 * @method static \Illuminate\Database\Query\Builder|\App\Tax whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Tax whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Tax whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Tax whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Tax whereValue($value)
 * @mixin \Eloquent
 */
class Tax extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products(){
        return $this->hasMany(Product::class);
    }
}
