<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static whereHas(string $string, \Closure $param)
 */
class Category extends Model
{
    protected $fillable = [
        'name','name_en', 'image','is_hidden',
    ];
    protected $appends = [
        'image_path'
    ];

    //============== appends paths ===========

    //append img path

    public function getImagePathAttribute(): string
    {
        return asset('uploads/categories/'.$this->image);
    }

    public function sliders(){
        return $this->hasMany(Slider::class);
    }
    public function companies(){
        return $this->hasMany(Company::class);
    }
    public function subcategories(){
        return $this->hasMany(Subcategory::class);
    }
    public function products(){
        return $this->hasMany(Product::class);
    }
}
