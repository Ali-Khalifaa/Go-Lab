<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Direction extends Model
{
    protected $fillable = [
        'direction',
        'place_id',
    ];

    public function place(){
        return $this->belongsTo(Place::class);
    }
}
