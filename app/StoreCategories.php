<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreCategories extends Model
{
   protected $table='store_categories';

   protected $fillable=['name','image','store_id'];
}
