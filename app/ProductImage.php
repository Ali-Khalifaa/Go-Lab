<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $fillable = [
        'img',
        'product_id',
    ];

    protected $appends = [
        'img_path'
    ];

    public function getImgPathAttribute()
    {
        return asset('uploads/product/images/'.$this->img);
    }

    public function product(){

        return $this->belongsTo(Product::class,'product_id');

    }
}
