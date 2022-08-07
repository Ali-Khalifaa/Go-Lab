<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notify_user extends Model
{
    protected $fillable =[
        'user_id',
        'notify_id'
    ];

    public function notify(){
        return $this->belongsTo(Notify::class);
    }
    public function notify_user_units(){
        return $this->hasMany(Notify_user_unit::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
