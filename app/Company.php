<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name'
        ,'name_en'
        ,'image'
        ,'is_hidden'
        ,'category_id'
        ,'company_field'
        ,'company_field_en'
        ,'discount_status'
        ,'percentage'
    ];

    protected $appends = [
        'image_path'
    ];

    //============== appends paths ===========

    //append img path

    public function getImagePathAttribute(): string
    {
        return asset('uploads/companies/'.$this->image);
    }

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }

    public function products()
    {
        return $this->hasMany('App\Product');
    }
}
