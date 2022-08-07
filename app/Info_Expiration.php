<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static find(mixed $id)
 */
class Info_Expiration extends Model
{
    protected $fillable = [
        'quantity_total',
        'quantity_unit',
        'info_id',
        'store_id',
        'production_date',
        'expiry_date',

    ];



    public function infos(){
        return $this->belongsTo('App\Info','info_id');
    }
   
    public function store(){
        return $this->belongsTo('App\Store','store_id');
    }
 
    
  
    
  

}
