<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ads extends Controller
{
    public function index()
    {
        $ads=\App\Ads::all();

        return view('admin.ads.index',compact('ads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ads=\App\Ads::all();
        return view('admin.ads.create',compact('ads'));
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
            'img' => 'mimes:jpeg,jpg,png,gif|required|max:2000', // max 10000kb
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }

        if($request->hasFile('img'))
        {
            $img = $request->file('img');
            $ext = $img->getClientOriginalExtension();
            $image_name = "ads-". uniqid() . ".$ext";
            $img->move( public_path('uploads/ads/') , $image_name);
        }

        \App\Ads::create([
            'img' =>$image_name,
        ]);
        session()->flash('success',' تمت الأضافة بنجاح ');
        return redirect('admin/ads');
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
        $types= \App\Ads::find($id);
        return view('admin.ads.edit',compact('types'));
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
            'img' => 'mimes:jpeg,jpg,png,gif|max:2000', // max 10000kb
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }
        $contacts = \App\Ads::find($id);
        $request_data = $request->all();

        if($request->hasFile('img'))
        {
            $img = $request->file('img');
            $ext = $img->getClientOriginalExtension();
            $image_name = "ads-". uniqid() . ".$ext";
            $img->move( public_path('uploads/ads/') , $image_name);
            $request_data['img'] = $image_name;
        }

        $contacts->update($request_data);
        session()->flash('success','تم التعديل بنجاح');
        return redirect('admin/ads');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contacts = \App\Ads::destroy($id);
        session()->flash('success',' تم الحذف بنجاح ');
        return back();
    }
}
