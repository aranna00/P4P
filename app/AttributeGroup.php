<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\AttributeGroup
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Attribute[] $attributes
 * @method static \Illuminate\Database\Query\Builder|\App\AttributeGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AttributeGroup whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AttributeGroup whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AttributeGroup whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AttributeGroup whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $type
 * @method static \Illuminate\Database\Query\Builder|\App\AttributeGroup whereType($value)
 */
class AttributeGroup extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attributes(){
        return $this->hasMany(Attribute::class);
    }
}
