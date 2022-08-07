<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Ads extends Controller
{
    public function index()
    {
        $ads = \App\Ads::all();
        return response()->json($ads);
    }
}
