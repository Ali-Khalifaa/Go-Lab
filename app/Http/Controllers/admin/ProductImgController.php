<?php

namespace App\Http\Controllers\admin;

use App\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ProductImgController extends Controller
{
    public function index($id)
    {
        $product_id = $id;
        $products=ProductImage::where('product_id',$id)->get();

        return view('admin.productImg.index',compact('products','product_id'));

    }

    public function create($id)
    {
        $product_id = $id;
        return view('admin.productImg.create',compact('product_id'));

    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'img' => 'mimes:jpeg,jpg,png,gif|required|max:50000', // max 10000kb
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }

        if($request->hasFile('img')){

            $img = $request->file('img');
            $ext = $img->getClientOriginalExtension();
            $name = "product-". uniqid() . ".$ext";
            $img->move( public_path('uploads/product/images/') , $name);
        }

        $product = ProductImage::create([
            'img' => $name,
            'product_id' => $request->product_id
        ]);

        session()->flash('success',' تمت الأضافة بنجاح ');
        return redirect()->route('productImg.index',$request->product_id);

    }

    public function edit($id)
    {
        $product=ProductImage::findOrFail($id);

        return view('admin.productImg.edit',compact('product'));
    }

    public function update(Request $request, $id)
    {

        $product=ProductImage::findOrFail($id);

        $old_name = $product->img;

        $request_data = $request->all();
        if($request->hasFile('img')){

            if($old_name !== null)
            {
                unlink( public_path('uploads/product/images/') . $old_name );
            }

            $img = $request->file('img');
            $ext = $img->getClientOriginalExtension();
            $name = "product-". uniqid() . ".$ext";

            $img->move( public_path('uploads/product/images/') , $name);

            $request_data['img'] = $name;

        }

        $product->update($request_data);

        session()->flash('success','تم التعديل بنجاح');
        return redirect()->route('productImg.index',$request->product_id);
    }

    public function destroy($id)
    {

        $product=ProductImage::findOrFail($id);

        if($product->img !== null)
        {
            unlink( public_path('uploads/product/images/') . $product->img );
        }

        $product->delete();

        session()->flash('success',' تم الحذف بنجاح');
        return redirect()->route('productImg.index',$product->product_id);
    }
}
