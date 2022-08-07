<?php

namespace App\Http\Controllers\admin;

use App\In_item;
use App\Ingoing;
use App\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class in_items extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
            'id'    =>  'required'
        ]);
        $store = Store::findOrFail($request->id);
        $in_goings = Ingoing::all();
        return view('admin.in_items.create',compact('store','in_goings'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name',
            'price',
            'ingoing_id',
            'store_id',
        ]);
        $in_item = new In_item($request->all());
        $in_item->date = now();
        $in_item->save();
        return redirect( route('store.finance_in', $request->store_id));
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
        $in_item = In_item::findOrFail($id);
        return view('admin.in_items.edit',compact('in_item'));
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
        $request->validate([
            'name',
            'price',
        ]);
        $in_item = In_item::findOrFail($id);
        $in_item->update($request->all());
        return redirect( url('admin/ingoings?id='.$in_item->ingoing->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $in_item = In_item::findOrFail($id);
        $id = $in_item->ingoing->id;
        $in_item->delete();
        return redirect( url('admin/ingoings?id='.$id));
    }
}
