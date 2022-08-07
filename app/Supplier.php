<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable =[
        'name','phone','address','s_togary',
        'is_active',
    ];

    public function depts(){
        return $this->hasMany(Supplier_dept::class);
    }
}
