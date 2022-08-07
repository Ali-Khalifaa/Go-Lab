<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DefultMongez extends Model
{
    protected $table = "defult_mongez";

    protected $fillable = [
      'price',
      'time',
    ];

}
