<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Delivery;

class deliveries extends Controller
{
   

    public function index()
    {
        if (true) {
            return Delivery::all();
        }
    }

    public function store(Request $request)
    {
        return Delivery::create([
            'user_id' => $request['user_id'],
            'mandob_id' => $request['mandob_id'],
            'stage' => $request['stage'],
            'date' => $request['date'],
            'order_id' => $request['order_id'],
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
        // if (true) {
            return Delivery::find($id);
        // }
    }
    public function update(Request $request )
    {
        $order = Delivery::findOrFail($request->id);
        $order->user_id = $request->user_id;
        $order->mandob_id = $request->mandob_id;
        $order->stage = $request->stage;
        $order->order_id = $request->order_id;
        $order->date = $request->date;
        $order->save();
    }
  


    public function destroy($id)
    {
        $order = Delivery::find($id);
        $order->delete();
        return ['message' => 'order Deleted'];
    }
}
