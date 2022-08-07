<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Previousorder;
use App\Product;
use Auth;
use File;
class previousorders extends Controller
{
    public function index()
    {
        $previousorders=Previousorder::all();
        $products=Product::all();
        return view('admin.previousorders.index',compact('previousorders','products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $orders=Order::all();
        $products=Product::all();

        return view('admin.orders.create',compact('orders','products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $orders = new Order();
        $orders->product_id = $request->product_id;
        $products=Product::where('id', $orders->product_id)->first();

        $orders->user_id = Auth::id();
        $orders->quantity = $request->quantity;
        $orders->discount = $products->discount * $request->quantity;
        $orders->price = $products->price * $request->quantity - $orders->discount;
        
        $orders->save();
        return redirect('admin/orders');
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
        $orders = Order::find($id);
        $products=Product::all();

        return view('admin.orders.edit',compact('orders','products'));
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
        $orders = Order::find($id);
        $orders->product_id = $request->product_id;
        $products=Product::where('id', $orders->product_id)->first();

        $orders->user_id = Auth::id();
        $orders->quantity = $request->quantity;
        $orders->discount = $products->discount * $request->quantity;
        $orders->price = $products->price * $request->quantity - $orders->discount;
        
        $orders->save();

        return redirect('admin/orders');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { 
        $orders = Order::destroy($id);
        return back(); //
    }
}
