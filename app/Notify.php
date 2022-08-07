<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notify extends Model
{
    protected $fillable = [
        'min_total',
        'min_unit',
        'from',
        'to',
        'store_id',
    ];
    public function notify_units(){
        return $this->hasMany(Notify_unit::class);
    }
    public function store(){
        return $this->belongsTo(Store::class);
    }
    public function notify_users(){
        return $this->hasMany(Notify_user::class);
    }
}
