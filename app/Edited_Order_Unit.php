<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Edited_Order_Unit extends Model
{
    protected $fillable = [
        'quantity_total_after',
        'quantity_unit_after',
        'quantity_total_before',
        'quantity_unit_before',
        'order_unit_id',
        'product_id',
        'order_id',
        'user_id',
        'store_id',
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function order(){
        return $this->belongsTo(Order::class);
    }
    public function order_unit(){
        return $this->belongsTo(order_unit::class);
    }
    
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function store(){
        return $this->belongsTo(Store::class);
    }
}