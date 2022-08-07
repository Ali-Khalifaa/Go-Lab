<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class MongezController extends Controller
{
    public function index()
    {
        $types = \App\Mongez::all();

        return view('admin.mongez.index',compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.mongez.create');
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
            'price' => 'required|min:1',
            'from' => 'required|integer|min:1',
            'to' => 'required|integer|min:1',
            'time' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }

        \App\Mongez::create($request->all());

        session()->flash('success',' تمت الأضافة بنجاح ');
        return redirect('admin/mongez');
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
        $types= \App\Mongez::find($id);
        return view('admin.mongez.edit',compact('types'));
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
            'price' => 'required|min:1',
            'from' => 'required|integer|min:1',
            'to' => 'required|integer|min:1',
            'time' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }

        $contacts = \App\Mongez::find($id);
        $request_data = $request->all();
        $contacts->update($request_data);
        session()->flash('success','تم التعديل بنجاح');
        return redirect('admin/mongez');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contacts = \App\Mongez::destroy($id);
        return back();
    }
}
