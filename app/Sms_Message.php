<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sms_Message extends Model
{
    // protected $table = 'packages';
    protected $fillable =[
        'sender_id','user_name','password',
    ];

    // public function Products(){
    //     return $this->hasMany(PackageProducts::class,'package_id','id');
    // }


}