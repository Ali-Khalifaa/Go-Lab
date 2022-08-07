<?php

namespace App;

use App\Http\Controllers\admin\user_notifies;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * @method static whereRoleIs(string $string)
 */
class User extends Authenticatable implements JWTSubject
{
    use LaratrustUserTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'role',
        'secound_phone',
         'image',
        'shop_name',
        'shop_type',
        'area',
        'place_id',
        'address',
        'location',
        'status',
        'token',
        'type',
        'keeper_id',
        'seller_id',
        'adder_id',
        'manager_id',
        'finance_manager',
        'work_time',
        'car_type',
        'points',
        'last_update',
        'updated_at',
        'active_type_id',
        'contact_time',
    ];
    protected $appends = [
        'phone','store_id', 'image_path'
    ];

    public function getImagePathAttribute(): string
    {
        return asset('images/'.$this->image);
    }

    public function getPhoneAttribute(){
        return '0'.$this->id;
    }

    public function getStoreIdAttribute(){
        //  dd($this->place);
         if($this->place!=null)
         {
             if($this->place->store_id!=null){
             return $this->place->store_id;
             }else{
                 return 0;
             }
         }else{
             return 0;
         }
    }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    // get current store in shift
    public function store(){
        return $this->hasOne(Store::class,'store_keeper_id');
    }
    // get current finance manager  in shift
    public function store_finance_manager(){
        return $this->hasOne(Store::class,'store_finance_manager_id');
    }
    // get the store he assigned to
    public function keeper_store(){
        return $this->belongsTo(Store::class,'keeper_id');
    }
    // get the store he assigned to
    public function seller_store(){
        return $this->belongsTo(Store::class,'seller_id');
    }
    public function manager_store(){
        return $this->belongsTo(Store::class,'manager_id');
    }
    public function finance_manager_store(){
        return $this->belongsTo(Store::class,'finance_manager');
    }
    public function manager_examinations(){
        return $this->hasMany(Examination::class,'manager_id');
    }
    public function store_accountant(){
        return $this->hasOne(Store::class,'accountant_id');
    }
    public function orders(){
        return $this->hasMany(Order::class,'user_id');
    }
    public function place(){
        return $this->belongsTo(Place::class);
    }
    public function notify_users(){
        return $this->hasMany(Notify_user::class);
    }
    public function depts(){
        return $this->hasMany(Dept::class);
    }
    public function adder(){
        return $this->belongsTo(User::class);
    }
    public function products(){
        return $this->belongsToMany(Product::class);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function discount()
    {
        return $this->hasMany(Discount::class,'user_id');
    }

    public function coupones(){
       return $this->belongsToMany(Coupone::class,'coupon_user','user_id','coupon_id','id','id');
    }



}
