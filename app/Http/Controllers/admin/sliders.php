<?php

namespace App\Http\Controllers\admin;

use App\Package;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use File;
use App\Slider;
use App\Category;

class sliders extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        return view('admin.sliders.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sliders = Slider::all();
        $categories = Category::all();
        $products = Product::all();
        return view('admin.sliders.create', compact('sliders', 'products', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'image' => 'mimes:jpeg,jpg,png,gif|required|max:50000', // max 10000kb
            'product_id' => 'required',
            'category_id' => 'required',
        ]);
        $sliders = new Slider();
        $sliders->product_id = $request->product_id;
        $sliders->category_id = $request->category_id;
        $sliders->save();
        $id = $sliders->id;
        if ($image = $request->file('image')) {
            $destinationPath = public_path('uploads/sliders');
            $extension = $image->getClientOriginalExtension();
            $fileName = $id . '_image' . '.' . $extension;

            $image->move($destinationPath, $fileName);

            Slider::where('id', $id)->update(['image' => $fileName]);
        }
        session()->flash('success', 'تمت الاضافة بنجاح');
        return redirect('admin/sliders');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sliders = Slider::find($id);
        $categories = Category::all();
        $products = Product::all();
        return view('admin.sliders.edit', compact('sliders', 'categories', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'image' => 'mimes:jpeg,jpg,png,gif|max:50000', // max 10000kb
            'product_id' => 'required',
            'category_id' => 'required',
        ]);
        $sliders = Slider::find($id);
        $sliders->product_id = $request->product_id;
        $sliders->category_id = $request->category_id;
        $sliders->save();
        $id = $sliders->id;

        if (!empty($image = $request->file('image'))) {
            $destinationPath = public_path('uploads/sliders');
            $extension = $image->getClientOriginalExtension();
            $fileName = $id . '_image' . '.' . $extension;

            $image->move($destinationPath, $fileName);

            Slider::where('id', $id)->update(['image' => $fileName]);
        }
        session()->flash('success', 'تم التعديل بنجاح');
        return redirect('admin/sliders');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sliders = Slider::findOrFail($id);
        $destinationPath = public_path('uploads/sliders/' . $sliders->image);
        if (File::exists($destinationPath)) {
            File::delete($destinationPath);
        }
        $sliders = Slider::destroy($id);
        session()->flash('success', 'تم الحذف بنجاح');
        return back(); //
    }
}
