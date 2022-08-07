<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static find(mixed $id)
 */
class User_Point extends Model
{
    protected $table='user_points';
    protected $fillable = [
        'user_id',
        'order_id',
        'offer_points_id',
        'points',
    ];



    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
   
    public function order(){
        return $this->belongsTo('App\Store','order_id');
    }
    
    public function offer_point(){
        return $this->belongsTo('App\Offer_point','offer_points_id');
    }
 
    
  
    
  

}
