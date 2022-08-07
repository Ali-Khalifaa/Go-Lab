<?php

namespace App\Http\Controllers\admin;

use App\Notify_name;
use App\Notify_name_unit;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class name_notifies extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $notify_names =  Notify_name::all();
        return view('admin.name_notifies.index',compact('notify_names'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function create()
    {
        $products = Product::all();

        return view('admin.name_notifies.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        /*
         * Check if main info of the notify is filled
         */
        $validator = Validator::make($request->all(),[
            'name'    =>  'required',
        ]);
        if ($validator->fails())
        {
            return back()->withErrors('الإسم مطلوب');
        }
        /*
         *
         */
        $notify_name = new Notify_name($request->all());
        // variable to check at least one is filled to save
        $at_least_one= false;
        foreach ($request->info as $notify_name_unit){
            if ($notify_name_unit['discount_unit'] !=null && $notify_name_unit['discount_total'] != null )
            {
                $at_least_one= true;

                // Check Later Unit and Later Total
                // Check Also if now + later discount it equal the discount rete
                $validator = Validator::make($notify_name_unit,[
                    'now_total' =>'required',
                    'later_total' =>'required',
                    'now_unit' =>'required',
                    'later_unit' =>'required',
                ]);
                if ($validator->fails())
                {
                    $notify_name->notify_name_units()->delete();
                    $notify_name->delete();
                    return back()->withErrors('نسبة الخصم الأجلة والفورية مطلوية');
                }
                // Check Also if now + later discount it equal the discount rete
                $validator = Validator::make($notify_name_unit,[
                    'discount_unit' => 'in:'.($notify_name_unit['now_unit']+$notify_name_unit['later_unit']),
                    'discount_total' => 'in:'.($notify_name_unit['now_total']+$notify_name_unit['later_total']),
                ]);
                if ($validator->fails())
                {
                    $notify_name->notify_name_units()->delete();
                    $notify_name->delete();
                    return back()->withErrors('يجب ان يكون نسبة الخصم الأجلة + الفورية مساوية لنسية الخصم');
                }
                else
                {
                    $notify_name->save();
                    $notify_name_unit = new Notify_name_unit($notify_name_unit);
                    $notify_name_unit->notify_name_id = $notify_name->id;
                    $notify_name_unit->save();
                }
            }
        }
        if ($at_least_one){
            return redirect('admin/name_notifies/'.$notify_name->id)->with('تم اضافة الخصم بنجاح');
        }
        else
        {
            $notify_name->delete();
            return back()->withErrors('يجب عليك اختيار منتج واحد داخل العرض على الاقل');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show($id)
    {
        $notify = Notify_name::find($id);
        return view('admin.name_notifies.show',compact('notify'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($id)
    {
        $notify = Notify_name::find($id);
        $products = Product::all();
        return view('admin.name_notifies.edit',compact('notify','products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        /*
         * Check If at Least Store Selected
         * Check if main info of the notify is filled
         */
        $validator = Validator::make($request->all(),[
            'name'    =>  'required',
        ]);
        if ($validator->fails())
        {
            return back()->withErrors('الإسم مطلوب');
        }
//        dd($request->all());
        /*
         *  Get The Notify User And Update
         */
        $notify_name = Notify_name::findOrFail($id);
        $notify_name->update($request->all());
        // variable to check at least one is filled to save
        foreach ($request->info as $notify_name_unit){
            /*
             * Check if There is a unit for this product
             */
            $notify_unit = $notify_name->notify_name_units()->where('product_id',$notify_name_unit['product_id'])->get()->first();
            if (is_null($notify_unit)){
                $have_product = false;
            }
            else
            {
                // Have Products
                $have_product = true;
            }
            if ($notify_name_unit['discount_unit'] !=null && $notify_name_unit['discount_total'] != null )
            {

                // Check Later Unit and Later Total
                // Check Also if now + later discount it equal the discount rete
                $validator = Validator::make($notify_name_unit,[
                    'now_total' =>'required',
                    'later_total' =>'required',
                    'now_unit' =>'required',
                    'later_unit' =>'required',
                ]);
                if ($validator->fails())
                {
                    return back()->withErrors('نسبة الخصم الأجلة والفورية مطلوية');
                }
                // Check Also if now + later discount it equal the discount rete
                $validator = Validator::make($notify_name_unit,[
                    'discount_unit' => 'in:'.($notify_name_unit['now_unit']+$notify_name_unit['later_unit']),
                    'discount_total' => 'in:'.($notify_name_unit['now_total']+$notify_name_unit['later_total']),
                ]);
                if ($validator->fails())
                {
                    return back()->withErrors('يجب ان يكون نسبة الخصم الأجلة + الفورية مساوية لنسية الخصم');
                }
                else
                {
                    if($have_product)
                    {
                        $notify_unit->update($notify_name_unit);
                        $notify_unit->update([
                            'Notify_name_id '=> $notify_name->id
                        ]);
                    }
                    else
                    {
                        $notify_name_unit = new Notify_name_unit($notify_name_unit);
                        $notify_name_unit->Notify_name_id = $notify_name->id;
                        $notify_name_unit->save();
                    }
                }
            }
            // if not filled delete the notify unit if exist
            else
            {
                if($have_product)
                {
                    $notify_unit->delete();
                }
            }
        }
        return redirect('admin/name_notifies/'.$notify_name->id)->with('تم تعديل الخصم بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $notify_name = Notify_name::findOrFail($id);
        $notify_name->notify_name_units()->delete();
        $notify_name->delete();
        return redirect('admin/name_notifies')->with('تم حذف الخصم بنجاح');
    }
}
