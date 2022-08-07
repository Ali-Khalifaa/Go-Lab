<?php

namespace App\Http\Controllers\admin;

use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class DiscountProductController extends Controller
{
    public function index($id)
    {
        //
    }

    public function create($id)
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function edit($id)
    {
        $product=Product::findOrFail($id);

        return view('admin.discountProduct.edit',compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product=Product::findOrFail($id);
        $request_data = $request->all();

        if ($request->discount_type == 2)
        {
            $date = Carbon::now();
            $date = date('Y-m-d',strtotime( $date->addWeek() ));
            $request_data['date_end'] = $date;
        }elseif ($request->discount_type == 1){
            $date = Carbon::now();
            $date = date('Y-m-d',strtotime( $date->addMonth() ));
            $request_data['date_end'] = $date;
        }else{
            $request_data['date_end'] = null;
            $request_data['discount_total'] =0;
        }

        $product->update($request_data);

        session()->flash('success','تم التعديل بنجاح');

        return redirect('admin/products');
    }

    public function destroy($id)
    {
        //
    }
}
