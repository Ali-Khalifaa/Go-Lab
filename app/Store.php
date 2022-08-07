<?php

namespace App;

use App\Http\Resources\Products;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static findOrFail($id)
 */
class Store extends Authenticatable
{
    protected $guard = 'store';
    protected $fillable = [
        'name', 'section', 'address','email','password','store_keeper_id','accountant_id','store_finance_manager_id','finance'
    ];

    public function Section(){
        return $this->belongsTo('App\Areas','section');
    }

    public function products(){
        return $this->belongsToMany(Product::class);
    }
    public function place(){
        return $this->belongsTo(Place::class);
    }
    //get current store keeper
    public function store_keeper(){
        return $this->belongsTo(User::class ,'store_keeper_id');
    }
    //get current finance store
    public function store_finance_manager(){
        return $this->belongsTo(User::class ,'store_finance_manager_id');
    }
    // get all store keepers
    public function store_keepers(){
        return $this->hasMany(User::class,'keeper_id');
    }
    // get all finance manager
    public function finance_managers(){
        return $this->hasMany(User::class,'finance_manager');
    }
    // get all store managers
    public function store_managers(){
        return $this->hasMany(User::class,'manager_id');
    }
    // get all store sellers
    public function store_sellers(){
        return $this->hasMany(User::class,'seller_id');
    }
    public function accountant(){
        return $this->belongsTo(User::class ,'accountant_id');
    }
    public function infos(){
        return $this->hasMany(Info::class);
    }
    public function examinations(){
        return $this->hasMany(Examination::class);
    }
    public function orders(){
        return $this->hasMany(Order::class);
    }
    public function notify(){
        return $this->hasOne(Notify::class);
    }
    public function notify_users(){
        return $this->belongsToMany(Notify_user::class);
    }
    public function notify_total(){
        return $this->hasOne(Notify_total::class);
    }
    public function transfer(){
        return $this->hasMany(Transfer::class);
    }
    public function shifts(){
        return $this->hasMany(Shift::class);
    }
    public function finance_shifts(){
        return $this->hasMany(Finance_shift::class);
    }
    public function depts(){
        return $this->hasMany(Supplier_dept::class);
    }
    public function outs(){
        return $this->hasMany(Item::class);
    }
    public function ins(){
        return $this->hasMany(In_item::class);
    }
}
