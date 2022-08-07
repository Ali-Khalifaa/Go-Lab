<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notify_unit extends Model
{
    protected $fillable =[
        'discount_total',
        'discount_unit',
        'now_total',
        'now_unit',
        'later_total',
        'later_unit',
        'product_id',
        'notify_id',
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
