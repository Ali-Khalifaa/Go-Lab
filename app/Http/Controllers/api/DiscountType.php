<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DiscountType extends Controller
{
    public function index(Request $request)
    {
        $lang = $request->header('lang');
        $data = [];
        if ($lang == 'ar')
        {
            $activities = \App\DiscountType::where('name','!=',null)->get(['id','name','from','to','immediately','postponed']);
            foreach ($activities as $index=>$activity)
            {
                $data[$index]['id'] =$activity->id;
                $data[$index]['name'] =$activity->name;
                $data[$index]['from'] =$activity->from;
                $data[$index]['to'] =$activity->to;
                $data[$index]['immediately'] =$activity->immediately;
                $data[$index]['postponed'] =$activity->postponed;
            }
        }else{
            $activities = \App\DiscountType::where('name_en','!=',null)->get(['id','name_en','from','to','immediately','postponed']);
            foreach ($activities as $index=>$activity)
            {
                $data[$index]['id'] =$activity->id;
                $data[$index]['name'] =$activity->name_en;
                $data[$index]['from'] =$activity->from;
                $data[$index]['to'] =$activity->to;
                $data[$index]['immediately'] =$activity->immediately;
                $data[$index]['postponed'] =$activity->postponed;
            }
        }

        return response()->json($data);
    }
}
