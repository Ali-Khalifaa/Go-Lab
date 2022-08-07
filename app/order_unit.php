<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order_unit extends Model
{
    protected $fillable = [
        'quantity_total',
        'quantity_unit',
        'price',
        'price_unit',
        'buy_price',
        'additional_discount_price',
        'additional_discount_percentage',
        'qema_modafa',
        'return_status',
        'receive_total',
        'receive_unit',
        'recall_total',
        'recall_unit',
        'product_id',
        'order_id',
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function order(){
        return $this->belongsTo(Order::class,'order_id');
    }
}
