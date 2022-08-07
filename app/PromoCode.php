<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{
    protected $table = "promo_code";

    protected $fillable = [
        'title','title_en','order_id','discount','discount_percent','end_date'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class,'order_id');
    }


}
