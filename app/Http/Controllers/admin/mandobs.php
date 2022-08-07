<?php

namespace App\Http\Controllers\admin;

use App\Place;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mandob;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;


class mandobs extends Controller
{

    public function index()
    {
        $mandobs=Mandob::all();
        return view('admin.mandobs.index',compact('mandobs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $places = Place::all();
        return view('admin.mandobs.create',compact('places'));
    }

    /**
     * Mandob a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'places' => 'required',
            'name' => 'required|unique:mandobs',
            'phone' => 'required|unique:mandobs',
            'address' => 'required',
            'password' => 'min:8|required'
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }
        //
        $password = Hash::make($request->password);
        $mandobs = new Mandob();
        $mandobs->name = $request->name;
        $mandobs->phone = $request->phone;
        $mandobs->address = $request->address;
        $mandobs->password = $password;
        $mandobs->save();
        $mandobs->places()->attach($request->places);
        session()->flash('success',' تمت الأضافة بنجاح ');
        return redirect()->route('mandoobs.index');
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
        $places = Place::all();
        $mandobs= Mandob::find($id);
        return view('admin.mandobs.edit',compact('mandobs','places'));
    }
    public function status($id)
    {

        $mandob = Mandob::findOrFail($id);
        $mandob->status =1;
        $mandob->save();
        session()->flash('success','تم التفعيل بنجاح');
        return redirect('admin/mandoobs');
    }

    public function block($id)
    {
        $mandob = Mandob::findOrFail($id);
        $mandob->status =0;
        $mandob->save();
        session()->flash('success','تم ايقاف التفعيل بنجاح');
        return redirect('admin/mandoobs');
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
            'places' => 'required',
            'name' => 'required|unique:mandobs,name' . ($id ? ",$id" : ''),
            'phone' => 'required|unique:mandobs,phone' . ($id ? ",$id" : ''),
            'address' => 'required',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }

        $mandobs = Mandob::find($id);
        $mandobs->name = $request->name;
        $mandobs->phone = $request->phone;
        $mandobs->section = $request->section;
        $mandobs->address = $request->address;
        if (isset($request->password))
        {
            $password = Hash::make($request->password);
            $mandobs->password = $password;
        }
        $mandobs->places()->sync($request->places);
        $mandobs->save();
        session()->flash('success','تم التعديل بنجاح');
        return redirect('admin/mandoobs');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mandobs = Mandob::destroy($id);
        return back();
    }

    public function getDownload()
    {
        //PDF file is stored under project/public/download/info.pdf
        $file= public_path(). "/uploads/mandob.apk";
        $pathToFile=public_path(). "/uploads/mandob";
        $headers = array(
            // 'Content-Type: application/apk',
            'Content-Type: application/octet-stream',
        );

        // return Response::download($file, 'mandob.apk', $headers);

        // return Response::download($pathToFile,$file . '.' . pathinfo($pathToFile, PATHINFO_EXTENSION));
        return Response::download($file, 'mandob.apk',$headers);

    }
}
