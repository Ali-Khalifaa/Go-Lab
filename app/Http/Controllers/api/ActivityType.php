<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActivityType extends Controller
{
    function index (Request $request)
    {
        $lang = $request->header('lang');
        $data = [];
        if ($lang == 'ar')
        {
            $activities = \App\ActivityType::where('title','!=',null)->get(['id','title','img']);
            foreach ($activities as $index=>$activity)
            {
                $data[$index]['id'] =$activity->id;
                $data[$index]['title'] =$activity->title;
                $data[$index]['img'] =$activity->img;
                $data[$index]['image_path'] =$activity->image_path;
            }
        }else{
            $activities = \App\ActivityType::where('title_en','!=',null)->get(['id','title_en','img']);
            foreach ($activities as $index=>$activity)
            {
                $data[$index]['id'] =$activity->id;
                $data[$index]['title'] =$activity->title_en;
                $data[$index]['img'] =$activity->img;
                $data[$index]['image_path'] =$activity->image_path;
            }
        }

        return response()->json($data);
    }

    function getUserByActivety($id)
    {
        return 1;
    }
}
