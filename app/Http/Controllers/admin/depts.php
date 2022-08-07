<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Dept;
use App\User;
use App\Order;

class depts extends Controller
{
    public function index()
    {
        $depts=Dept::all();

        return view('admin.depts.index',compact('depts'));
    }
    
    public function userDept($id){
        
        $depts=Dept::where('user_id',$id)->where('status',1)->get();
        return view('admin.depts.index',compact('depts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $depts= Dept::all();
        return view('admin.depts.create',compact('depts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $depts = new Dept();
        $depts->user_id = $request->user_id;
        $depts->order_id = $request->order_id;
        $depts->total = $request->total;
        $depts->paid = $request->paid;
        $depts->date = $request->date;
        $depts->discount = $request->discount;
        $depts->paytype = $request->paytype;
        $depts->save();
        return redirect('admin/depts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $depts= Dept::where('user_id' ,$id)->get();
        // $last = Dept::where('order_id' , 'order_id')->where('user_id' ,$id)->latest()->take(1)->get();
        return view('admin.depts.show',compact('depts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $depts= Dept::find($id);
        return view('admin.depts.edit',compact('depts'));
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
        $depts = Dept::find($id);
        if(!$depts->paid){
        $depts->user_id = $request->user_id;
        $depts->order_id = $request->order_id;
        $depts->total = $request->total;
        $depts->paid = $request->paid;
        $depts->date = $request->date;
        // $depts->discount = $request->discount;
        // $depts->paytype = $request->paytype;
        $depts->save();
    }
        else{
            $depts = new Dept();
            $depts->user_id = $request->user_id;
            $depts->order_id = $request->order_id;
            $depts->total = $request->total;
            $depts->paid = $request->paid;
            $depts->date = $request->date;
            // $depts->discount = $request->discount;
            // $depts->paytype = $request->paytype;
            $depts->save();
        }
        return redirect('admin/depts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $depts = Dept::destroy($id);
        return back();
    }
}
