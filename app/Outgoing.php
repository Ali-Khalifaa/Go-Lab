<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Outgoing extends Model
{
    protected $fillable = [
        'name',
        'is_daily',
        'parent_id',
    ];

    public function parent(){
        return $this->belongsTo(Outgoing::class , 'parent_id');
    }
    public function items(){
        return $this->hasMany(Item::class);
    }
}
