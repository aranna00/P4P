<?php
    
    namespace App;
    
    use Carbon\Carbon;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;

    /**
 * App\Product
 *
 * @property int                                                                 $id
 * @property string                                                              $name
 * @property string                                                              $description
 * @property float                                                               $price
 * @property string                                                              $available_from
 * @property string                                                              $available_until
 * @property int                                                                 $coli
 * @property bool                                                                $subtracts
 * @property int                                                                 $stock
 * @property bool                                                                $active
 * @property int                                                                 $weight
 * @property int                                                                 $volume
 * @property float                                                               $statie_geld
 * @property int                                                                 $tax_id
 * @property int                                                                 $brand_id
 * @property \Carbon\Carbon                                                      $created_at
 * @property \Carbon\Carbon                                                      $updated_at
 * @property string                                                              $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\AttributeGroup[] $attributeGroups
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Attribute[]      $attributes
 * @property-read \App\Brand                                                     $brand
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Category[]       $categories
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Order[]          $orders
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Product[]        $relatedProducts
 * @property-read \App\Tax                                                       $tax
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereAvailableFrom($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereAvailableUntil($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereBrandId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereColi($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product wherePrice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereStatieGeld($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereStock($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereSubtracts($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereTaxId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereVolume($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereWeight($value)
 * @mixin \Eloquent
 */
    class Product extends Model
    {
        use SoftDeletes;
        
        /**
         * @return bool
         */
        public function isAvailable()
        {
            return ($this->available_from <= Carbon::now() && ($this->available_until > Carbon::now() || $this->available_until == null));
        }
        
        /**
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        public function tax()
        {
            return $this->belongsTo(Tax::class);
        }
        
        /**
         * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
         */
        public function categories()
        {
            return $this->belongsToMany(Category::class,"categories_products");
        }
        
        /**
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        public function brand()
        {
            return $this->belongsTo(Brand::class);
        }
        
        /**
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        public function attributes()
        {
            return $this->hasMany(Attribute::class);
        }
        
        /**
         * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
         */
        public function attributeGroups()
        {
            return $this->hasManyThrough(AttributeGroup::class, Attribute::class);
        }
        
        /**
         * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
         */
        public function relatedProducts()
        {
            return $this->belongsToMany(Product::class, "related_products", "related_product_id", 'main_product_id');
        }
        
        /**
         * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
         */
        public function orders()
        {
            return $this->belongsToMany(Order::class, "orders_products");
        }
    }
