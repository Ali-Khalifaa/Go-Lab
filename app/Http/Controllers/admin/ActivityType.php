<?php

namespace App\Http\Controllers\admin;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ActivityType extends Controller
{
    public function index()
    {
        $types=\App\ActivityType::all();
        return view('admin.activity_type.index',compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types=\App\ActivityType::all();
        return view('admin.activity_type.create',compact('types'));
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
            'title' => 'required|string|max:100|unique:activity_types,title',
            'title_en' => 'required|string|max:100|unique:activity_types,title_en',
            'img' => 'mimes:svg|required|max:50000', // max 10000kb
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }

        if($request->hasFile('img'))
        {
            $img = $request->file('img');
            $ext = $img->getClientOriginalExtension();
            $image_name = "activity-type-". uniqid() . ".$ext";
            $img->move( public_path('uploads/activity-type/') , $image_name);
        }

        \App\ActivityType::create([
           'title' =>$request->title,
           'title_en' =>$request->title_en,
           'img' =>$image_name,
        ]);
        session()->flash('success',' تمت الأضافة بنجاح ');
        return redirect('admin/activity-type');
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
        $types= \App\ActivityType::find($id);
        return view('admin.activity_type.edit',compact('types'));
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
            'title' => 'required|string|max:100|unique:activity_types,title' . ($id ? ",$id" : ''),
            'title_en' => 'required|string|max:100|unique:activity_types,title_en' . ($id ? ",$id" : ''),
            'img' => 'mimes:svg|max:50000', // max 10000kb
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }
        $contacts = \App\ActivityType::find($id);
        $request_data = $request->all();

        if($request->hasFile('img'))
        {
            $img = $request->file('img');
            $ext = $img->getClientOriginalExtension();
            $image_name = "activity-type-". uniqid() . ".$ext";
            $img->move( public_path('uploads/activity-type/') , $image_name);
            $request_data['img'] = $image_name;
        }

        $contacts->update($request_data);
        session()->flash('success','تم التعديل بنجاح');
        return redirect('admin/activity-type');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $contacts = \App\ActivityType::destroy($id);
        return back();
    }
}
