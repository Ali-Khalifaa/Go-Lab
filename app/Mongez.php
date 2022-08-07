<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mongez extends Model
{
    protected $table = "mongez";

    protected $fillable = [
        'from','to','price','time'
    ];
}
