<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    protected $table = "ads";

    protected $fillable = ['img'];

    protected $appends = [
        'image_path'
    ];

    //============== appends paths ===========

    //append img path

    public function getImagePathAttribute(): string
    {
        return asset('uploads/ads/'.$this->img);
    }
}
