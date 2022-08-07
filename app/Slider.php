<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = [
        'image',
        'product_id',
        'category_id',
   ];

    protected $appends = [
        'image_path'
    ];

    //============== appends paths ===========

    //append img path

    public function getImagePathAttribute(): string
    {
        return asset('uploads/sliders/'.$this->image);
    }


    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
