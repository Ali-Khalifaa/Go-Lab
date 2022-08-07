<?php

namespace App\Http\Controllers\api;

use App\Notify;
use App\Option;
use App\order_unit;
use App\Product;
use App\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class Search extends Controller
{
    use ApiResponceTrait;

    public function searchProduct (Request $request){
        /*
         * Get Store Products
         */

        $store = Store::all()->first();
        // dd($store);
        $store_id = $store->id;
        $products = $store->products()->where('is_hidden', '=', 0)->when($request->name,function($q) use($request)
        {
            return $q->where('name', 'LIKE', '%' . $request->name . '%')
                ->orWhere('name_en', 'LIKE', '%' . $request->name . '%');
        })->orderBy('rank_code')->paginate(20);
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
                $product->store_id = $store_id;
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

    public function getMaxMainPriceProduct(){
        $data = [];
        $max = Product::max('price_total');
        $min = Product::min('price_total');
        $data['max_price'] = $max;
        $data['min_price'] = $min;
        return response()->json($data);
    }

    public function searchByCategoryAndCompany (Request $request){

        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'company_id' => 'required',
            'start_price' => 'required',
            'end_price' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }
        $data=[];
        $products = Product::with('productImages')->where([
            ['is_hidden', '=', 0],
            ['category_id', '=', $request->category_id],
            ['company_id', '=', $request->company_id],
            ['price_total', '>=', $request->start_price],
            ['price_total', '<=', $request->end_price],
        ])->orderBy('rank_code')->paginate(20);

        $lang = $request->header('lang');

        foreach ($products as $index => $product) {

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

        $data['products'] = $products;

        return $this->ApiResponce($data);
    }
}
