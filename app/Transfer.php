<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    protected $fillable = [
        'from_id',
        'to_id',
    ];

    public function from_store(){
        return $this->belongsTo(Store::class , 'from_id', 'id' );
    }
    public function to_store(){
        return $this->belongsTo(Store::class, 'to_id', 'id' );
    }
    public function order(){
        return $this->hasOne(Order::class,'transfer_id');
    }
}
