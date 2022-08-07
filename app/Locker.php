<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static find(mixed $id)
 */
class Locker extends Model
{
    protected $fillable = [
        'number',
        'type',
        'category',
        'foreign_id',
        'store_id',
        'user_id',

    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function store(){
        return $this->belongsTo(Store::class ,'store_id');
    }



}
