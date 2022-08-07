<?php

namespace App\Http\Controllers\admin;

use App\Place;
use App\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class places extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $places= Place::all();
        return view('admin.places.index',compact('places'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $stores=Store::all();
        return view('admin.places.create',compact('stores'));
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
            'place' => 'required|min:3|max:255',
            'place_en' => 'required|min:3|max:255',
//            'store_id' => 'required',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }
        $places = new place($request->all());

        $places->save();

        $id= $places->id;

        /*if($image = $request->file('image')){
            $destinationPath = public_path('uploads/places');
            $extension = $image->getClientOriginalExtension();
            $fileName = $id.'_image'.'.'.$extension;

            $image->move($destinationPath, $fileName);

            place::where('id',$id)->update(['image' => $fileName]);
        }*/
        session()->flash('success',' تمت الأضافة بنجاح ');
        return redirect('admin/places');
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
        $place= place::find($id);
        $stores=Store::all();
        return view('admin.places.edit',compact('place','stores'));
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
            'place' => 'required|min:3|max:255',
            'place_en' => 'required|min:3|max:255',
            'store_id' => 'required',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }
        $places = place::find($id);
        $places->place = $request->place;
        $places->place_en = $request->place_en;
        $places->store_id = $request->store_id;
        $places->save();
        $id= $places->id;
        session()->flash('success','تم التعديل بنجاح');
        return redirect('admin/places');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $places = place::destroy($id);
        return back(); //
    }
}
