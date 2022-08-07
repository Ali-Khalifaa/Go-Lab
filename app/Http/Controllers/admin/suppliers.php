<?php

namespace App\Http\Controllers\admin;

use App\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class suppliers extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::all();
        return view('admin.suppliers.index',compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.suppliers.create');

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
            'name'  =>  'required|unique:suppliers,name',
            'phone'  =>  'required|regex:/(01)[0-9]{9}/|unique:suppliers,phone',
            'address'  =>  'required',
            's_togary'  =>  'required',
        ]);
        $supplier = new Supplier($request->all());
        $supplier->save();
        session()->flash('success',' تمت الأضافة بنجاح ');
        return redirect('/admin/suppliers');
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
        $supplier = Supplier::findOrFail($id);
        return view('admin.suppliers.edit' , compact('supplier'));
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
            'name'  =>  ['required',Rule::unique('suppliers')->ignore($id)],
            'phone'  =>  'required|regex:/(01)[0-9]{9}/|unique:suppliers,phone' . ($id ? ",$id" : ''),
            'address'  =>  'required',
            's_togary'  =>  'required',
        ]);
        if (isset($request->is_active))
        {
            $is_active=1;
        }
        else
        {
            $is_active=0;
        }
        $supplier = Supplier::findOrFail($id);
        $supplier->update($request->all());
        $supplier->update([
            'is_active' =>  $is_active
        ]);
        return redirect('/admin/suppliers');
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
