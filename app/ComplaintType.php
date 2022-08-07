<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComplaintType extends Model
{
    protected $table = "complaint_types";

    protected $fillable = [
        "name","name_en"
    ];

//    relations

    public function complaint(){

        return $this->hasMany(Complaint::class,'complaint_type_id');

    }

}
