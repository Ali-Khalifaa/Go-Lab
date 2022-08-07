<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Mandob extends Authenticatable implements JWTSubject
{
    use  Notifiable;
    protected $guard='man';
    protected $fillable = [
        'name', 'phone', 'address','password','wallet'
    ];

    protected $hidden = [
        'password'
    ];

    protected $appends = [
        'rate'
    ];

    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function places(){
        return $this->belongsToMany(Place::class);
    }

    public function rates(){
        return $this->hasMany(mondob_rate::class);
    }
    public function getRateAttribute(){
        $rates = $this->rates->toArray();
        $sum = array_sum(array_column($rates, 'rate'));
        $count= count($rates);
        return $count == 0 ? '---'  : round($sum/$count);
    }

    public function getJWTIdentifier()
        {
            return $this->getKey();
        }
    public function getJWTCustomClaims()
        {
            return [];
        }

}
