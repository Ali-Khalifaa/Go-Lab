<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notify_name extends Model
{
    protected $fillable = [
        'name'
    ];

    public function notify_name_units(){
        return $this->hasMany(Notify_name_unit::class);
    }
}
