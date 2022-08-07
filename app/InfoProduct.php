<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static find(mixed $id)
 */
class InfoProduct extends Model
{

    protected $table='info_product';

    public function products(){
        return $this->belongsToMany(Product::class)->withPivot('store_id');
    }
    
    public function store(){
        return $this->belongsToMany(Store::class)->withPivot('store_id');
    }
    
    public function info_expirations(){
        return $this->hasMany(Info_Expiration::class , 'info_id');
    }
    




}
