<?php

namespace App\Http\Controllers\api;

use App\Place;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class places extends Controller
{
    use ApiResponceTrait ;

    public function index(){

        $stores= Place::all();

        return  $this->ApiResponce($stores);

    }
}
