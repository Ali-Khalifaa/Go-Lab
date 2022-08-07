<?php

namespace App\Http\Controllers\api;

use App\DefultMongez;
use App\Mongez;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class MongezController extends Controller
{
    public function calcMongez (Request $request) {
        $validator = Validator::make($request->all(), [
            'km' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'success' => false,
                'error' => $validator->errors()->toArray()
            ], 400);
        }

        $data = [];

        $mongez = Mongez::where([
            ['from','<=',$request->km],
            ['to','>=',$request->km],
        ])->first();

        if ($mongez){

            $data['price'] = $mongez->price * $request->km;
            $data['total_hours'] = $mongez->time;

        }else{

            $difult = DefultMongez::first();
            $data['price'] = $difult->price * $request->km;
            $data['total_hours'] = $difult->time;

        }

        return response()->json($data);
    }
}
