<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageProducts extends Model
{
    protected $table ='package_products';
    protected $fillable=[
        'package_id',
        'product_id',

    ];

    public function Products(){
        return $this->belongsTo('App\Product','product_id','id');
    }
}
