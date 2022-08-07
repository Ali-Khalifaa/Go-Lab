<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Complaintproduct;
use Illuminate\Support\Facades\Validator;

class complaintsproducts extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (true) {
            return Complaintproduct::all();
        }
    }

    public function store(Request $request)
    {
        $validator =Validator::make($request->all(),[
            'user_id'    =>  'required|exists:users,id',
            'comment'    =>  'required|min:11',
            'product_id'    =>  'required||exists:products,id',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 'error',
                'success' => false,
                'error' =>
                    $validator->errors()->toArray()
            ], 400);
        }

        return Complaintproduct::create([
            'user_id' => $request['user_id'],
            'product_id' => $request['product_id'],
            'comment' => $request['comment'],
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
