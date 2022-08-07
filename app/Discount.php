<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $fillable = [
        'discount','end_discount','to_date','user_id','discount_type_id','order_id','immediately'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function discountType()
    {
        return $this->belongsTo(DiscountType::class,'discount_type_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class,'order_id');
    }
}
