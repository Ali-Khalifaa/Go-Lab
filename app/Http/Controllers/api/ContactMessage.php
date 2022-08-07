<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ContactMessage extends Controller
{
    public function addMessage(Request $request){
        $validator =Validator::make($request->all(),[
            'name'    =>  'required',
            'contact_type'    =>  'required',
            'message'    =>  'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 'error',
                'success' => false,
                'error' =>
                    $validator->errors()->toArray()
            ], 400);
        }

        \App\ContactMessage::create([
           'name' => $request->name,
           'contact_type' => $request->contact_type,
           'message' => $request->message,
        ]);

        return response()->json([
            'status' => 'success',
            'success' => true,
            'message' => 'successfully',
            'error' =>
                "0"
        ]);
    }
}
