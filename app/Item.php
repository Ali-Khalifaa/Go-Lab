<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, false|string $date)
 * @method static whereRaw(string $string, array $array)
 */
class Item extends Model
{
    protected $fillable = [
        'name',
        'date',
        'price',
        'is_confirmed',
        'finance_manager_id',
        'store_id',
        'outgoing_id',
    ];

    public function outgoing(){
        return $this->belongsTo(Outgoing::class);
    }
    public function store(){
        return $this->belongsTo(Store::class);
    }

}
