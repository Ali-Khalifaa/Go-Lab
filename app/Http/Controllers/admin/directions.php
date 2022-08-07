<?php

namespace App\Http\Controllers\admin;

use App\Direction;
use App\Place;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class directions extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $directions= Direction::all();
        return view('admin.directions.index',compact('directions'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $places = Place::all();
        return view('admin.directions.create',compact('places'));
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
            'place_id' => 'required',
            'direction' =>  'required'
        ]);
        $directions = new Direction($request->all());

        $directions->save();
        session()->flash('success',' تمت الأضافة بنجاح ');

        return redirect('admin/directions');
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
        $direction= Direction::find($id);
        $places = Place::all();
        return view('admin.directions.edit',compact('direction','places'));
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
            'place_id' => 'required',
            'direction' =>  'required'
        ]);
        $directions = Direction::find($id);
        $directions->update($request->all());
        session()->flash('success','تم التعديل بنجاح');

        return redirect('admin/directions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $directions = Direction::destroy($id);
        return back(); //
    }
}
