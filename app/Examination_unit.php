<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Examination_unit extends Model
{
    protected $fillable = [
        'receive',
        'recall',
        'quantity_before',
        'quantity_after',
        'production_date',
        'expiry_date',
        'is_confirmed',
        'store_keeper_id',
        'receipt_status_id',
        'return_reason_id',
        'product_id',
        'examination_id',
        'total_price',
    ];

    public function examination(){
        return $this->belongsTo(Examination::class);
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function receipt_status(){
        return $this->belongsTo(Receipt_status::class);
    }
    public function return_reason(){
        return $this->belongsTo(Return_reason::class);
    }
}
