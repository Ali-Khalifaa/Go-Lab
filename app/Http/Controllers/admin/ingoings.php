<?php

namespace App\Http\Controllers\admin;

use App\Ingoing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Locker;
use App\Store;
use App\In_item;
use App\Revenue;
use Auth;

class ingoings extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $in_items = false;
        $ingoing = false;
        $id = $request->id;
        if (isset($request->id))
        {
            $ingoing = Ingoing::findOrFail($id);
            $ingoings = Ingoing::where('parent_id',$request->id)->get();
        }
        else
        {
            $ingoings = Ingoing::where('parent_id',0)->get();
        }
        $add_item = 0;
        if (empty($ingoings->first()) && isset($request->id))
        {
            $add_item = 1;
            $ingoing = Ingoing::findOrFail($id);
            $in_items = $ingoing->in_items;
        }
        return view('admin.ingoings.index',compact('ingoings','add_item','id','in_items','ingoing'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ingoings = Ingoing::all();
        return view('admin.ingoings.create',compact('ingoings'));
    }

    public function createItem($id)
    {
        $ingoings = Ingoing::all();
        $ingoing = Ingoing::findOrFail($id);
        $stores=Store::all();
        return view('admin.in_items.create',compact('ingoing','ingoings','stores'));
        // return view('admin.ingoings.create',compact('ingoings'));
    }

    public function storeItem(Request $request,$id)
    {
        $request->validate([
            'store_id' => 'required',
            'price' => 'required',
            'ingoing_id' => 'required',
            'name' => 'required',
        ]);
        $revenue = new Revenue();
        $revenue->price=$request->price;
        $revenue->foreign_id=$id;
        $revenue->save();

        $lockers = new Locker();
        $lockers->number=($request->price);
        $lockers->type=0;
        $lockers->foreign_id=$id;
        $lockers->user_id=Auth::user()->id;
        $lockers->store_id=$request->store_id;
        $lockers->category='general';
        $lockers->save();

        $item=new In_item();
        $item->price=$request->price;
        $item->name=$request->name;
        $item->store_id=$request->store_id;
        $item->finance_manager_id=Auth::user()->id;
        $item->ingoing_id=$id;
        $item->save();
        session()->flash('success',' تمت الاضافة بنجاح ');
        return back();
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
            'name'  =>  'required',
            'parent_id'  =>  'required',
            'is_daily'  =>  'required',
        ]);
        $ingoing  = new Ingoing($request->all());
        $ingoing->save();
        session()->flash('success',' تمت الاضافة بنجاح ');
        return redirect(route('ingoings.index'));
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
        $ingoing = Ingoing::findOrFail($id);
        $ingoings = Ingoing::all();
        return view('admin.ingoings.edit',compact('ingoing','ingoings'));
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
            'name'  =>  'required',
            'parent_id'  =>  'required',
            'is_daily'  =>  'required',
        ]);
        $ingoing = Ingoing::findOrFail($id);
        $ingoing->update($request->all());
        session()->flash('success',' تم التعديل بنجاح ');
        return redirect(route('ingoings.index'));
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
