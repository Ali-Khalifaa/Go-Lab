<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Previousorder;

class previousorders extends Controller
{
    public function index()
    {
        if (true) {
            return Previousorder::all();
        }
    }

    public function store(Request $request)
    {
        return Previousorder::create([
            'user_id' => $request['user_id'],
            'product_id' => $request['product_id'],
            'price' => $request['price'],
            'quantity' => $request['quantity'],
            'discount' => $request['discount'],
        ]);
    }
   
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
