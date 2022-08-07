<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ComplaintType extends Controller
{
    public function index()
    {
        $types=\App\ComplaintType::all();
        return view('admin.complaint_type.index',compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types=\App\ComplaintType::all();
        return view('admin.complaint_type.create',compact('types'));
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
            'name' => 'required|string|unique:complaint_types,name',
            'name_en' => 'required|string|unique:complaint_types,name_en',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }

        \App\ComplaintType::create([
            'name' =>$request->name,
            'name_en' =>$request->name_en,
        ]);
        session()->flash('success',' تمت الأضافة بنجاح ');
        return redirect('admin/complaint_type');
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
        $types= \App\ComplaintType::find($id);
        return view('admin.complaint_type.edit',compact('types'));
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
            'name' => 'required|string|unique:complaint_types,name' . ($id ? ",$id" : ''),
            'name_en' => 'required|string|unique:complaint_types,name_en' . ($id ? ",$id" : ''),
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }
        $contacts = \App\ComplaintType::find($id);
        $request_data = $request->all();

        $contacts->update($request_data);
        session()->flash('success','تم التعديل بنجاح');
        return redirect('admin/complaint_type');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contacts = \App\ComplaintType::destroy($id);
        session()->flash('success','تم الحذف بنجاح');
        return back();
    }
}
