<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notify_total extends Model
{
    protected $fillable = [
        'min_total',
        'min_unit',
        'from',
        'to',
        'percentage_total',
        'percentage_unit',
        'store_id',
    ];

    public function store(){
        return $this->belongsTo(Store::class);
    }
    public function products(){
        return $this->belongsToMany(Product::class);
    }
}
