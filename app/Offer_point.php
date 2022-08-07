<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static where()
 */
class Offer_point extends Model
{
    protected $fillable = [
        'total',
        'points',
    ];

}
