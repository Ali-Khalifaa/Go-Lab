<?php

namespace App\Http\Controllers\api;

use App\Dept;
use App\lose;
use App\Mandob;
use App\mondob_rate;
use App\Option;
use App\Order_stage;
use App\order_unit;
use App\Traits\NotificationTrait;
use App\User;
use App\user_rate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use App\Product;

class orders extends Controller
{
    use ApiResponceTrait ;
    use NotificationTrait;

    public function index($id)
    {
        $user = User::findOrFaiL($id);
        $orders= $user->orders->get();
        foreach ($orders as $order){
            if (!is_null($order)){
                $order->units = $order->order_units()->get();
            }
            else
            {
                $order->units = false;
            }
        }
        return  $this->ApiResponce($orders);
    }

    public function store(Request $request)
    {
        $order = new Order([
            'user_id' => $request['user_id'],
            'store_id' => $request['store_id'],
            'comment' => $request['comment'],
            'price_total_sum' => 0,
            'price_unit_sum' => 0,
            'date_of_order' => now()
        ]);
        $order->save();
        $order_unit = new order_unit([
            'quantity_total' => $request['unit']['quantity_total'],
            'quantity_unit' => $request['unit']['quantity_unit'],
            'receive_total' => $request['unit']['quantity_total'],
            'receive_unit' => $request['unit']['quantity_unit'],
            'product_id' => $request['unit']['product_id'],
            'order_id' => $order->id,
            
        ]);
        $order_unit->save();
        $product_info = $order_unit->product->infos()->wherePivot('store_id','=',$request['store_id'])->get()->first();
        $order->update([
            'price_total_sum' => $order_unit->quantity_total * $product_info->sell_total,
            'price_unit_sum' => $order_unit->quantity_unit * $product_info->sell_unit($order_unit->product),
        ]);
        
        $order_unit->update([
            'price'=>$product_info->sell_total,
            'price_unit'=>$product_info->sell_unit($order_unit->product),
        ]);

        $checkOfferTotal = $this->checkOfferTotal($order);
        $notify = $this->preCheckNotify($order->id);

        $data['order_id']=$order->id;
        $data['order_unit_id']=$order_unit->id;
        $data['check_offer_total']=$checkOfferTotal;
        $data['notify']=$notify;
        $data['cashback']=$this->getCashBack($order->user->id);

        return  $this->ApiResponce($data);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);
        $order->units = $order->order_units()->get();
        return  $this->ApiResponce($order);

    }

    public function update(Request $request )
    {
        $price_total_sum=0;
        $price_unit_sum=0;
        $order = Order::findOrFail($request->order_id);
        $order->update([
            'comment' => $request['comment'],
        ]);
        if (isset($request->type))
        {
            /*
             * Add Unit To Order
             */
            if ($request->type == 'add')
            {
                // Add Unit
                
                $order_unit = new order_unit([
                    'quantity_total' => $request['unit']['quantity_total'],
                    'quantity_unit' => $request['unit']['quantity_unit'],
                    'receive_total' => $request['unit']['quantity_total'],
                    'receive_unit' => $request['unit']['quantity_unit'],
                    'product_id' => $request['unit']['product_id'],
                    'order_id' => $order->id,
                ]);
                $order_unit->save();
                $product_info = $order_unit->product->infos()->wherePivot('store_id','=',$order->store->id)->get()->first();
                
                $order_unit->update([
                        'price'=>$product_info->sell_total,
                        'price_unit'=>$product_info->sell_unit($order_unit->product),
                    ]);
                // Update Total Price by Quantity

                foreach ($order->order_units as $order_unit)
                {
                    $product_info = $order_unit->product->infos()->wherePivot('store_id','=',$order->store->id)->get()->first();

                    $price_total_sum+= $order_unit->quantity_total * $product_info->sell_total;
                    $price_unit_sum+= $order_unit->quantity_unit * $product_info->sell_unit($order_unit->product);
                    
                    
                }
                $order->update([
                    'price_total_sum' => $price_total_sum,
                    'price_unit_sum' => $price_unit_sum,

                ]);
            }
            /*
             * Delete Unit From Order
             */
            elseif($request->type == 'delete'){
                $order_unit = order_unit::findOrFail($request->unit_id);
                $order_unit->delete();
                // Update Total Price by Quantity

                foreach ($order->order_units as $order_unit)
                {
                    $product_info = $order_unit->product->infos()->wherePivot('store_id','=',$order->store->id)->get()->first();

                    $price_total_sum+= $order_unit->quantity_total * $product_info->sell_total;
                    $price_unit_sum+= $order_unit->quantity_unit * $product_info->sell_unit($order_unit->product);
                }
                $order->update([
                    'price_total_sum' => $price_total_sum,
                    'price_unit_sum' => $price_unit_sum,

                ]);
            }
            elseif ($request->type == 'update'){
                $order_unit = order_unit::findOrFail($request->unit_id);
                $product_info = $order_unit->product->infos()->wherePivot('store_id','=',$order->store->id)->get()->first();
                /*
                 * Update the Quantity
                 */
                $order_unit->update([
                    'quantity_total' => $request['unit']['quantity_total'],
                    'quantity_unit' => $request['unit']['quantity_unit'],
                    'receive_total' => $request['unit']['quantity_total'],
                    'receive_unit' => $request['unit']['quantity_unit'],
                ]);
                
                $order_unit->update([
                    'price'=>$product_info->sell_total,
                    'price_unit'=>$product_info->sell_unit($order_unit->product),
                ]);

                // Update Total Price by Quantity

                foreach ($order->order_units as $order_unit)
                {
                    $product_info = $order_unit->product->infos()->wherePivot('store_id','=',$order->store->id)->get()->first();

                    $price_total_sum+= $order_unit->quantity_total * $product_info->sell_total;
                    $price_unit_sum+= $order_unit->quantity_unit * $product_info->sell_unit($order_unit->product);
                }
                $order->update([
                    'price_total_sum' => $price_total_sum,
                    'price_unit_sum' => $price_unit_sum,

                ]);
            }
        }

        $checkOfferTotal = $this->checkOfferTotal($order);
        $notify = $this->preCheckNotify($order->id);

        $data['order_id']=$order->id;
        $data['check_offer_total']=$checkOfferTotal;
        $data['notify']=$notify;
        $data['cashback']=$this->getCashBack($order->user->id);

        return  $data;
    }

    public function destroy($id)
    {
        $order = Order::find($id);
        foreach ($order->order_units()->get() as $order_unit){
            $order_unit->delete();
        }
        $order->delete();
        return ['message' => 'order Deleted'];
    }

    public function mandobOrderStatus(Request $request,$id){
        $order = Order::find($id);
        $order = Order::where('order_id' , $id)->get();
        foreach($order as $orde){
            $orde->mandob_stage = $request->mandob_stage;
            $orde->mandob_date = $request->mandob_date;
            $orde->save();
        }
        return  $this->ApiResponce($orde);
    }

    public function getOrdersByUser($id,$is_complete =''){
        $user = User::find($id);
        if(!is_null($user)){
            $orders= $user->orders();

            if($is_complete !=='')
            {
                $orders = $orders->where('is_complete',$is_complete);
            }
            $orders = $orders->get();
            // $orders = $orders->get();
            if($orders->count())
            {
                foreach ($orders as $order){
                    $order->units = $order->order_units()->get();
                    $store_id=$order->store_id;
                    foreach ($order->units as $unit)
                    {
                        $waiting =  $unit->product->waiting_status;
                        $unit->waiting_status = $waiting;
                        unset($unit["product"]);
                        
            $product=$unit->product;
            
            
            $clone_product = $product->replicate();
            $product_customs = $product->infos()->wherePivot('store_id','=',$store_id)->get()->first();
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
            // $product->quantity_info = $product->quantity_info - $minus_total;
            // $product->quantity_unit_info = $product->quantity_unit_info - $minus_unit;
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
            return  $this->ApiResponce($orders);
        }
        else
        {
            return  $this->ApiResponce(
                'user not found'
            );
        }

    }

    public function completeOrder($id){
        
        // start test 
        $order = Order::findOrFail($id);
        
        $total_minus_paid = 0;
            $notify = $this->checkNotify($id);
            if ($notify['notify'])
            {
 
                $revenue = $this->getTotalDiscount($notify,$order);
                $discounts = $this->calculateTotal($id , $revenue,$notify);
                $total_minus_paid += $discounts['total_discount_now'] + $discounts['unit_discount_now'];
                $int_value=$total_minus_paid;
                $order->update([
                    'minus_notify' =>  $discounts['total_discount_now'] + $discounts['unit_discount_now'],
                    'total_minus_paid' =>$discounts['total_discount_now'] + $discounts['unit_discount_now'],
                ]);
            // return    $order;
                if ($discounts['total_discount_later'] + $discounts['unit_discount_now'] >0 )
                {
                    $dept = new Dept([
                        'user_id' => $order->user->id,
                        'order_id' => $order->id,
                        'total' => $discounts['total_discount_later'] + $discounts['unit_discount_now'],
                        'paid'  =>  0,
                        'date'  =>  Carbon::now()->addMonths(1)
                    ]);
                    $dept->save();
                }
                else
                {
                    $dept = false;
                }
            }
            // return 'end';
        
        // end test 
        
        // $order = Order::findOrFail($id);
        $order->update([
            'is_complete' => 1
        ]);
        return  $this->ApiResponce($order);
    }

    public function getAllStages(){
        $order_stages = Order_stage::all();
        return  $this->ApiResponce($order_stages);

    }

    public function checkNotifyOrder($order_id)
    {
        $revenue = $this->preCheckNotify($order_id);
        if (is_a($revenue['notify'],'App\Notify_user'))
        {
            $revenue['units']= $revenue['notify']->notify_user_units;
            unset($revenue['notify']['notify']);
            unset($revenue['notify']['notify_user_units']);
        }
        elseif(is_a($revenue['notify'],'App\Notify'))
        {
            $revenue['units']= $revenue['notify']->notify_units;
            unset($revenue['notify']['notify']);
            unset($revenue['notify']['notify_units']);
        }
        return  $this->ApiResponce($revenue);
    }

    public function userWallet($user_id){
        if (Option::find(4)->is_active)
        {
            return $this->getCashBack($user_id);
        }
        $user = User::findOrFail($user_id);
        return  $this->ApiResponce($user->depts);

    }

    public function deliverOrder(Request $request , $order_id){
        // return  $order_id;
        // elmnofy
        $order = Order::findOrFail($order_id);
        //gemy
        $store_id=$order->store_id;
        //gemy
        
        // return $order->mondob_stage_id;
        if ($order->mondob_stage_id >= '2')
        {
            return  $this->ApiResponce(false);
        }
        

        //gemy
        $final_final_total_price=0;
        $final_final_unit_price=0;
        $final_recall_total_price=0;
        $final_recall_unit_price=0;
        $receive_total=0;
        $receive_unit=0;
        $recall_total=0;
        $recall_unit=0;
        $recall_total_price=0;
        $recall_unit_price=0;
        //gemy
         
         
         
         
        
        foreach ($request->all() as $item) {
            $order_unit = $order->order_units()->where('product_id', $item['product_id'])->get()->first();
            $recall_total=$order_unit->quantity_total - $item['receive_total'];
         $recall_unit=$order_unit->quantity_unit - $item['receive_unit'];
            $info = $order_unit->product->infos()->wherePivot('store_id',$order->store->id)->get()->first();
            $order_unit->update([
                'receive_total' => $item['receive_total'],
                'receive_unit' => $item['receive_unit'],
                'recall_total' => $order_unit->quantity_total - $item['receive_total'],
                'recall_unit' => $order_unit->quantity_unit - $item['receive_unit'],
            ]);
            
            //gemy
           $product = Product::findOrFail($item['product_id']); 
           $clone_product = $product->replicate();
           $product_customs = $product->infos()->wherePivot('store_id','=',$store_id)->get()->first();
           $product_sp_unit_price =  $product_customs->sell_unit($clone_product);
           $product_sp_total_price =  $product_customs->sell_total;
           $receive_total=$item['receive_total'];
           $receive_unit=$item['receive_unit'];
           $final_total_price=$receive_total*$product_sp_total_price;
           $final_unit_price=$receive_unit*$product_sp_unit_price;
           
           $recall_total_price=$order_unit->recall_total*$product_sp_total_price;
           $recall_unit_price=$order_unit->recall_unit*$product_sp_unit_price;
           
           
           $final_final_total_price+=$final_total_price;
           $final_final_unit_price+=$final_unit_price;
           
           $final_recall_total_price+=$recall_total_price;
           $final_recall_unit_price+=$recall_unit_price;
           //gemy
           
           if($order_unit['recall_total']>0)
                {
                    
                    $final_quantity_unit=($product->quantity_unit*$order_unit['recall_total'])+$order_unit['recall_unit'];
                    
                }
                else{
                    $final_quantity_unit=$order_unit['recall_unit'];
                }
                
                $data_gededa=($info->quantity+($order_unit['recall_total']+($order_unit['recall_unit']/$product->quantity_unit)));
                
                $info->update([
                    
                    'quantity' => $data_gededa,
                    
                    'quantity_unit' => $info->quantity_unit + $final_quantity_unit,
                ]);
           
           
        }
        
        
        
        
        $order->update([
            'mondob_stage_id' => 2,
            'order_stage_id' => 5,
            // 'has_recall'=>1,
            'recall_total_price'=>$order->recall_total_price+$final_recall_total_price,
            'recall_unit_price'=>$order->recall_unit_price+$final_recall_unit_price,
            
        ]);
        
        if($recall_total!=0 || $recall_unit!=0)
        {
            $order->update([
            'has_recall'=>1,
        ]);
        
        
            
        
        
        }
        /*------------------------------------*/
        $total_minus_paid = 0;
        $notify = $this->checkNotify($order_id);
        if ($notify['notify'])
        {
            $revenue = $this->getTotalDiscount($notify,$order);
            $discounts = $this->calculateTotal($order_id , $revenue,$notify);
            $total_minus_paid += $discounts['total_discount_now'] + $discounts['unit_discount_now'];
        }
        // check cashback
        // if (Option::find(4)->is_active)
        // {
        //     $cashback = $this->getCashBack($order->user->id);
        //     if ($cashback)
        //     {
        //         $total_minus_paid += $cashback;
        //     }
        // }
        if (Option::find(4)->is_active)
            {
                $cashback = $this->getCashBackOfAllExceptWithOrderId($order->user->id ,$order->id );
                $cashback_of_current_order_id = $this->getCashBackOfCurrentOrderId($order->user->id ,$order->id);
                
                if ($cashback)
                {
                    
                    $second_last_order=$order->user->orders()->orderBy('created_at', 'desc')->skip(1)->take(1)->get()->first();
                    if($second_last_order!=null)
                    {
                        
                    if($second_last_order->future_cash_back!=0)
                    {
                        $order->update([
                        'cash_back' => $second_last_order->future_cash_back + $cashback ,
                        ]);
                        // $total_minus_paid += $order->cash_back;
                        $dept = $order->user->depts()->first();
                        $dept->paid=$order->cash_back;
                        $dept->save();
                    }
                    // // if user has cash back before we will add cash back in walet in current order 
                    // elseif($second_last_order->future_cash_back==0 && $order->cash_back==0 ){
                    
                    //     $total_minus_paid += $order->cash_back;
                    //     $dept = $order->user->depts()->first();
                    //     $dept->paid=$order->cash_back;
                    //     $dept->save();
                    // }

                    }
                    
                    if($cashback_of_current_order_id)
                    {
                        
                        $order->update([
                        'future_cash_back' =>  $cashback_of_current_order_id
                        ]);
                    }
                    // $this->applyCashBack($order->user->id);
                    
                // if ($cashback)
                // {
                    
                // }
                    
                    
                }
            }
        // check offer total
        $checkOfferTotal = $this->checkOfferTotalFinal($order);
        if(!$checkOfferTotal==null)
        {
            
        
        if ($checkOfferTotal['min_total'])
        {
            $total_minus_paid += $checkOfferTotal['total_minus'];
        }
        if ($checkOfferTotal['min_unit'])
        {
            $total_minus_paid += $checkOfferTotal['unit_minus'];
        }
        }






        // $total_after_dis = $order->price_total_sum + $order->price_unit_sum - $total_minus_paid;
        //gemy
        $total_after_dis = $final_final_total_price + $final_final_unit_price - $total_minus_paid;
        // gemy
        
        
        $order->update([
            'rest_value'   =>  $total_after_dis
        ]);
       
        $data['check_offer_total']=$checkOfferTotal;
        $data['notify']=$notify;
        $data['cashback']=$this->getCashBack($order->user->id);
        $data['total_after_discount'] = $total_after_dis;
        return  $data;

    }

    public function confirmOrder($order_id){
        $order = Order::findOrFail($order_id);
        if($order->mondob_stage_id == 2 && $order->order_stage_id ==5)
        {
            // return'iam here';
            $order = Order::findOrFail($order_id);
            /*
             * Update Order Status
             */
            $order->update([
                'order_stage_id' => 5
            ]);

            $store = $order->store;
            $order_units = $order->order_units;
            /*
             * Update Mandob Stage
             */
            $order->update([
                'mondob_stage_id' => 3
            ]);
            $lose =0;
            foreach ($order_units as $order_unit)
            {
                $info = $order_unit->product->infos()->wherePivot('store_id',$order->store->id)->get()->first();
                if (($order_unit->receive_total < $order_unit->quantity_total) || ($order_unit->receive_unit < $order_unit->quantity_unit))
                {
                    $order->update([
                        'mondob_stage_id' => 5
                    ]);
                }
                $lose += $info->loss * $order_unit->quantity_total;
                $lose += ($info->loss / $order_unit->product->quantity_unit ) * $order_unit->quantity_unit;
            }
            // calculate loss
            // Make new Lose If bigger than 0
            if ($lose){
                $lose_obj = new lose([
                    'store_id'  =>  $order->store_id,
                    'order_id'  =>  $order->id,
                    'loss'  =>  $lose,
                ]);
                $lose_obj->save();
            }


            /*------------------------------------*/
            $total_minus_paid = 0;
            $notify = $this->checkNotify($order_id);
            if ($notify['notify'])
            {
                $revenue = $this->getTotalDiscount($notify,$order);
                $discounts = $this->calculateTotal($order_id , $revenue ,$notify);
                $total_minus_paid += $discounts['total_discount_now'] + $discounts['unit_discount_now'];
                $int_value=$total_minus_paid;
                $order->update([
                    'minus_notify' =>  $discounts['total_discount_now'] + $discounts['unit_discount_now'],
                    'total_minus_paid' =>$int_value,
                ]);
                if ($discounts['total_discount_later'] + $discounts['unit_discount_now'] >0 )
                {
                    // $dept = new Dept([
                    //     'user_id' => $order->user->id,
                    //     'order_id' => $order->id,
                    //     'total' => $discounts['total_discount_later'] + $discounts['unit_discount_now'],
                    //     'paid'  =>  0,
                    //     'date'  =>  Carbon::now()->addMonths(1)
                    // ]);
                   
                }
                else
                {
                    $dept = false;
                }
            }
            // check cashback
            if (Option::find(4)->is_active)
            {
                $cashback = $this->getCashBackOfAllExceptWithOrderId($order->user->id ,$order->id );
                $cashback_of_current_order_id = $this->getCashBackOfCurrentOrderId($order->user->id ,$order->id);
                
                if ($cashback)
                {
                    
                    $second_last_order=$order->user->orders()->orderBy('created_at', 'desc')->skip(1)->take(1)->get()->first();
                    if($second_last_order!=null)
                    {
                        
                    if($second_last_order->future_cash_back!=0)
                    {
                        $order->update([
                        'cash_back' => $second_last_order->future_cash_back + $cashback ,
                        ]);
                        // $total_minus_paid += $order->cash_back;
                        // $dept = $order->user->depts()->first();
                        // $dept->paid=$order->cash_back;
                        // $dept->save();
                    }
                    // // if user has cash back before we will add cash back in walet in current order 
                    // elseif($second_last_order->future_cash_back==0 && $order->cash_back==0 ){
                    
                    //     $total_minus_paid += $order->cash_back;
                    //     $dept = $order->user->depts()->first();
                    //     $dept->paid=$order->cash_back;
                    //     $dept->save();
                    // }

                    }
                    
                    
                    // $this->applyCashBack($order->user->id);
                    
                // if ($cashback)
                // {
                    
                // }
                    
                    
                }else{
                    $second_last_order=$order->user->orders()->orderBy('created_at', 'desc')->skip(1)->take(1)->get()->first();
                    if($second_last_order!=null)
                    {
                        
                    if($second_last_order->future_cash_back!=0)
                    {
                        $order->update([
                        'cash_back' => $second_last_order->future_cash_back  ,
                        ]);
                        // $total_minus_paid += $order->cash_back;
                }
                    }
                }
                
                if($cashback_of_current_order_id)
                    {
                        
                        $order->update([
                        'future_cash_back' =>  $cashback_of_current_order_id
                        ]);
                        
                        $dept = $order->user->depts()->first();
                        $dept->paid=$order->future_cash_back;
                        $dept->save();
                    }
                
            }
            // check offer total
            $checkOfferTotal = $this->checkOfferTotalFinal($order);
            if ($checkOfferTotal['min_total'])
            {
                $total_minus_paid += $checkOfferTotal['total_minus'];
                $order->update([
                    'total_minus' =>  $checkOfferTotal['total_minus']
                ]);
            }
            if ($checkOfferTotal['min_unit'])
            {
                $total_minus_paid += $checkOfferTotal['unit_minus'];
                $order->update([
                    'unit_minus' =>  $checkOfferTotal['unit_minus']
                ]);
            }

            $total_after_dis = $order->price_total_sum + $order->price_unit_sum - $total_minus_paid;
            $order->update([
                'rest_value'   =>  0,
                'paid_value'   => $total_after_dis,
                'total_minus_paid'   => $total_minus_paid,
            ]);

            $order->mandob()->update([
                'wallet' => $order->mandob->wallet + $order->paid_value
            ]);

            $data['order']=$order;
            $data['store']=$store;
            $data['order_units']=$order_units;
            $data['check_offer_total']=$checkOfferTotal;
            $data['notify']=$notify;
            $data['dept']=0;
            $data['cashback']=$this->getCashBack($order->user->id);
            $data['total_after_discount'] = $total_after_dis;

            return  $data;
        }
        else
        {
            return  $this->ApiResponce('cant confirm right now');
        }
    }

    public function seeBill($order_id){
        $order = Order::findOrFail($order_id);
        $store = $order->store;

        $data['order']=$order;
        $data['store'] = $store;

        return  $data;
    }

    public function rateMandob(Request $request , $order_id){
        $order = Order::findOrFail($order_id);
        $rate = new mondob_rate([
            'rate'  => intval($request->rate),
            'mandob_id'  => $order->mandob_id,
            'order_id'  => $order->id,
        ]);
        $rate->save();
        return  $this->ApiResponce($rate);
    }

    public function rateUser(Request $request , $order_id){
        $order = Order::findOrFail($order_id);
        $rate = new user_rate([
            'rate'  => intval($request->rate),
            'user_id'  => $order->mandob_id,
            'order_id'  => $order->id,
        ]);
        $rate->save();
        return  $this->ApiResponce($rate);
    }

    public function userDepts($user_id){
        $user = User::findOrFail($user_id);
        $orders = $user->orders()->where([
            ['is_complete','=',1],
            ['rest_value','>',0],
            ['order_stage_id','=',5]
        ])->get();
        return  $this->ApiResponce($orders);
    }

    public function getTransfers($mandob_id){
        $mandob = Mandob::findOrFail($mandob_id);

        $transfers = $mandob->orders()->where('transfer_id','!=',null)->get();

        foreach ($transfers as $transfer)
        {
            $transfer->from = $transfer->transfer->from_store;
            $transfer->to = $transfer->transfer->to_store;
        }
        unset($transfer->transfer);
        return  $this->ApiResponce($transfers);
    }
}
