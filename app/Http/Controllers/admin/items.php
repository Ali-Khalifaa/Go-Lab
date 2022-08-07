<?php

namespace App\Http\Controllers\admin;

use App\Item;
use App\Outgoing;
use App\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class items extends Controller
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
        $out_goings = Outgoing::all();

        return view('admin.items.create',compact('store','out_goings'));
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
            'outgoing_id',
            'store_id',
        ]);
        $item = new Item($request->all());
        $item->date = now();
        $item->save();
        return redirect( route('store.finance_out', $request->store_id));
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
        $item = Item::findOrFail($id);
        return view('admin.items.edit',compact('item'));
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
        $item = Item::findOrFail($id);
        $item->update($request->all());
        return redirect( url('admin/outgoings?id='.$item->outgoing->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $id = $item->outgoing->id;
        $item->delete();
        return redirect( url('admin/outgoings?id='.$id));
    }
}
