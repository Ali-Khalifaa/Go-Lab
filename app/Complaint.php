<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $fillable = [
        'user_id', 'comment', 'complaint_type_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function type()
    {
        return $this->belongsTo(ComplaintType::class,'complaint_type_id');
    }
}
