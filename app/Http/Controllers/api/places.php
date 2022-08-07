<?php

namespace App\Http\Controllers\api;

use App\Place;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class places extends Controller
{
    use ApiResponceTrait ;

    public function index(Request $request){

        $lang = $request->header('lang');
        $data = [];
        if ($lang == 'ar')
        {
            $activities = \App\Place::where('place','!=',null)->get(['id','place','store_id']);
            foreach ($activities as $index=>$activity)
            {
                $data[$index]['id'] =$activity->id;
                $data[$index]['place'] =$activity->place;
                $data[$index]['store_id'] =$activity->store_id;

            }
        }else{
            $activities = \App\Place::where('place_en','!=',null)->get(['id','place_en','store_id']);
            foreach ($activities as $index=>$activity)
            {
                $data[$index]['id'] =$activity->id;
                $data[$index]['place'] =$activity->place_en;
                $data[$index]['store_id'] =$activity->store_id;

            }
        }

        return  $this->ApiResponce($data);
    }
}
