<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    protected $fillable = [
        'user_id', 'mandob_id', 'stage' ,'date' ,'order_id',
    ];
    
}
