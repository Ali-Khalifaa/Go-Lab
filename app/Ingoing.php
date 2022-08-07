<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingoing extends Model
{
    protected $fillable = [
        'name',
        'is_daily',
        'parent_id',
    ];

    public function parent(){
        return $this->belongsTo(Ingoing::class , 'parent_id');
    }
    public function in_items(){
        return $this->hasMany(In_item::class);
    }
}
