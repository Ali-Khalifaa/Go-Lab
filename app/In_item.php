<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, false|string $date)
 * @method static whereRaw(string $string, array $array)
 */
class In_item extends Model
{
    protected $fillable = [
        'name',
        'date',
        'price',
        'is_confirmed',
        'finance_manager_id',
        'store_id',
        'ingoing_id',
    ];

    public function ingoing(){
        return $this->belongsTo(Ingoing::class);
    }
    public function store(){
        return $this->belongsTo(Store::class);
    }
    public  function finance_manager(){
        return $this->belongsTo(User::class , 'finance_manager_id');
    }
}
