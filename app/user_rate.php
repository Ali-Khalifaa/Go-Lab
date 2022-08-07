<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user_rate extends Model
{
    protected $fillable = [
        'rate',
        'user_id',
        'order_id',
    ];
}
