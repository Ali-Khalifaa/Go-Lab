<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Finance_shift extends Model
{
    protected $fillable = [
        'start_date',
        'end_date',
        'is_confirmed',
        'from_user_id',
        'to_user_id',
        'store_id',
    ];
    public function store(){
        return $this->belongsTo(Store::class);
    }
    public function from_user(){
        return $this->hasOne(User::class ,'id','from_user_id');
    }
    public function to_user(){
        return $this->hasOne(User::class ,'id','to_user_id');
    }
}
