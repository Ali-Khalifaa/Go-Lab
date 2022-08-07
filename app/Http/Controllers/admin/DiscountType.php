<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class DiscountType extends Controller
{
    public function index()
    {
        $types=\App\DiscountType::all();
        return view('admin.discount_type.index',compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types=\App\DiscountType::all();
        return view('admin.discount_type.create',compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'name_en' => 'required|string|max:100',
            'from' => 'required|integer',
            'to' => 'required|integer',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }

        \App\DiscountType::create($request->all());

        session()->flash('success',' تمت الأضافة بنجاح ');

        return redirect('admin/discount_type');
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
        $types= \App\DiscountType::find($id);
        return view('admin.discount_type.edit',compact('types'));
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
        $validator = Validator::make($request->all(), [

            'from' => 'required|integer',
            'to' => 'required|integer',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }

        $discount = \App\DiscountType::find($id);
        $request_data = $request->all();

        $discount->update($request_data);

        session()->flash('success','تم التعديل بنجاح');
        return redirect('admin/discount_type');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $contacts = \App\DiscountType::destroy($id);
        return back();
    }
}
