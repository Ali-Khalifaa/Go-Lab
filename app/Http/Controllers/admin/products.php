<?php

namespace App\Http\Controllers\admin;

use App\ProductImage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Store;
use App\Subcategory;
use App\Company;
use App\Product;
use File;
use Illuminate\Support\Facades\Validator;

class products extends Controller
{
    use barcode;
    public function index()
    {
        $products=Product::orderBy('rank_code')->get();
        return view('admin.products.index',compact('products'));

    }

    public function printBarcode($id)
    {
        $product=Product::find($id);
        $quantity=10;
         if($product->code==null){
            $barcode=$this->bar128(stripcslashes($product->id));
        }else{
         $barcode=$this->bar128(stripcslashes($product->code));
        }
        return view('admin.products.barcode',compact('product','quantity','barcode'));
    }

    public function addRecentlyArrived($id)
    {
        $product=Product::find($id);
        $product->update([
            'recently_arrived'=>1,
            ]);
        session()->flash('success','تمت الاضافة الى احدث المنتجات');
        return back();
    }

    public function removeRecentlyArrived($id)
    {
        $product=Product::find($id);
        $product->update([
            'recently_arrived'=>0,
            ]);
        session()->flash('success','تم الحذف من احدث المنتجات');
        return back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subcategories=Subcategory::all();
        $categories=Category::all();
        $products=Product::all();
        $companies=Company::all();
        $stores=Store::all();
        return view('admin.products.create',compact('products','categories','companies','subcategories','stores'));

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
            'name' => 'required|min:3|max:255',
            'name_en' => 'required|min:3|max:255',
            'quantity_status' => 'required',
            'max_quantity' => 'required',
            'status' => 'required',
            'price_total' => 'required|gte:discount_total',
            'waiting_status' => 'required',
            'description' => 'required',
            'description_en' => 'required',
            'subunit_type' => 'required',
            'subunit_type_en' => 'required',
            'unit_type' => 'required',
            'unit_type_en' => 'required',
            'quantity_unit' => 'required:min1',
            'image' => 'mimes:jpeg,jpg,png,gif|required|max:50000', // max 10000kb
            'rank_code' => 'required|integer|unique:products,rank_code',
             'code'=>'required|unique:products,code' ,
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }

        $products = new Product($request->all());

        if($request->quantity_status)
        {
            $products->quantity_status = $request->quantity_status;
        }
        else{
            $products->quantity_status = 0;
        }

        if($request->max_quantity)
        {
            $products->max_quantity = $request->max_quantity;
        }
        else{
            $products->max_quantity = 0;
        }

        $products->subunit_type = $request->subunit_type;
        $products->subunit_type_en = $request->subunit_type_en;
        $products->unit_type_en = $request->unit_type_en;
        $products->description_en = $request->description_en;
        $products->is_hidden = $request->is_hidden;
        $products->rank_code = $request->rank_code;
        if ($request->discount_type == 2)
        {
            $date = Carbon::now();
            $date = date('Y-m-d',strtotime( $date->addWeek() ));
            $products->date_end = $date;
        }elseif ($request->discount_type == 1){
            $date = Carbon::now();
            $date = date('Y-m-d',strtotime( $date->addMonth() ));
            $products->date_end = $date;
        }else{
            $products->discount_total = 0;
        }

        $products->save();

        $id= $products->id;

        if($image = $request->file('image')){

            $destinationPath = public_path('uploads/products');
            $extension = $image->getClientOriginalExtension();
            $fileName = $id.'_image'.'.'.$extension;

            $image->move($destinationPath, $fileName);

            Product::where('id',$id)->update(['image' => $fileName]);
        }

        if($images = $request->file('images')){
            foreach($request->file('images') as $images){

                $ext = $images->getClientOriginalExtension();
                $name = "product-". uniqid() . ".$ext";
                $images->move( public_path('uploads/product/images/') , $name);

                $imags =array([
                    'product_id' =>  $id,
                    'img' => $name,
                ]);

                ProductImage::insert($imags);
            }
        }

        session()->flash('success',' تمت الأضافة بنجاح ');

        return redirect('admin/products');
    }


    public function activeProduct($id)
    {
        $product=Product::where('id',$id)->first();
        $product->is_hidden=1;
        $product->save();
        // return view('option', compact('option'));
        session()->flash('success', 'تم ايقاف التفعيل بنجاح');

        return back();
    }

    public function deActiveProduct($id)
    {
        $product=Product::where('id',$id)->first();
        $product->is_hidden=0;
        $product->save();
        // return view('option', compact('option'));
        session()->flash('success', 'تم التفعيل بنجاح');
        return back();
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
        $products = Product::find($id);
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $companies = Company::all();
        $stores = Store::all();

        return view('admin.products.edit',compact('products','subcategories','companies','categories','stores'));
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
            'name' => 'required|min:3|max:255',
            'name_en' => 'required|min:3|max:255',
            'quantity_status' => 'required',
            'max_quantity' => 'required',
            'status' => 'required',
            'waiting_status' => 'required',
            'description' => 'required',
            'description_en' => 'required',
            'subunit_type' => 'required',
            'subunit_type_en' => 'required',
            'unit_type' => 'required',
            'unit_type_en' => 'required',
            'quantity_unit' => 'required:min1',
            'code'=>'required|unique:products,code' . ($id ? ",$id" : ''),
            'rank_code' => 'required|integer|unique:products,rank_code' . ($id ? ",$id" : ''),
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }
        $products = Product::find($id);

        $products->update($request->all());

        $id= $products->id;

        if($image = $request->file('image')){
                $destinationPath = public_path('uploads/products');
                $extension = $image->getClientOriginalExtension();
                $fileName = $id.'_image'.'.'.$extension;

                $image->move($destinationPath, $fileName);

                Product::where('id',$id)->update(['image' => $fileName]);
            }
        $product_infos=$products->infos()->get();
        foreach($product_infos as $product_info){
            $new_quantity_unit=($product_info->quantity * $products->quantity_unit);
            $product_info->update([
                'quantity_unit'=>$new_quantity_unit,
            ]);
        }
        session()->flash('success','تم التعديل بنجاح');

        return redirect('admin/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $products = Product::findOrFail($id);
        $destinationPath = public_path('uploads/products/'.$products->image);
        if(File::exists($destinationPath)){
          File::delete($destinationPath);
              }
         $products = Product::destroy($id);
        return back(); //
    }
}
