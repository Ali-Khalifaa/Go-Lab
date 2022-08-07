<?php

namespace App\Http\Controllers\admin;

use App\Package;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use File;
use App\Shop_Type;
class Shop_TypeController extends Controller
{
    public function index()
    {
        $sliders=Shop_Type::all();
        return view('admin.shop_types.index',compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sliders=Shop_Type::all();

        return view('admin.shop_types.create');
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
            'name' => 'required',
            // 'product_id' => 'required',
            // 'category_id' => 'required',
            ]);
        $sliders = new Shop_Type();
        $sliders->name = $request->name;
        $sliders->save();
        // $id= $sliders->id;
        // if($image = $request->file('image')){
        //     $destinationPath = public_path('uploads/sliders');
        //     $extension = $image->getClientOriginalExtension();
        //     $fileName = $id.'_image'.'.'.$extension;

        //     $image->move($destinationPath, $fileName);

        //     Slider::where('id',$id)->update(['image' => $fileName]);
        // }
        session()->flash('success','تمت الاضافة بنجاح');
        return redirect('admin/shoptypes');
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
        $sliders= Shop_Type::find($id);
        // $categories=Category::all();
        // $products=Product::all();
        return view('admin.shop_types.edit',compact('sliders'));
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
        $data = $request->validate([
            // 'name' => 'required|uniqe',
//            'category_id' => 'required',
            ]);
        $sliders = Shop_Type::find($id);
        $sliders->name = $request->name;
        $sliders->save();
        // $id= $sliders->id;

        // if(!empty($image = $request->file('image'))){
        //     $destinationPath = public_path('uploads/sliders');
        //     $extension = $image->getClientOriginalExtension();
        //     $fileName = $id.'_image'.'.'.$extension;

        //     $image->move($destinationPath, $fileName);

        //     Slider::where('id',$id)->update(['image' => $fileName]);
        // }
        session()->flash('success','تم التعديل بنجاح');
        return redirect('admin/shoptypes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sliders = Shop_Type::findOrFail($id);
        $sliders->delete();
        // $destinationPath = public_path('uploads/sliders/'.$sliders->image);
        // if(File::exists($destinationPath)){
        //   File::delete($destinationPath);
        //       }
        //  $sliders = Slider::destroy($id);
        session()->flash('success','تم الحذف بنجاح');
        return back(); //
    }
}
