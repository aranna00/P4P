<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Attribute
 *
 * @property int $id
 * @property string $name
 * @property string $value
 * @property int $attribute_group_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\AttributeGroup $attributeGroup
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Product[] $products
 * @method static \Illuminate\Database\Query\Builder|\App\Attribute whereAttributeGroupId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Attribute whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Attribute whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Attribute whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Attribute whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Attribute whereValue($value)
 * @mixin \Eloquent
 * @property int $product_id
 * @method static \Illuminate\Database\Query\Builder|\App\Attribute whereProductId($value)
 */
class Attribute extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function attributeGroup(){
        return $this->belongsTo(AttributeGroup::class);
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products(){
        return $this->belongsToMany(Product::class,"products_attributes");
    }
}
