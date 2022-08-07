<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, false|string $date)
 * @method static whereRaw(string $string, array $array)
 */
class lose extends Model
{
    protected $fillable = [
        'loss',
        'order_id',
        'store_id',
    ];
    public function order(){
        return $this->belongsTo(Order::class);
    }
    public function store(){
        return $this->belongsTo(Store::class);
    }
}
