<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $table = 'packages';
    protected $fillable =[
        'name','price',
    ];

    public function Products(){
        return $this->hasMany(PackageProducts::class,'package_id','id');
    }


}
