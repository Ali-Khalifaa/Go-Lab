<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $fillable = [
        'place','place_en','store_id',
    ];

    public function store(){
        return $this->belongsTo(Store::class);
    }
    public function mandobs(){
        return $this->belongsToMany(Mandob::class);
    }
    public function directions(){
        return $this->hasMany(Direction::class);
    }
}
