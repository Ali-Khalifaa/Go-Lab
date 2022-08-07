<?php

namespace App\Http\Controllers\api;

use App\Store;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mostproduct;
use App\Product;
use App\Option;
use App\order_unit;
use Illuminate\Support\Facades\DB;

class mostproducts extends Controller
{
    use ApiResponceTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index($store)
    {
        $store = Store::findOrFail($store);
        $store_id = $store->id;
        $orders = $store->orders()->where('is_complete', 1)
            ->with('order_units')
            ->join('order_units', 'order_units.order_id', '=', 'orders.id')
            ->join('products', 'order_units.product_id', '=', 'products.id')
            ->select('product_id', 'products.*', DB::raw('COUNT(product_id) as count'))
            ->groupBy('product_id')
            ->orderBy('count', 'desc')
            ->take(10)->get();

        foreach ($orders as $index => $order) {
            {
                $product = Product::where('id', $order->id)->first();
                $clone_product = $product->replicate();

                $product_customs = $product->infos()->wherePivot('store_id', '=', $store_id)->get()->first();

//            --------------
                if (Option::findOrFail(3)->is_active) {
                    $product_all = $order->infos;
                    $order->quantity_info = $product_all->pluck('quantity')->sum();
                    $order->quantity_unit_info = $product_all->pluck('quantity_unit')->sum();
                } else {

                    $order->quantity_info = $product_customs->quantity;
                    $order->quantity_unit_info = $product_customs->quantity_unit;
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
                // $minus_total = $order_units->sum('quantity_total');
                // $minus_unit = $order_units->sum('quantity_unit');
                $order->quantity_info = $order->quantity_info;
                $order->quantity_unit_info = $order->quantity_unit_info;

                if ($order->quantity_info < 0) {
                    $order->quantity_info = 0;
                }
                if ($order->quantity_unit_info < 0) {
                    $order->quantity_unit_info = 0;
                }

                /*------------------------------------------------------------------------*/
                $order->reorder_limit = $product_customs->reorder_limit;
                $order->sp_unit_percentage = $product_customs->sp_unit_percentage;
                $order->sp_total_percentage = $product_customs->sp_total_percentage;
                $order->buy_price = $product_customs->buy_price;
                $order->sp_unit_price = $product_customs->sell_unit($clone_product);
                $order->sp_total_price = $product_customs->sell_total;
                $order->images;
            }
            // return  $this->ApiResponce($orders);

        }


        return $this->ApiResponce($orders);

    }


    public function indexApple()
    {
        $store_id = auth()->user()->store_id;
        if ($store_id == 0) {
            $store = Store::all()->first();
            $store_id = $store->id;
        } else {
            $store = Store::findOrFail($store_id);
            $store_id = $store->id;
        }

        // $store = Store::all()->first();
        // $store_id=$store->id;
        $orders = $store->orders()->where('is_complete', 1)
            ->with('order_units')
            ->join('order_units', 'order_units.order_id', '=', 'orders.id')
            ->join('products', 'order_units.product_id', '=', 'products.id')
            ->select('product_id', 'products.*', DB::raw('COUNT(product_id) as count'))
            ->groupBy('product_id')
            ->orderBy('count', 'desc')
            ->take(10)->get();
        foreach ($orders as $index => $order) {
            {
                $product = Product::where('id', $order->id)->first();
                $clone_product = $product->replicate();

                $product_customs = $product->infos()->wherePivot('store_id', '=', $store_id)->get()->first();

//            --------------
                $option = Option::findOrFail(3)->is_active;
                if ($option != null && $order->infos) {
                    $product_all = $order->infos;
                    $order->quantity_info = $product_all->pluck('quantity')->sum();
                    $order->quantity_unit_info = $product_all->pluck('quantity_unit')->sum();
                } else {

                    $order->quantity_info = $product_customs->quantity;
                    $order->quantity_unit_info = $product_customs->quantity_unit;
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
                // $minus_total = $order_units->sum('quantity_total');
                // $minus_unit = $order_units->sum('quantity_unit');
                $order->quantity_info = $order->quantity_info;
                $order->quantity_unit_info = $order->quantity_unit_info;

                if ($order->quantity_info < 0) {
                    $order->quantity_info = 0;
                }
                if ($order->quantity_unit_info < 0) {
                    $order->quantity_unit_info = 0;
                }

                /*------------------------------------------------------------------------*/
                $order->reorder_limit = $product_customs->reorder_limit;
                $order->sp_unit_percentage = $product_customs->sp_unit_percentage;
                $order->sp_total_percentage = $product_customs->sp_total_percentage;
                $order->buy_price = $product_customs->buy_price;
                $order->sp_unit_price = $product_customs->sell_unit($clone_product);
                $order->sp_total_price = $product_customs->sell_total;
                $order->images;
            }


        }
        return $this->ApiResponce($orders);
    }









//     public function index($store)
//     {
//         $store = Store::findOrFail($store);
//         $orders = $store->orders()->where('is_complete',1)
//             ->with('order_units')
//             ->join('order_units', 'order_units.order_id', '=', 'orders.id')
//             ->join('products', 'order_units.product_id', '=', 'products.id')
//             ->select('product_id','products.*',DB::raw('COUNT(product_id) as count'))
//             ->groupBy('product_id')
//             ->orderBy('count', 'desc')
//             ->take(10)->get();
//         return  $this->ApiResponce($orders);

//     }


//     public function indexApple()
//     {
//         $store = Store::all()->first();
//         $store_id=$store->id;
//         $orders = $store->orders()->where('is_complete',1)
//             ->with('order_units')
//             ->join('order_units', 'order_units.order_id', '=', 'orders.id')
//             ->join('products', 'order_units.product_id', '=', 'products.id')
//             ->select('product_id','products.*',DB::raw('COUNT(product_id) as count'))
//             ->groupBy('product_id')
//             ->orderBy('count', 'desc')
//             ->take(10)->get();
//             foreach($orders as $index => $order){
//             {
//             $product=Product::where('id',$order->id)->first();
//             $clone_product = $product->replicate();

//             $product_customs = $product->infos()->wherePivot('store_id','=',$store_id)->get()->first();

// //            --------------
//             if(Option::findOrFail(3)->is_active)
//             {
//                 $product_all = $order->infos;
//                 $order->quantity_info = $product_all->pluck('quantity')->sum();
//                 $order->quantity_unit_info = $product_all->pluck('quantity_unit')->sum();
//             }
//             else
//             {

//                 $order->quantity_info = $product_customs->quantity;
//                 $order->quantity_unit_info = $product_customs->quantity_unit;
//             }
// //            --------------
//             /* دمج جميع المنتجات اللي اطلبت ومكافأهها من الكميه لكي لا يطلب اكثر من المتاح */
//             $order_units = order_unit::whereHas('order',function ($query) use ($store_id){
//                 $query->where([
//                     ['store_id' , '=' ,$store_id],
//                     ['is_complete' , '=' ,1],
//                     ['is_direct_sell' , '=' ,0],
//                     ['order_stage_id' , '<' ,5],
//                 ]);
//             })->get();
//             $minus_total = $order_units->sum('quantity_total');
//             $minus_unit = $order_units->sum('quantity_unit');
//             $order->quantity_info = $order->quantity_info - $minus_total;
//             $order->quantity_unit_info = $order->quantity_unit_info - $minus_unit;

//             if ($order->quantity_info < 0)
//             {
//                 $order->quantity_info =0;
//             }
//             if ($order->quantity_unit_info < 0)
//             {
//                 $order->quantity_unit_info =0;
//             }

//             /*------------------------------------------------------------------------*/
//             $order->reorder_limit = $product_customs->reorder_limit;
//             $order->sp_unit_percentage = $product_customs->sp_unit_percentage;
//             $order->sp_total_percentage	 = $product_customs->sp_total_percentage;
//             $order->buy_price = $product_customs->buy_price;
//             $order->sp_unit_price =  $product_customs->sell_unit($clone_product);
//             $order->sp_total_price =  $product_customs->sell_total;
//             $order->images;
//         }
//         return  $this->ApiResponce($orders);

//     }
// }

}
