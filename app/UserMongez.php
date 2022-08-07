<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserMongez extends Model
{
    protected $table = "user_mongez";

    protected $fillable = [
      'order_id',
      'user_id',
      'price',
      'km',
    ];

    public function orders(){
        return $this->belongsTo(Order::class,'order_id');
    }

    public function users(){
        return $this->belongsTo(User::class,'user_id');
    }
}
