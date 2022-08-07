<?php

namespace App\Http\Controllers\admin;

use App\Offer_point;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class offerpoints extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offer_points = Offer_point::all();
        return view('admin.offer_points.index' , compact('offer_points'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.offer_points.create');
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
            'total' => 'required',
            'points' => 'required',
        ]);

        $offer_point = new Offer_point($request->all());
        $offer_point->save();

        session()->flash('success',' تمت الأضافة بنجاح ');
        return redirect(route('offer_points.index'));
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
        $offer_point = Offer_point::findOrFail($id);
        return view('admin.offer_points.edit' , compact('offer_point'));
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
            'total' => 'required',
            'points' => 'required',
        ]);
        $offer_point = Offer_point::findOrFail($id);
        $offer_point->update($request->all());
        session()->flash('success','تم التعديل بنجاح');
        return redirect(route('offer_points.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $offer_point = Offer_point::findOrFail($id);
        $offer_point->delete();
        return redirect(route('offer_points.index'));
    }
}
