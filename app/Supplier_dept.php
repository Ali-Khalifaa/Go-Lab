<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier_dept extends Model
{
    protected $fillable = [
        'amount',
        'is_settlement',
        'examination_id',
        'supplier_id',
        'store_id',
    ];

    public function examination(){
        return $this->belongsTo(Examination::class);
    }
    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }
    public function store(){
        return $this->belongsTo(Store::class);
    }

}
