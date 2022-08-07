<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class In extends Model
{
    protected $fillable = [
        'date',
        'order_id'
    ];

    public function order(){
        return $this->belongsTo(Order::class);
    }
}
