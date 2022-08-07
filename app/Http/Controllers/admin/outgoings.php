<?php

namespace App\Http\Controllers\admin;

use App\Outgoing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Locker;
use App\Store;
use App\Item;
use App\Expense;
use Auth;

class outgoings extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $items = false;
        $outgoing = false;

        $id = $request->id;
        if (isset($request->id))
        {
            $outgoing = Outgoing::findOrFail($id);
            $outgoings = Outgoing::where('parent_id',$request->id)->get();
        }
        else
        {
            $outgoings = Outgoing::where('parent_id',0)->get();
        }
        $add_item = 0;
        if (empty($outgoings->first()) && isset($request->id) )
        {
            $add_item = 1;
            $outgoing = Outgoing::findOrFail($id);
            $items = $outgoing->items;
        }
        return view('admin.outgoings.index',compact('outgoings','add_item','id','items','outgoing'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $outgoings = Outgoing::all();
        return view('admin.outgoings.create',compact('outgoings'));
    }

    public function createItem($id)
    {
        $outgoings = Outgoing::all();
        $outgoing = Outgoing::findOrFail($id);
        $stores=Store::all();
        return view('admin.items.create',compact('outgoing','outgoings','stores'));
        // return view('admin.ingoings.create',compact('ingoings'));
    }

    public function storeItem(Request $request,$id)
    {
        $request->validate([
            'store_id' => 'required',
            'price' => 'required',
            'outgoing_id' => 'required',
            'name' => 'required',
        ]);

        $expenses= new Expense();
        $expenses->price=$request->price;
        $expenses->foreign_id=$id;
        $expenses->save();


        $lockers = new Locker();
        $lockers->number=($request->price);
        $lockers->type=1;
        $lockers->foreign_id=$id;
        $lockers->user_id=Auth::user()->id;
        $lockers->store_id=$request->store_id;
        $lockers->category='general';
        $lockers->save();

        $item=new Item();
        $item->price=$request->price;
        $item->name=$request->name;
        $item->store_id=$request->store_id;
        $item->finance_manager_id=Auth::user()->id;
        $item->outgoing_id=$id;
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
        $outgoing  = new Outgoing($request->all());
        $outgoing->save();
        session()->flash('success',' تمت الاضافة بنجاح ');
        return redirect(route('outgoings.index'));
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
        $outgoing = Outgoing::findOrFail($id);
        $outgoings = Outgoing::all();
        return view('admin.outgoings.edit',compact('outgoing','outgoings'));
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
        $outgoing = Outgoing::findOrFail($id);
        $outgoing->update($request->all());
        session()->flash('success',' تم التعديل بنجاح ');
        return redirect(route('outgoings.index'));
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
