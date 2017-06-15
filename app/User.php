<?php

namespace App;

use Cartalyst\Sentinel\Users\EloquentUser;
use Illuminate\Notifications\Notifiable;


/**
 * App\User
 *
 * @property int                                                                                                            $id
 * @property string                                                                                                         $email
 * @property string                                                                                                         $password
 * @property array                                                                                                          $permissions
 * @property string                                                                                                         $last_login
 * @property string                                                                                                         $first_name
 * @property string                                                                                                         $last_name
 * @property int                                                                                                            $business_id
 * @property \Carbon\Carbon                                                                                                 $created_at
 * @property \Carbon\Carbon                                                                                                 $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Cartalyst\Sentinel\Activations\EloquentActivation[]             $activations
 * @property-read \App\Business                                                                                             $business
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Product[]                                                   $cart
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Order[]                                                     $orders
 * @property-read \Illuminate\Database\Eloquent\Collection|\Cartalyst\Sentinel\Persistences\EloquentPersistence[]           $persistences
 * @property-read \Illuminate\Database\Eloquent\Collection|\Cartalyst\Sentinel\Reminders\EloquentReminder[]                 $reminders
 * @property-read \Illuminate\Database\Eloquent\Collection|\Cartalyst\Sentinel\Roles\EloquentRole[]                         $roles
 * @property-read \Illuminate\Database\Eloquent\Collection|\Cartalyst\Sentinel\Throttling\EloquentThrottle[]                $throttle
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Wishlist[]                                                  $wishlists
 * @method static \Illuminate\Database\Query\Builder|\App\User whereBusinessId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereFirstName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereLastLogin($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereLastName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePermissions($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends EloquentUser
{
    use Notifiable;
    
    public $name;
    
    public function __construct(array $attributes=[])
    {
        $this->name=$this->first_name . " " . $this->last_name;
        parent::__construct($attributes);
    }
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable= [
        'name', 'email', 'password',
    ];
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden= [
        'password', 'remember_token',
    ];
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function business(){
        return $this->belongsTo(Business::class);
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function wishlists(){
        return $this->belongsToMany(Wishlist::class, "users_wishlists");
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders(){
        return $this->hasMany(Order::class);
    }
    
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function cart(){
        return $this->belongsToMany(Product::class, "cart")->withPivot("amount");
    }
    
}
