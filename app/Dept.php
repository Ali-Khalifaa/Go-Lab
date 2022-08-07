<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, false|string $date)
 * @method static whereRaw(string $string, array $array)
 */
class Dept extends Model
{
    protected $fillable = [
        'user_id', 'order_id', 'total' ,'paid' ,'date','status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function order(){
        return $this->belongsTo(Order::class);
    }
}
