<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Discount;
use App\Subcategory;

class discounts extends Controller
{
    public function index()
    {
        $discounts=Discount::all();
        return view('admin.discounts.index',compact('discounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $discounts= Discount::all();
        $subcategories= Subcategory::all();
        return view('admin.discounts.create',compact('discounts','subcategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
        'from_price' => 'required',
        'to_price' => 'required|numeric|gte:from_price',
        'from_date' => 'required',
        'to_date' => 'required|after_or_equal:from_date',
        'discount' => 'required',
        'subcategory_id' => 'required',
        ]);
        $discounts = new Discount($request->all());
        $discounts->subcategory_id = $request->subcategory_id;
        $discounts->save();
        return redirect('admin/discounts');
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
        $discounts= Discount::find($id);
        $subcategories= Subcategory::all();
        return view('admin.discounts.edit',compact('discounts','subcategories'));
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
            'from_price' => 'required',
            'to_price' => 'required|numeric|gte:from_price',
            'from_date' => 'required',
            'to_date' => 'required|after_or_equal:from_date',
            'discount' => 'required',
            'subcategory_id' => 'required',
        ]);
        $discounts = Discount::find($id);
        $discounts->subcategory_id = $request->subcategory_id;
        $discounts->save($request->all());
        return redirect('admin/discounts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $discounts = Discount::destroy($id);
        return back();
    }
}
