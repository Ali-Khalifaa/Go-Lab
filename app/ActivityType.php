<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivityType extends Model
{
    protected $table='activity_types';

    protected $fillable = [
        'title',
        'title_en',
        'img'
    ];

    protected $appends = [
        'image_path'
    ];

    //============== appends paths ===========

    //append img path

    public function getImagePathAttribute(): string
    {
        return asset('uploads/activity-type/'.$this->img);
    }

}
