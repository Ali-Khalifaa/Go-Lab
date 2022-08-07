<?php

namespace App\Http\Controllers\api;

use App\Category;
use App\Notify;
use App\Option;
use App\order_unit;
use App\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Company;

class companies extends Controller
{
    use ApiResponceTrait;

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getProductCompany(Request $request,$id)
    {
        /*
        * Get Store Products
        */
        $store = Store::all()->first();
        $store_id = $store->id;
        $products = $store->products()->where([
            ['is_hidden', '=', 0],
            ['company_id', $id]
        ])->orderBy('rank_code')->paginate(20);
        foreach ($products as $index => $product) {
            $clone_product = $product->replicate();

            $product_customs = $product->infos()->wherePivot('store_id', '=', $store_id)->get()->first();
            if ($product_customs) {
//            --------------
                if (Option::findOrFail(3)->is_active) {
                    $product_all = $product->infos;
                    $product->quantity_info = $product_all->pluck('quantity')->sum();
                    $product->quantity_unit_info = $product_all->pluck('quantity_unit')->sum();
                } else {

                    $product->quantity_info = $product_customs->quantity;
                    $product->quantity_unit_info = $product_customs->quantity_unit;
                }
//            --------------
                /* دمج جميع المنتجات اللي اطلبت ومكافأهها من الكميه لكي لا يطلب اكثر من المتاح */
                $order_units = order_unit::whereHas('order', function ($query) use ($store_id) {
                    $query->where([
                        ['store_id', '=', $store_id],
                        ['is_complete', '=', 1],
                        ['is_direct_sell', '=', 0],
                        ['order_stage_id', '<', 5],
                    ]);
                })->get();
                $minus_total = $order_units->sum('quantity_total');
                // $minus_unit = $order_units->sum('quantity_unit');
                // $product->quantity_info = $product->quantity_info - $minus_total;
                // $product->quantity_unit_info = $product->quantity_unit_info - $minus_unit;

                if ($product->quantity_info < 0) {
                    $product->quantity_info = 0;
                }
                if ($product->quantity_unit_info < 0) {
                    $product->quantity_unit_info = 0;
                }

                /*------------------------------------------------------------------------*/
                $product->reorder_limit = $product_customs->reorder_limit;
                $product->sp_unit_percentage = $product_customs->sp_unit_percentage;
                $product->sp_total_percentage = $product_customs->sp_total_percentage;
                $product->buy_price = $product_customs->buy_price;
                $product->sp_unit_price = $product_customs->sell_unit($clone_product);
                $product->sp_total_price = $product_customs->sell_total;
                $product->images;
                $product->productImages;
                $lang = $request->header('lang');
                if ($lang == 'ar')
                {
                    $product->name =$product->name;
                    $product->description =$product->description;
                    $product->unit_type =$product->unit_type;
                    $product->subunit_type =$product->subunit_type;

                }else{
                    $product->name =$product->name_en;
                    $product->description =$product->description_en;
                    $product->unit_type =$product->unit_type_en;
                    $product->subunit_type =$product->subunit_type_en;
                }
            }
        }
        $data['products'] = $products;
        $data['option'] = Option::findOrFail(1)->is_active;
        $check_store_notify = $store->notify()->get()->first();
        if (is_null($check_store_notify)) {
            if (is_null(Notify::where('store_id', 0)->get()->first())) {
                $data['store_notify'] = false;
                $data['option'] = 0;
            } else {
                $global_notify = Notify::where('store_id', 0)->get()->first();
                $data['store_notify'] = $global_notify;
                $data['store_notify']['units'] = $global_notify->notify_units()->get();
            }
        } else {
            $data['store_notify'] = $check_store_notify;
            $data['store_notify']['units'] = $check_store_notify->notify_units()->get();
        }
        return $this->ApiResponce($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getCompanyCategory(Request $request,$id)
    {
        $lang = $request->header('lang');
        $data = [];
        if ($lang == 'ar')
        {
            $companies = Company::where([
                ['is_hidden','=',0],
                ['category_id','=',$id],
            ])->get(['id','name','image','category_id','company_field']);

            foreach ($companies as $index=>$company)
            {
                $data[$index]['id'] =$company->id;
                $data[$index]['name'] =$company->name;
                $data[$index]['image'] =$company->image;
                $data[$index]['image_path'] =$company->image_path;
                $data[$index]['category_id'] =$company->category_id;
                $data[$index]['company_field'] =$company->company_field;
            }

        }else{
            $companies = Company::where([
                ['is_hidden','=',0],
                ['category_id','=',$id],
            ])->get(['id','name_en','image','category_id','company_field_en']);

            foreach ($companies as $index=>$company)
            {
                $data[$index]['id'] =$company->id;
                $data[$index]['name'] =$company->name_en;
                $data[$index]['image'] =$company->image;
                $data[$index]['image_path'] =$company->image_path;
                $data[$index]['category_id'] =$company->category_id;
                $data[$index]['company_field'] =$company->company_field_en;
            }
        }

        return response()->json($data);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (true) {
            $lang = $request->header('lang');
            $data = [];
            if ($lang == 'ar')
            {
                $companies = Company::where([
                    ['is_hidden','=',0],
                ])->get(['id','name','image','category_id','company_field']);

                foreach ($companies as $index=>$company)
                {
                    $data[$index]['id'] =$company->id;
                    $data[$index]['name'] =$company->name;
                    $data[$index]['image'] =$company->image;
                    $data[$index]['image_path'] =$company->image_path;
                    $data[$index]['category_id'] =$company->category_id;
                    $data[$index]['company_field'] =$company->company_field;
                }

            }else{
                $companies = Company::where([
                    ['is_hidden','=',0],
                ])->get(['id','name_en','image','category_id','company_field_en']);

                foreach ($companies as $index=>$company)
                {
                    $data[$index]['id'] =$company->id;
                    $data[$index]['name'] =$company->name_en;
                    $data[$index]['image'] =$company->image;
                    $data[$index]['image_path'] =$company->image_path;
                    $data[$index]['category_id'] =$company->category_id;
                    $data[$index]['company_field'] =$company->company_field_en;
                }
            }

            return response()->json($data);
        }
    }


    public function store(Request $request)
    {
        return Company::create([
            'name' => $request['name'],
            'image' => $request['image'],
        ]);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
