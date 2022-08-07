<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupone extends Model
{
    protected $table = "coupones";

    protected $fillable = [
        'title','code','percentage','end_date','title_en'
    ];

    public function users(){
        return $this->belongsToMany(User::class,'coupon_user','user_id','coupon_id','id','id');
    }
}
