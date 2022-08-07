<?php

namespace App\Http\Controllers\admin;

use App\Receipt_status;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class receipt_statuses extends Controller
{
    public function index()
    {
        $receipt_statuses=receipt_status::all();
        return view('admin.receipt_statuses.index',compact('receipt_statuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $receipt_statuses= receipt_status::all();
        return view('admin.receipt_statuses.create');
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
            'status' => 'required|unique:receipt_statuses',
        ]);
        $receipt_statuses = new receipt_status($request->all());
        $receipt_statuses->save();
        session()->flash('success',' تمت الأضافة بنجاح ');
        return redirect('admin/receipt_statuses');
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
        $receipt_statuses= receipt_status::find($id);
        return view('admin.receipt_statuses.edit',compact('receipt_statuses'));
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
            Rule::unique('receipt_statuses')->ignore($id)]
        ]);
        $receipt_statuses = receipt_status::find($id);
        $receipt_statuses->update($request->all());

        session()->flash('success','تم التعديل بنجاح');
        return redirect('admin/receipt_statuses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $receipt_statuses = receipt_status::destroy($id);
        return back();
    }
}
