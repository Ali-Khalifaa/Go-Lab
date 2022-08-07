<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mondob_rate extends Model
{
    protected $fillable = [
        'rate',
        'mandob_id',
        'order_id',
    ];
}
