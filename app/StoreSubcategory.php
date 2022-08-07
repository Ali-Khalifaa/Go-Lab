<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreSubcategory extends Model
{
    protected $table='store_subcategory';

    protected $fillable=['name','image','store_id','category_id'];


    public function StoreCategory(){
        return $this->belongsTo('App\StoreCategories','category_id');
    }
}
