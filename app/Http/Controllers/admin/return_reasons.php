<?php

namespace App\Http\Controllers\admin;

use App\Return_reason;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class return_reasons extends Controller
{
    public function index()
    {
        $return_reasons=return_reason::all();
        return view('admin.return_reasons.index',compact('return_reasons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $return_reasons= return_reason::all();
        return view('admin.return_reasons.create');
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
            'status' => 'required|unique:return_reasons',
        ]);
        $return_reasons = new return_reason($request->all());
        $return_reasons->save();
        session()->flash('success',' تمت الأضافة بنجاح ');
        return redirect('admin/return_reasons');
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($id)
    {
        $return_reasons= return_reason::find($id);
        return view('admin.return_reasons.edit',compact('return_reasons'));
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
            'status' => [ 'required',
                Rule::unique('return_reasons')->ignore($id)]
        ]);
        $return_reasons = return_reason::find($id);
        $return_reasons->update($request->all());
        session()->flash('success','تم التعديل بنجاح');
        return redirect('admin/return_reasons');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $return_reasons = return_reason::destroy($id);
        return back();
    }
}
