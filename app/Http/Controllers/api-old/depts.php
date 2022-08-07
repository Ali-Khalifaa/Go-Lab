<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Dept;

class depts extends Controller
{
   

    public function index()
    {
        if (true) {
            return Dept::all();
        }
    }

    public function store(Request $request)
    {
        return Dept::create([
            'user_id' => $request['user_id'],
            'order_id' => $request['order_id'],
            'total' => $request['total'],
            'paid' => $request['paid'],
            'date' => $request['date'],
            'discount' => $request['discount'],
        ]);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user_id)
    {
        // if (true) {
            return Dept::where('user_id' ,$user_id)->get();
        // }
    }
    public function update(Request $request )
    {
      
    }
  


    public function destroy($id)
    {
        $order = Dept::find($id);
        $order->delete();
        return ['message' => 'order Deleted'];
    }
}
