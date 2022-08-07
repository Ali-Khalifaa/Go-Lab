<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Examination extends Model
{
    protected $fillable = [
        'store_id',
        'date_of_examination',
        'total',
        'delivery_price',
        'additional_price',
        'paid',
        'supplier_id',
        'manager_id',
        'is_received',
        'is_received_keeper',
        'keeper_id',
        'is_paid',
        'who_paid',
        'who_received',
    ];

    public function store(){
        return $this->belongsTo(Store::class);
    }
    public function examination_units(){
        return $this->hasMany(Examination_unit::class);
    }
    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }
    public function manager(){
        return $this->belongsTo(User::class,'manager_id');
    }
    public function dept(){
        return $this->hasOne(Supplier_dept::class);
    }

}
