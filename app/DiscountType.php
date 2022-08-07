<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiscountType extends Model
{
    protected $fillable = [
      'name','name_en','from','to','immediately','postponed'
    ];

    public function discount()
    {
        return $this->hasMany(Discount::class,'discount_type_id');
    }

}
