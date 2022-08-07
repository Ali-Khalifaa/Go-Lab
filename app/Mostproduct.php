<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mostproduct extends Model
{
    protected $fillable = [
         'product_id', 'counter', 
    ];
    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
