<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Locker;
use App\Store;
use File;

class lockers extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $total=0;
        // dd($request->all());
        $lockers=Locker::when($request->has('from_date'), function ($query) use ($request) {
            return $query->whereDate('created_at', '>=', $request->from_date);
        })->when($request->has('to_date'), function ($query) use ($request) {
            return $query->whereDate('created_at', '<=', $request->to_date);
        })->when($request->has('store_id'), function ($query) use ($request) {
            return $query->where('store_id', '=', $request->store_id);
        })->when($request->has('type'), function ($query) use ($request) {
            return $query->where('type', '=', $request->type);
        })->orderBy('created_at', 'desc')->get();
        
        foreach($lockers as $locker)
        {
            if($request->type==null){
            if($locker->type==0)
            {
            $total+=$locker->number;
            }elseif($locker->type==1){
                $total-=$locker->number;
            }
            }elseif($request->type==1){
                $total+=$locker->number;
            }elseif($request->type==0){
                $total+=$locker->number;
            }
        }
        $stores=Store::all();
        return view('admin.lockers.index',compact('lockers','stores','total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lockers= Locker::all();
        return view('admin.lockers.create',compact('lockers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lockers = new Locker();
        $lockers->name = $request->name;
        $lockers->is_hidden = $request->is_hidden;

        $lockers->save();

        $id= $lockers->id;

        if($image = $request->file('image')){
                $destinationPath = public_path('uploads/lockers');
                $extension = $image->getClientOriginalExtension();
                $fileName = $id.'_image'.'.'.$extension;

                $image->move($destinationPath, $fileName);

                Locker::where('id',$id)->update(['image' => $fileName]);
            }

        return redirect('admin/lockers');
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
        $lockers= Locker::find($id);
        return view('admin.lockers.edit',compact('lockers'));
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
        $lockers = Locker::find($id);
        $lockers->name = $request->name;
        $lockers->is_hidden = $request->is_hidden;
        $lockers->save();
        $id= $lockers->id;

        return redirect('admin/lockers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lockers = Locker::findOrFail($id);
         $lockers = Locker::destroy($id);
        return back(); //
    }
}
