<?php

namespace App\Http\Controllers\api;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mandob;
use App\order_unit;
use App\Option;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class mandobs extends Controller
{
   use ApiResponceTrait ;
   
   
       public function index()
    {
       $mandob = Mandob::all();
       return $this->ApiResponce($mandob);
    }

    public function store(Request $request)
    {

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }
    public function update(Request $request )
    {

    }
    public function destroy($id)
    {

    }

    /*
     * Show Orders For The Mandob
     */
    public function getOrders($mondob_id){
        $mandob = Mandob::findOrFail($mondob_id);
        $orders = $mandob->orders()->where('is_complete',1)->orderBy('date_of_order', 'desc')->get();
        if($orders->count())
        {
            foreach ($orders as $order){
               $store_id= $order->store_id;
                $order->price_total_sum = floatval($order->price_total_sum);
                $order->price_unit_sum = floatval($order->price_unit_sum);
                $order->units = $order->order_units()->get();
                foreach ($order->units as $unit)
                {
                    $waiting =  $unit->product->waiting_status;
                    $unit->waiting_status = $waiting;
                    unset($unit["product"]);
                    
                    
                    
                $product=$unit->product;

            // return  $store_id;
            $clone_product = $product->replicate();
            
            // return $product->infos()->wherePivot('store_id', '=', $store_id)->get();
            
             $product_customs = $product->infos()->wherePivot('store_id',$store_id)->get()->first();
//            --------------
            if(Option::findOrFail(3)->is_active)
            {
                $product_all = $product->infos;
                $product->quantity_info = $product_all->pluck('quantity')->sum();
                $product->quantity_unit_info = $product_all->pluck('quantity_unit')->sum();
            }
            else
            {
                $product->quantity_info = $product_customs->quantity;
                $product->quantity_unit_info = $product_customs->quantity_unit;
            }
//            --------------
            /* دمج جميع المنتجات اللي اطلبت ومكافأهها من الكميه لكي لا يطلب اكثر من المتاح */
            $order_units = order_unit::whereHas('order',function ($query) use ($store_id){
                $query->where([
                    ['store_id' , '=' ,$store_id],
                    ['is_complete' , '=' ,1],
                    ['is_direct_sell' , '=' ,0],
                    ['order_stage_id' , '<' ,5],
                ]);
            })->get();
            $minus_total = $order_units->sum('quantity_total');
            $minus_unit = $order_units->sum('quantity_unit');
            $product->quantity_info = $product->quantity_info - $minus_total;
            $product->quantity_unit_info = $product->quantity_unit_info - $minus_unit;
            if ($product->quantity_info < 0)
            {
                $product->quantity_info =0;
            }
            if ($product->quantity_unit_info < 0)
            {
                $product->quantity_unit_info =0;
            }
            /*------------------------------------------------------------------------*/
            $product->reorder_limit = $product_customs->reorder_limit;
            $product->sp_unit_percentage = $product_customs->sp_unit_percentage;
            $product->sp_total_percentage	 = $product_customs->sp_total_percentage;
            $product->buy_price = $product_customs->buy_price;
            $product->sp_unit_price =  $product_customs->sell_unit($clone_product);
            $product->sp_total_price =  $product_customs->sell_total;
            $product->images;
                    
                    
                    
                    
                }
            }
        }

        return $this->ApiResponce($orders);
    }

    public function receiveOrder($id , $order_id){
        $mandob = Mandob::findOrFail($id);
        $orders = $mandob->orders()->get();
        if ($orders->contains($order_id)){
            $order = Order::findOrFail($order_id);
            $order->update([
                'mondob_stage_id' => 1
            ]);
        }
        return $this->ApiResponce($order);
    }

    public function deliverOrder($id , $order_id){
        $mandob = Mandob::findOrFail($id);
//        $order = Order::findOrFail($order_id);
        $orders = $mandob->orders()->where('transfer_id','!=',null)->get();
       return  $orders;
        if ($orders->contains($order_id)){
            $order = Order::findOrFail($order_id);
            $order->update([
                'mondob_stage_id' => 2
            ]);
        }
    }

    /*
     * Sign In Mandob
     */
    public function signIn(Request $request){
        // Attempt to log the user in
        $mandob = Mandob::where([
           ['phone','=',$request->phone],
        ])->get()->first();
//        dd($request->phone);
        if (!is_null($mandob))
        {
            if (Hash::check($request->password, $mandob->password))
            {
                return $mandob;
            }
        }
        return $this->ApiResponce(false);
    }

    public function getBackOrders($mandob_id){
        $mandob = Mandob::findOrFail($mandob_id);
        $orders =  $mandob->orders()->where('mondob_stage_id',5)->get();
        foreach ($orders as $order) {
            $order->price_total_sum = floatval($order->price_total_sum);
            $order->price_unit_sum = floatval($order->price_unit_sum);
            $order->units = $order->order_units()->get();
        }
        return $this->ApiResponce($orders);
    }

    public function deliverBackOrder($id , $order_id , $paid){
        $mandob = Mandob::findOrFail($id);
//        $order = Order::findOrFail($order_id);
        $orders = $mandob->orders()->where('mondob_stage_id',5)->get();
        if ($orders->contains($order_id)){
            $order = Order::findOrFail($order_id);
            $order->update([
                'mondob_stage_id' => 6, 
                'received_money' => $paid,
            ]);
        }
        return $order;
    }
    
    
    
    public function deliverReceivedMoneyFromOrder($id , $order_id ,$paid){
        $mandob = Mandob::findOrFail($id);
        $orders = $mandob->orders()->where('mondob_stage_id',3)->get();
        if ($orders->contains($order_id)){
            $order = Order::findOrFail($order_id);
            $order->update([
                'received_money' => $paid,
            ]);
        }
        return $orders;
    }
   
   
//   old data

//     public function index()
//     {
//       $mandob = Mandob::all();
//       return $this->ApiResponce($mandob);
//     }

//     public function store(Request $request)
//     {

//     }
//     /**
//      * Display the specified resource.
//      *
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
//     public function show($id)
//     {

//     }
//     public function update(Request $request )
//     {

//     }
//     public function destroy($id)
//     {

//     }

//     /*
//      * Show Orders For The Mandob
//      */
//     public function getOrders($mondob_id){
//         $mandob = Mandob::findOrFail($mondob_id);
//         $orders = $mandob->orders()->where('is_complete',1)->get();
//         if($orders->count())
//         {
//             foreach ($orders as $order){
//                 $order->price_total_sum = floatval($order->price_total_sum);
//                 $order->price_unit_sum = floatval($order->price_unit_sum);
//                 $order->units = $order->order_units()->get();
//                 foreach ($order->units as $unit)
//                 {
//                     $waiting =  $unit->product->waiting_status;
//                     $unit->waiting_status = $waiting;
//                     unset($unit["product"]);
//                 }
//             }
//         }

//         return $this->ApiResponce($orders);
//     }

//     public function receiveOrder($id , $order_id){
//         $mandob = Mandob::findOrFail($id);
//         $orders = $mandob->orders()->get();
//         if ($orders->contains($order_id)){
//             $order = Order::findOrFail($order_id);
//             $order->update([
//                 'mondob_stage_id' => 1,
//                 'order_stage_id' => 4
//             ]);
//         }
//         return $this->ApiResponce($order);
//     }

//     public function deliverOrder($id , $order_id){
//         $mandob = Mandob::findOrFail($id);
// //        $order = Order::findOrFail($order_id);
//         $orders = $mandob->orders()->where('transfer_id','!=',null)->get();
//         if ($orders->contains($order_id)){
//             $order = Order::findOrFail($order_id);
//             $order->update([
//                 'mondob_stage_id' => 2
//             ]);
//         }
//     }

//     /*
//      * Sign In Mandob
//      */
//     public function signIn(Request $request){
//         // Attempt to log the user in
//         $mandob = Mandob::where([
//           ['phone','=',$request->phone],
//         ])->get()->first();
// //        dd($request->phone);
//         if (!is_null($mandob))
//         {
//             if (Hash::check($request->password, $mandob->password))
//             {
//                 return $mandob;
//             }
//         }
//         return $this->ApiResponce(false);
//     }

//     public function getBackOrders($mandob_id){
//         $mandob = Mandob::findOrFail($mandob_id);
//         $orders =  $mandob->orders()->where('mondob_stage_id',5)->get();
//         foreach ($orders as $order) {
//             $order->price_total_sum = floatval($order->price_total_sum);
//             $order->price_unit_sum = floatval($order->price_unit_sum);
//             $order->units = $order->order_units()->get();
//         }
//         return $this->ApiResponce($orders);
//     }

//     public function deliverBackOrder($id , $order_id){
//         $mandob = Mandob::findOrFail($id);
// //        $order = Order::findOrFail($order_id);
//         $orders = $mandob->orders()->where('mondob_stage_id',5)->get();
//         if ($orders->contains($order_id)){
//             $order = Order::findOrFail($order_id);
//             $order->update([
//                 'mondob_stage_id' => 6
//             ]);
//         }
//     }
}
