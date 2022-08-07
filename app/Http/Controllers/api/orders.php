<?php

namespace App\Http\Controllers\api;

use App\Coupone;
use App\DefultMongez;
use App\Dept;
use App\Discount;
use App\lose;
use App\Mongez;
use App\PromoCode;
use App\Store;
use App\Mandob;
use App\mondob_rate;
use App\Option;
use App\Order_stage;
use App\order_unit;
use App\Traits\NotificationTrait;
use App\User;
use App\user_rate;
use App\UserMongez;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use App\Sms_Message;
use App\Product;
use DB;

class orders extends Controller
{
    use ApiResponceTrait;
    use NotificationTrait;

    public function index($id)
    {
        $user = User::findOrFaiL($id);
        $orders = $user->orders->get();
        foreach ($orders as $order) {
            if (!is_null($order)) {
                $order->units = $order->order_units()->get();
            } else {
                $order->units = false;
            }
        }
        return $this->ApiResponce($orders);
    }

    public function sms_messages()
    {
        $shop_type = Sms_Message::all()->first();
        return $this->ApiResponce($shop_type);
    }


    public function completeOrderV1(Request $request)
    {
        //check promo code
        $user_id = auth()->user()->id;

        if ($request->promo_code)
        {
            $coupone = Coupone::where('code',$request->promo_code)->first();

            if ($coupone){
                $date_check = Carbon::parse($coupone->end_date);

                if ($date_check->addDay() < now()){
                    return response()->json([
                        'status' => 'error',
                        'success' => false,
                        'message' => 'لقد انتهى التاريخ واصبح هذا الكود قديم جدااا',
                        'error' => "2"
                    ], 200);
                }

                $check_user_coupon = $coupone->users->where('id',1277364559)->first();

                if ($check_user_coupon){
                    return response()->json([
                        'status' => 'error',
                        'success' => false,
                        'message' => 'هذا الكود مستخدم من قبل',
                        'error' => "1"
                    ], 200);
                }
            }else{
                return response()->json([
                    'status' => 'error',
                    'success' => false,
                    'message' => 'هذا الكود خاطئ',
                    'error' => "0"
                ], 200);
            }
        }

        if ($request['store_id'] == 0) {
            $store_id = Store::first()->id;
        } else {
            $store_id = $request['store_id'];
        }

        $order = new Order([
            'user_id' => $user_id,
            'store_id' => $store_id,
            'comment' => $request['comment'],
            'price_total_sum' => 0,
            'price_unit_sum' => 0,
            'date_of_order' => now()
        ]);

        $order->save();

        // start hena

        // $data['order_id']=$order->id;
        // $data['order_unit_id']=$order_unit->id;
        // $data['check_offer_total']=$checkOfferTotal;
        // $data['notify']=$notify;
        // $data['cashback']=$this->getCashBack($order->user->id);
        // end hena

        // start test
        // $order = Order::findOrFail($id);
        // check if units of user available
        // $order_units = $order->order_units;

        foreach ($request->unit as $index => $order_unit) {

            $order_unit = new order_unit([
                'quantity_total' => $order_unit['quantity_total'],
                'quantity_unit' => 0,
                'receive_total' => $order_unit['quantity_total'],
                'receive_unit' => 0,
                'product_id' => $order_unit['product_id'],
                'order_id' => $order->id,

            ]);

            $order_unit->save();

            // start calculating product price

            $product = Product::findOrFail($order_unit->product_id);
            $price_of_total = 0;
            $price_of_unit = 0;

            if ($product->discount_total != 0 && $product->date_end >= now()) {
                $price_of_total = ($product->price_total - $product->discount_total);

            } else {
                $price_of_total = $product->price_total;
            }
            if ($product->discount_unit != 0) {
                $price_of_unit = ($product->price_unit - $product->discount_unit);
            } else {
                $price_of_unit = $product->price_unit;
            }

            // end calculating product price

            $product_info = $order_unit->product->infos()->wherePivot('store_id', '=', $store_id)->get()->first();
            $order->update([
                'price_total_sum' => $order->price_total_sum + ($order_unit->quantity_total * $price_of_total),
                'price_unit_sum' => $order->price_unit_sum + ($order_unit->quantity_unit * $price_of_unit),
            ]);

            $order_unit->update([
                'price' => $price_of_total,
                'price_unit' => $price_of_unit,
            ]);

            $checkOfferTotal = $this->checkOfferTotal($order);
            $notify = $this->preCheckNotify($order->id);

            $info = $order_unit->product->infos()->wherePivot('store_id', $order->store_id)->get()->first();
            if (!$info) {
                $info = $order_unit->product->infos()->wherePivot('store_id', 1)->get()->first();
            }
            $data_gededa = 0;

            // check for quantity_total
            if ($order_unit->quantity_total != 0 && $order_unit->quantity_unit != 0) {
                if ($info->quantity >= $order_unit->quantity_total) {
                    if ($order_unit->quantity_unit > 0) {
                        $final_quantity_unit = ($product->quantity_unit * $order_unit->quantity_total) + $order_unit->quantity_unit;
                        $data_gededa = ($info->quantity - ($order_unit->quantity_total + ($order_unit->quantity_unit / $product->quantity_unit)));
                        // return "here 1";
                    } else {
                        $final_quantity_unit = ($order_unit->quantity_total * $product->quantity_unit);
                        $data_gededa = ($info->quantity - ($order_unit->quantity_total));
                        //  return "here 2";
                    }

                    if ($data_gededa < 0) {
                        $data = array('message' => "there is not enough quantity_total will be in our store", 'product' => $product, 'available_qty' => $info->quantity);
                        return $this->ApiResponce($data);
                    }

//                    if ($final_quantity_unit > $info->quantity_unit) {
//                        $data = array('message' => "there is not enough quantity_unit will be in our store", 'product' => $product, 'available_qty' => $info->quantity_unit);
//                        return $this->ApiResponce($data);
//                        // return  $this->ApiResponce("there is not enough quantity_unit will be in our   ");
//                    }

                } else {
                    // $data=array('message'=>" لا يوجد كميه جمله ما يكفي  من المنتج  ". $product->name . " لاتمام الطلب ", 'available_qty'=>$info->quantity );
                    $data = array('message' => ' لا يوجد كميه جمله من المنتج تكفى لاتمام الشراء ', 'product' => $product, 'available_qty' => $info->quantity);
                    return $this->ApiResponce($data);
                }

                // check for quantity_unit
                if ($info->quantity_unit >= $order_unit->quantity_unit) {
                    if ($order_unit->quantity_unit > 0) {
                        $final_quantity_unit = ($product->quantity_unit * $order_unit->quantity_total) + $order_unit->quantity_unit;
                        $data_gededa = ($info->quantity - ($order_unit->quantity_total + ($order_unit->quantity_unit / $product->quantity_unit)));
                        // return "here 3";
                    } else {
                        $final_quantity_unit = ($order_unit->quantity_total * $product->quantity_unit);
                        $data_gededa = ($info->quantity - ($order_unit->quantity_total));
                        //  return "here 4";
                    }

                    if ($data_gededa < 0) {
                        $data = array('message' => "there is not enough quantity_total will be in our store", 'product' => $product, 'available_qty' => $info->quantity);
                        return $this->ApiResponce($data);
                    }
//                    if ($final_quantity_unit > $info->quantity_unit) {
//                        $data = array('message' => "there is not enough quantity_unit will be in our store", 'product' => $product, 'available_qty' => $final_quantity_unit);
//                        return $this->ApiResponce($data);
//
//                    }
                }
//                else {
//
//                    // $data=array('message'=>"لا يوجد كميه قطاعي ما يكفي  من المنتج  ". $product->name. " لاتمام الطلب ",'available_qty'=>$info->quantity_unit);
//                    $data = array('message' => ' لا توجد كميه قطاعى من المنتج تكفى لاتمام الشراء ', 'product' => $product, 'available_qty' => $info->quantity_unit);
//                    return $this->ApiResponce($data);
//                }

            } elseif ($order_unit->quantity_total != 0) {

                if ($info->quantity >= $order_unit->quantity_total) {
                    if ($order_unit->quantity_unit > 0) {
                        $final_quantity_unit = ($product->quantity_unit * $order_unit->quantity_total) + $order_unit->quantity_unit;
                        $data_gededa = ($info->quantity - ($order_unit->quantity_total + ($order_unit->quantity_unit / $product->quantity_unit)));
                        // return "here 5";
                    } else {
                        $final_quantity_unit = ($order_unit->quantity_total * $product->quantity_unit);
                        $data_gededa = ($info->quantity - ($order_unit->quantity_total));
                        //  return "here 6";
                    }

                    if ($data_gededa < 0) {
                        $data = array('message' => "there is not enough quantity_total will be in our store", 'product' => $product, 'available_qty' => $info->quantity);
                        return $this->ApiResponce($data);
                    }
//                    if ($final_quantity_unit > $info->quantity_unit) {
//                        $data = array('message' => "there is not enough quantity_unit will be in our store", 'product' => $product, 'available_qty' => $final_quantity_unit);
//                        return $this->ApiResponce($data);
//                    }
                } else {
                    // $data=array('message'=>"لا يوجد كميه جمله ما يكفي  من المنتج  ". $product->name. " لاتمام الطلب " , 'available_qty'=>$info->quantity);
                    $data = array('message' => ' لا يوجد كميه جمله من المنتج تكفى لاتمام الشراء ', 'product' => $product, 'available_qty' => $info->quantity);
                    return $this->ApiResponce($data);
                }

            } elseif ($order_unit->quantity_unit != 0) {

                if ($info->quantity_unit >= $order_unit->quantity_unit) {
                    if ($order_unit->quantity_unit > 0) {
                        $final_quantity_unit = ($product->quantity_unit * $order_unit->quantity_total) + $order_unit->quantity_unit;
                        $data_gededa = floor($info->quantity - ($order_unit->quantity_total + ($order_unit->quantity_unit / $product->quantity_unit)));
                        // return "here 7";
                    } else {
                        $final_quantity_unit = ($order_unit->quantity_total * $product->quantity_unit);
                        $data_gededa = floor($info->quantity - ($order_unit->quantity_total));
                        //  return "here 8";
                    }

                    if ($data_gededa < 0) {
                        $data = array('message' => "there is not enough quantity_total will be in our store", 'product' => $product, 'available_qty' => $info->quantity);
                        return $this->ApiResponce($data);
                        // return  $this->ApiResponce("there is not enough quantity_total will be in our store ");
                    }

//                    if ($final_quantity_unit > $info->quantity_unit) {
//                        $data = array('message' => "there is not enough quantity_unit will be in our store", 'product' => $product, 'available_qty' => $final_quantity_unit);
//                        return $this->ApiResponce($data);
//                        // return  $this->ApiResponce("there is not enough quantity_unit will be in our store ");
//                    }

                } else {
                    // $data=array('message'=>"لا يوجد كميه قطاعي ما يكفي  من المنتج  ". $product->name . " لاتمام الطلب "  , 'available_qty'=>$info->quantity_unit);
                    $data = array('message' => ' لا يوجد كمية قطاعى من المنتج تكفى لاتمام الشراء ', 'product' => $product, 'available_qty' => $info->quantity_unit);
                    return $this->ApiResponce($data);
                }

            }
            // here for edit store info
            $info->update([
                'quantity' => floor($data_gededa),
//                'quantity_unit' => $info->quantity_unit - $final_quantity_unit,
            ]);
            // return $info;
        }

        // for applay cash back
        $total_minus_paid = 0;
        $notify = $this->checkNotify($order->id);
        if ($notify['notify']) {

            $revenue = $this->getTotalDiscount($notify, $order);
            $discounts = $this->calculateTotal($order->id, $revenue, $notify);
            $total_minus_paid += $discounts['total_discount_now'] + $discounts['unit_discount_now'];
            $int_value = $total_minus_paid;
            $order->update([
                'minus_notify' => $discounts['total_discount_now'] + $discounts['unit_discount_now'],
                'total_minus_paid' => $discounts['total_discount_now'] + $discounts['unit_discount_now'],
            ]);
            // return    $order;
            if ($discounts['total_discount_later'] + $discounts['unit_discount_later'] > 0) {
                $dept = new Dept([
                    'user_id' => $order->user->id,
                    'order_id' => $order->id,
                    'total' => $discounts['total_discount_later'] + $discounts['unit_discount_later'],
                    'paid' => 0,
                    'date' => Carbon::now()->addMonths(1)
                ]);
                $dept->save();
            } else {
                $dept = false;
            }
        }
        // return 'end';

        // end test

        // $order = Order::findOrFail($id);
        $order->update([
            'is_complete' => 1
        ]);

        //start ali

        //check

//        return $order;

        //check promo code
        $user_id = auth()->user()->id;

        //start mongez

        if($request->munjiz['isFastShipping'] == 1){
            $mongez = Mongez::where([
                ['from','<=',$request->munjiz['distance']],
                ['to','>=',$request->munjiz['distance']],
            ])->first();

            if ($mongez){
                $price = $mongez->price * $request->munjiz['distance'];
            }else{
                $difult = DefultMongez::first();
                $price = $difult->price * $request->munjiz['distance'];
            }
            UserMongez::create([
                "order_id" => $order->id,
                "user_id" => $user_id,
                "price" => $price,
                "km" => $request->munjiz['distance'],
            ]);

            $order->update([
                'price_total_sum' => $order->price_total_sum + $price,
            ]);
        }

        // end mongez

        //start Promo code

        if ($request->promo_code)
        {
            $coupone = Coupone::where('code',$request->promo_code)->first();
            $discount_percent = $coupone->percentage;

            $discount_price = ($order->price_total_sum * $discount_percent) / 100;

            PromoCode::create([
               "title" =>$coupone->title,
               "title_en" =>$coupone->title_en,
               "order_id" =>$order->id,
               "discount" =>$discount_price,
               "discount_percent" =>$coupone->percentage,
               "end_date" =>$coupone->end_date,
            ]);

            $order->update([
                'price_total_sum' => $order->price_total_sum - $discount_price,
            ]);

            $coupone->users()->attach($user_id);
        }
        //end Promo code

        //start discount

        $discount_type = \App\DiscountType::where([
            ['from', '<=', $order->price_total_sum],
            ['to', '>=', $order->price_total_sum],
        ])->first();

        if ($discount_type) {
            if ($discount_type->id == 1) {
                $discounts_olds = Discount::where([
                    ['discount_type_id', '!=', 1],
                    ['end_discount', '=', 0],
                    ['to_date', '>=', now()],
                    ['created_at', '<', now()],
                ])->get();

                foreach ($discounts_olds as $discounts_old) {
                    $mins_discount = $discounts_old->discount - $discounts_old->end_discount;

                    if ($order->price_total_sum > $mins_discount) {
                        $order->update([
                            'price_total_sum' => $order->price_total_sum - $mins_discount,
                        ]);

                        $discounts_old->update([
                            'end_discount' => $discounts_old->discount,
                            'order_id' => $order->id
                        ]);

                    }
                }
                $discount_percent = $discount_type->immediately;

                $discount_price = ($order->price_total_sum * $discount_percent) / 100;

                Discount::create([
                    'discount_type_id' => $discount_type->id,
                    'user_id' => $request['user_id'],
                    'order_id' => $order->id,
                    'discount' => $discount_price,
                    'end_discount' => $discount_price,
                    'to_date' => now()
                ]);

                $order->update([
                    'price_total_sum' => $order->price_total_sum - $discount_price,
                ]);



            } elseif ($discount_type->id == 2) {

                $discounts_olds = Discount::where([
                    ['discount_type_id', '!=', 1],
                    ['end_discount', '=', 0],
                    ['to_date', '>=', now()],
                    ['created_at', '<', now()],
                ])->get();

                foreach ($discounts_olds as $discounts_old) {
                    $mins_discount = $discounts_old->discount - $discounts_old->end_discount;

                    if ($order->price_total_sum > $mins_discount) {
                        $order->update([
                            'price_total_sum' => $order->price_total_sum - $mins_discount,
                        ]);

                        $discounts_old->update([
                            'end_discount' => $discounts_old->discount,
                            'order_id' => $order->id
                        ]);

                    }
                }

                $discount_percent = $discount_type->postponed;

                $discount_price = ($order->price_total_sum * $discount_percent) / 100;

                Discount::create([
                    'discount_type_id' => $discount_type->id,
                    'user_id' => $request['user_id'],
//                    'order_id' => $order->id,
                    'discount' => $discount_price,
                    'to_date' => Carbon::now()->addMonth(),
                    'immediately' => 0
                ]);

            } elseif ($discount_type->id == 3) {

                $discounts_olds = Discount::where([
                    ['discount_type_id', '!=', 1],
                    ['end_discount', '=', 0],
                    ['to_date', '>=', now()],
                    ['created_at', '<', now()],
                ])->get();

                foreach ($discounts_olds as $discounts_old) {
                    $mins_discount = $discounts_old->discount - $discounts_old->end_discount;

                    if ($order->price_total_sum > $mins_discount) {
                        $order->update([
                            'price_total_sum' => $order->price_total_sum - $mins_discount,
                        ]);

                        $discounts_old->update([
                            'end_discount' => $discounts_old->discount,
                            'order_id' => $order->id
                        ]);

                    }
                }


                $discount_percent_immediately = $discount_type->immediately;

                $discount_price = ($order->price_total_sum * $discount_percent_immediately) / 100;

                Discount::create([
                    'discount_type_id' => $discount_type->id,
                    'user_id' => $request['user_id'],
                    'order_id' => $order->id,
                    'discount' => $discount_price,
                    'end_discount' => $discount_price,
                    'to_date' => Carbon::now(),
                    'immediately' => 1
                ]);
                $order->update([
                    'price_total_sum' => $order->price_total_sum - $discount_price,
                ]);

                $discount_percent_postponed = $discount_type->postponed;

                $discount_price = ($order->price_total_sum * $discount_percent_postponed) / 100;

                Discount::create([
                    'discount_type_id' => $discount_type->id,
                    'user_id' => $request['user_id'],
                    'discount' => $discount_price,
                    'to_date' => Carbon::now()->addMonth(),
                    'immediately' => 0
                ]);


            }
        }

        //end ali

        if ($this->getCashBackOfCurrentOrderId($order->user->id, $order->id) == false) {
            $order->discount;
            return response()->json([
                'status' => 'error',
                'success' => false,
                'message' => $order,
                'error' => "5"
            ], 200);

        } else {
            return $this->getCashBackOfCurrentOrderId($order->user->id, $order->id);
        }

        // return  $this->ApiResponce($order);
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
        $product_info = $order_unit->product->infos()->wherePivot('store_id', '=', $request['store_id'])->get()->first();
        $order->update([
            'price_total_sum' => $order_unit->quantity_total * $product_info->sell_total,
            'price_unit_sum' => $order_unit->quantity_unit * $product_info->sell_unit($order_unit->product),
        ]);

        $order_unit->update([
            'price' => $product_info->sell_total,
            'price_unit' => $product_info->sell_unit($order_unit->product),
        ]);

        $checkOfferTotal = $this->checkOfferTotal($order);
        $notify = $this->preCheckNotify($order->id);

        $data['order_id'] = $order->id;
        $data['order_unit_id'] = $order_unit->id;
        $data['check_offer_total'] = $checkOfferTotal;
        $data['notify'] = $notify;
        $data['cashback'] = $this->getCashBack($order->user->id);

        return $this->ApiResponce($data);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $order = Order::find($id);
        $order->units = $order->order_units()->get();
        return $this->ApiResponce($order);

    }

    public function update(Request $request)
    {
        $price_total_sum = 0;
        $price_unit_sum = 0;
        $order = Order::findOrFail($request->order_id);
        $order->update([
            'comment' => $request['comment'],
        ]);
        if (isset($request->type)) {
            /*
             * Add Unit To Order
             */
            if ($request->type == 'add') {
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
                $product_info = $order_unit->product->infos()->wherePivot('store_id', '=', $order->store->id)->get()->first();

                $order_unit->update([
                    'price' => $product_info->sell_total,
                    'price_unit' => $product_info->sell_unit($order_unit->product),
                ]);
                // Update Total Price by Quantity

                foreach ($order->order_units as $order_unit) {
                    $product_info = $order_unit->product->infos()->wherePivot('store_id', '=', $order->store->id)->get()->first();

                    $price_total_sum += $order_unit->quantity_total * $product_info->sell_total;
                    $price_unit_sum += $order_unit->quantity_unit * $product_info->sell_unit($order_unit->product);


                }
                $order->update([
                    'price_total_sum' => $price_total_sum,
                    'price_unit_sum' => $price_unit_sum,

                ]);
            } /*
             * Delete Unit From Order
             */
            elseif ($request->type == 'delete') {
                $order_unit = order_unit::findOrFail($request->unit_id);
                $order_unit->delete();
                // Update Total Price by Quantity

                foreach ($order->order_units as $order_unit) {
                    $product_info = $order_unit->product->infos()->wherePivot('store_id', '=', $order->store->id)->get()->first();

                    $price_total_sum += $order_unit->quantity_total * $product_info->sell_total;
                    $price_unit_sum += $order_unit->quantity_unit * $product_info->sell_unit($order_unit->product);
                }
                $order->update([
                    'price_total_sum' => $price_total_sum,
                    'price_unit_sum' => $price_unit_sum,

                ]);
            } elseif ($request->type == 'update') {
                $order_unit = order_unit::findOrFail($request->unit_id);
                $product_info = $order_unit->product->infos()->wherePivot('store_id', '=', $order->store->id)->get()->first();
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
                    'price' => $product_info->sell_total,
                    'price_unit' => $product_info->sell_unit($order_unit->product),
                ]);

                // Update Total Price by Quantity

                foreach ($order->order_units as $order_unit) {
                    $product_info = $order_unit->product->infos()->wherePivot('store_id', '=', $order->store->id)->get()->first();

                    $price_total_sum += $order_unit->quantity_total * $product_info->sell_total;
                    $price_unit_sum += $order_unit->quantity_unit * $product_info->sell_unit($order_unit->product);
                }
                $order->update([
                    'price_total_sum' => $price_total_sum,
                    'price_unit_sum' => $price_unit_sum,

                ]);
            }
        }

        $checkOfferTotal = $this->checkOfferTotal($order);
        $notify = $this->preCheckNotify($order->id);

        $data['order_id'] = $order->id;
        $data['check_offer_total'] = $checkOfferTotal;
        $data['notify'] = $notify;
        $data['cashback'] = $this->getCashBack($order->user->id);

        return $data;
    }

    public function destroy($id)
    {
        $order = Order::find($id);

        foreach ($order->discount as $discount)
        {
            $discount->delete();
        }

        foreach ($order->order_units()->get() as $order_unit) {

            $info = $order_unit->product->infos()->wherePivot('store_id', $order->store_id)->get()->first();
            $product = Product::findOrFail($order_unit->product_id);
            if ($order_unit->quantity_unit > 0) {
                $final_quantity_unit = ($product->quantity_unit * $order_unit->quantity_total) + $order_unit->quantity_unit;
                $data_gededa = ($info->quantity + ($order_unit->quantity_total + ($order_unit->quantity_unit / $product->quantity_unit)));
            } else {

                $final_quantity_unit = ($order_unit->quantity_total * $product->quantity_unit);
                $data_gededa = ($info->quantity + ($order_unit->quantity_total));
            }

            $info->update([
                'quantity' => floor($data_gededa),
                'quantity_unit' => $info->quantity_unit + $final_quantity_unit,
            ]);

            $order_unit->delete();
        }

        $order->delete();
        return ['message' => 'order Deleted'];
    }

    public function mandobOrderStatus(Request $request, $id)
    {
        $order = Order::find($id);
        $order = Order::where('order_id', $id)->get();
        foreach ($order as $orde) {
            $orde->mandob_stage = $request->mandob_stage;
            $orde->mandob_date = $request->mandob_date;
            $orde->save();
        }
        return $this->ApiResponce($orde);
    }

    public function getOrdersByUser(Request $request ,$is_complete = '')
    {
        $user = auth()->user();

        if (!is_null($user)) {
            $orders = $user->orders();
            if ($is_complete !== '') {
                $orders = $orders->where('is_complete', $is_complete);
            }
            $orders = $orders->get();
            // $orders = $orders->get();

            if ($orders->count()) {

                foreach ($orders as $order) {

                    $order->discount;
                    $order->promoCode;
                    $order->mongez;

                    $order->units = $order->order_units()->get();
                    $store_id = $order->store_id;
                    foreach ($order->units as $unit) {
                        $waiting = $unit->product->waiting_status;
                        $unit->waiting_status = $waiting;
                        unset($unit["product"]);

                        $product = $unit->product;

                        // start calculating product price

                        $price_of_total = 0;
                        $price_of_unit = 0;

                        if ($product->discount_total != 0) {
                            $price_of_total = ($product->price_total - $product->discount_total);
                        } else {
                            $price_of_total = $product->price_total;
                        }
                        if ($product->discount_unit != 0) {
                            $price_of_unit = ($product->price_unit - $product->discount_unit);
                        } else {
                            $price_of_unit = $product->price_unit;
                        }

                        // end calculating product price

                        $clone_product = $product->replicate();
                        $product_customs = $product->infos()->wherePivot('store_id', '=', $store_id)->get()->first();

                        if(!$product_customs)
                        {
                            $store_id = 1;
                            $product_customs = $product->infos()->wherePivot('store_id', '=', 1)->get()->first();
                        }
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

                        // return order_unit::with('order')->get();
                        $order_units = order_unit::whereHas('order', function ($query) use ($store_id) {
                            $query->where([
                                ['store_id', '=', $store_id],
                                ['is_complete', '=', 1],
                                ['is_direct_sell', '=', 0],
                                ['order_stage_id', '<', 5],
                            ]);
                        })->get();
                        $minus_total = $order_units->sum('quantity_total');
                        $minus_unit = $order_units->sum('quantity_unit');
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
                        $product->sp_unit_price = $price_of_unit;
                        $product->sp_total_price = $price_of_total;
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
            }
            // return $orders->count();
            return $this->ApiResponce($orders);
        } else {
            return $this->ApiResponce(
                'user not found'
            );
        }

    }

    public function completeOrder($id)
    {

        // start test
        $order = Order::findOrFail($id);
        // check if units of user available
        $order_units = $order->order_units;
        foreach ($order_units as $index => $order_unit) {
            $info = $order_unit->product->infos()->wherePivot('store_id', $order->store_id)->get()->first();
            $product = Product::findOrFail($order_unit->product_id);
            // check for quantity_total
            if ($order_unit->quantity_total != 0 && $order_unit->quantity_unit != 0) {
                if ($info->quantity >= $order_unit->quantity_total) {
                    if ($order_unit->quantity_unit > 0) {
                        $final_quantity_unit = ($product->quantity_unit * $order_unit->quantity_total) + $order_unit->quantity_unit;
                        $data_gededa = ($info->quantity - ($order_unit->quantity_total + ($order_unit->quantity_unit / $product->quantity_unit)));
                    } else {
                        $final_quantity_unit = ($order_unit->quantity_total * $product->quantity_unit);
                        $data_gededa = ($info->quantity - ($order_unit->quantity_total));
                    }

                    if ($data_gededa < 0) {

                    }

                    if ($final_quantity_unit > $info->quantity_unit) {
                        return $this->ApiResponce("there is not enough quantity_unit will be in our store ");
                    }


                } else {
                    $data = array('message' => "لا يوجد كميه جمله ما يكفي  من المنتج  " . $product->name . " لاتمام الطلب ");
                    return $this->ApiResponce($data);
                }

                // check for quantity_unit
                if ($info->quantity_unit >= $order_unit->quantity_unit) {
                    if ($order_unit->quantity_unit > 0) {
                        $final_quantity_unit = ($product->quantity_unit * $order_unit->quantity_total) + $order_unit->quantity_unit;
                        $data_gededa = ($info->quantity - ($order_unit->quantity_total + ($order_unit->quantity_unit / $product->quantity_unit)));
                    } else {
                        $final_quantity_unit = ($order_unit->quantity_total * $product->quantity_unit);
                        $data_gededa = ($info->quantity - ($order_unit->quantity_total));
                    }

                    if ($data_gededa < 0) {
                        $data = array('message' => "there is not enough quantity_total will be in our store", 'product' => $product);
                        return $this->ApiResponce($data);
                    }

                    if ($final_quantity_unit > $info->quantity_unit) {
                        $data = array('message' => "there is not enough quantity_unit will be in our store", 'product' => $product);
                        return $this->ApiResponce($data);

                    }


                } else {

                    $data = array('message' => "لا يوجد كميه قطاعي ما يكفي  من المنتج  " . $product->name . " لاتمام الطلب ");
                    return $this->ApiResponce($data);
                }

            } elseif ($order_unit->quantity_total != 0) {

                if ($info->quantity >= $order_unit->quantity_total) {
                    if ($order_unit->quantity_unit > 0) {
                        $final_quantity_unit = ($product->quantity_unit * $order_unit->quantity_total) + $order_unit->quantity_unit;
                        $data_gededa = ($info->quantity - ($order_unit->quantity_total + ($order_unit->quantity_unit / $product->quantity_unit)));
                    } else {
                        $final_quantity_unit = ($order_unit->quantity_total * $product->quantity_unit);
                        $data_gededa = ($info->quantity - ($order_unit->quantity_total));
                    }

                    if ($data_gededa < 0) {
                        $data = array('message' => "there is not enough quantity_total will be in our store", 'product' => $product);
                        return $this->ApiResponce($data);
                    }

                    if ($final_quantity_unit > $info->quantity_unit) {
                        $data = array('message' => "there is not enough quantity_unit will be in our store", 'product' => $product);
                        return $this->ApiResponce($data);
                    }

                } else {
                    $data = array('message' => "لا يوجد كميه جمله ما يكفي  من المنتج  " . $product->name . " لاتمام الطلب ");
                    return $this->ApiResponce($data);
                }

            } elseif ($order_unit->quantity_unit != 0) {

                if ($info->quantity_unit >= $order_unit->quantity_unit) {
                    if ($order_unit->quantity_unit > 0) {
                        $final_quantity_unit = ($product->quantity_unit * $order_unit->quantity_total) + $order_unit->quantity_unit;
                        $data_gededa = ($info->quantity - ($order_unit->quantity_total + ($order_unit->quantity_unit / $product->quantity_unit)));
                    } else {
                        $final_quantity_unit = ($order_unit->quantity_total * $product->quantity_unit);
                        $data_gededa = ($info->quantity - ($order_unit->quantity_total));
                    }

                    if ($data_gededa < 0) {
                        $data = array('message' => "there is not enough quantity_total will be in our store", 'product' => $product);
                        return $this->ApiResponce($data);
                        // return  $this->ApiResponce("there is not enough quantity_total will be in our store ");
                    }

                    if ($final_quantity_unit > $info->quantity_unit) {
                        $data = array('message' => "there is not enough quantity_unit will be in our store", 'product' => $product);
                        return $this->ApiResponce($data);
                        // return  $this->ApiResponce("there is not enough quantity_unit will be in our store ");
                    }

                } else {
                    $data = array('message' => "لا يوجد كميه قطاعي ما يكفي  من المنتج  " . $product->name . " لاتمام الطلب ");
                    return $this->ApiResponce($data);
                }

            }

            // here for edit store info
            $info->update([
                'quantity' => floor($data_gededa),
                'quantity_unit' => $info->quantity_unit - $final_quantity_unit,
            ]);

        }

        // for applay cash back
        $total_minus_paid = 0;
        $notify = $this->checkNotify($id);
        if ($notify['notify']) {

            $revenue = $this->getTotalDiscount($notify, $order);
            $discounts = $this->calculateTotal($id, $revenue, $notify);
            $total_minus_paid += $discounts['total_discount_now'] + $discounts['unit_discount_now'];
            $int_value = $total_minus_paid;
            $order->update([
                'minus_notify' => $discounts['total_discount_now'] + $discounts['unit_discount_now'],
                'total_minus_paid' => $discounts['total_discount_now'] + $discounts['unit_discount_now'],
            ]);
            // return    $order;
            if ($discounts['total_discount_later'] + $discounts['unit_discount_later'] > 0) {
                $dept = new Dept([
                    'user_id' => $order->user->id,
                    'order_id' => $order->id,
                    'total' => $discounts['total_discount_later'] + $discounts['unit_discount_later'],
                    'paid' => 0,
                    'date' => Carbon::now()->addMonths(1)
                ]);
                $dept->save();
            } else {
                $dept = false;
            }
        }
        // return 'end';

        // end test

        // $order = Order::findOrFail($id);
        $order->update([
            'is_complete' => 1
        ]);
        return $this->ApiResponce($order);
    }

    public function getAllStages()
    {
        $order_stages = Order_stage::all();
        return $this->ApiResponce($order_stages);

    }

    public function checkNotifyOrder($order_id)
    {
        $revenue = $this->preCheckNotify($order_id);
        if (is_a($revenue['notify'], 'App\Notify_user')) {
            $revenue['units'] = $revenue['notify']->notify_user_units;
            unset($revenue['notify']['notify']);
            unset($revenue['notify']['notify_user_units']);
        } elseif (is_a($revenue['notify'], 'App\Notify')) {
            $revenue['units'] = $revenue['notify']->notify_units;
            unset($revenue['notify']['notify']);
            unset($revenue['notify']['notify_units']);
        }
        return $this->ApiResponce($revenue);
    }

    public function userWallet()
    {
        $user = auth()->user();
        if (Option::find(4)->is_active) {
            return $this->getCashBack($user->id);
        }
        // $user = User::findOrFail($user_id);
        return $this->ApiResponce($user->depts);

    }

    public function deliverOrder(Request $request, $order_id)
    {
        // return  $order_id;
        // elmnofy
        $order = Order::findOrFail($order_id);
        //gemy
        $store_id = $order->store_id;
        //gemy

        /*        if (Option::find(4)->is_active)
                    {
                        $cashback = $this->getCashBackOfAllExceptWithOrderId($order->user->id ,$order->id );
                       return $cashback_of_current_order_id = $this->getCashBackOfCurrentOrderId($order->user->id ,$order->id);
                    }*/

        // return $order->mondob_stage_id;
        if ($order->mondob_stage_id >= '2') {
            $array=[
                'data'=>false,
                'status'=>false ,
                'error'=>1,
                'message'=>"لا يمكن الطلب أكثر من مرة",
            ];

            return response($array);

        }

        // start ali
        foreach ($request->all() as $item) {
            $order_unit = $order->order_units()->where('product_id', $item['product_id'])->get()->first();

            if ($order_unit->quantity_total < $item['receive_total'])
            {
                $array=[
                    'data'=>false,
                    'status'=>false ,
                    'error'=>2,
                    'message'=>"الكمية المسلمة للعميل لايمكن ان تكون اكبر من الكمية المطلوبة",
                ];

                return response($array);

            }
        }
        // end ali


        //gemy
        $final_final_total_price = 0;
        $final_final_unit_price = 0;
        $final_recall_total_price = 0;
        $final_recall_unit_price = 0;
        $receive_total = 0;
        $receive_unit = 0;
        $recall_total = 0;
        $recall_unit = 0;
        $recall_total_price = 0;
        $recall_unit_price = 0;
        //gemy


        foreach ($request->all() as $item) {
            $item['receive_unit'] = 0;
            $order_unit = $order->order_units()->where('product_id', $item['product_id'])->get()->first();
            $recall_total = $order_unit->quantity_total - $item['receive_total'];
            $recall_unit = $order_unit->quantity_unit - $item['receive_unit'];
            $info = $order_unit->product->infos()->wherePivot('store_id', $order->store->id)->get()->first();
            $order_unit->update([
                'receive_total' => $item['receive_total'],
                'receive_unit' => $item['receive_unit'],
                'recall_total' => $order_unit->quantity_total - $item['receive_total'],
                'recall_unit' => $order_unit->quantity_unit - $item['receive_unit'],
            ]);

            //gemy
            $product = Product::findOrFail($item['product_id']);

            // start calculating product price

            $price_of_total = 0;
            $price_of_unit = 0;

            if ($product->discount_total != 0) {
                $price_of_total = ($product->price_total - $product->discount_total);

            } else {
                $price_of_total = $product->price_total;

            }
            if ($product->discount_unit != 0) {
                $price_of_unit = ($product->price_unit - $product->discount_unit);

            } else {
                $price_of_unit = $product->price_unit;

            }

            // end calculating product price

            $clone_product = $product->replicate();
            $product_customs = $product->infos()->wherePivot('store_id', '=', $store_id)->get()->first();
            $product_sp_unit_price = $price_of_unit;
            $product_sp_total_price = $price_of_total;
            $receive_total = $item['receive_total'];
            $receive_unit = $item['receive_unit'];
            $final_total_price = $receive_total * $product_sp_total_price;
            $final_unit_price = $receive_unit * $product_sp_unit_price;

            $recall_total_price = $order_unit->recall_total * $product_sp_total_price;
            $recall_unit_price = $order_unit->recall_unit * $product_sp_unit_price;


            $final_final_total_price += $final_total_price;
            $final_final_unit_price += $final_unit_price;

            $final_recall_total_price += $recall_total_price;
            $final_recall_unit_price += $recall_unit_price;
            //gemy

            if ($order_unit['recall_total'] > 0) {

                $final_quantity_unit = ($product->quantity_unit * $order_unit['recall_total']) + $order_unit['recall_unit'];

            } else {
                $final_quantity_unit = $order_unit['recall_unit'];
            }

            $data_gededa = ($info->quantity + ($order_unit['recall_total'] + ($order_unit['recall_unit'] / $product->quantity_unit)));

            /*$info->update([

                'quantity' => $data_gededa,

                'quantity_unit' => $info->quantity_unit + $final_quantity_unit,
            ]);*/
        }

        $order->update([
            'mondob_stage_id' => 2,
            'order_stage_id' => 5,
            // 'has_recall'=>1,
            'recall_total_price' => $order->recall_total_price + $final_recall_total_price,
            'recall_unit_price' => $order->recall_unit_price + $final_recall_unit_price,

        ]);

        if ($recall_total != 0 || $recall_unit != 0) {
            $order->update([
                'has_recall' => 1,
            ]);
        }
        /*------------------------------------*/
        $total_minus_paid = 0;
        $notify = $this->checkNotify($order_id);
        if ($notify['notify']) {
            $revenue = $this->getTotalDiscount($notify, $order);
            $discounts = $this->calculateTotal($order_id, $revenue, $notify);
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
        /*if (Option::find(4)->is_active)
            {
                $cashback = $this->getCashBackOfAllExceptWithOrderId($order->user->id ,$order->id );
                $cashback_of_current_order_id = $this->getCashBackOfCurrentOrderId($order->user->id ,$order->id);

                if ($cashback)
                {
                    $depts=Dept::where('user_id',$order->user->id)->get();
                    // $dept_sum = Dept::where('user_id',$id)->whereColumn('depts.total','>','depts.paid')->sum(DB::raw('total-paid'));
                    $total_total = Dept::where('user_id',$order->user->id)->sum(DB::raw('total'));
                    $total_paid = Dept::where('user_id',$order->user->id)->sum(DB::raw('paid'));
                    $dept_sum=$total_total-$total_paid;
                    if($total_paid<$total_total)
                    {

                        $dept_sum=$total_total-$total_paid;
                    }else
                    {
                        $dept_sum=0;
                    }
                    if(!$dept_sum)
                    {
                        $dept_sum=0;
                    }

                    $second_last_order=$order->user->orders()->orderBy('created_at', 'desc')->skip(1)->take(1)->get()->first();
                    if($second_last_order!=null)
                    {

                    if($second_last_order->future_cash_back!=0)
                    {
                        $order->update([
                        'cash_back' => $second_last_order->future_cash_back + $dept_sum ,
                        ]);
                        // $total_minus_paid += $order->cash_back;

                        $dept = $order->user->depts()->get();
                        foreach($dept as $dep)
                        {
                           $dep->paid=0;
                           $dep->save();
                        }

                        $dept = $order->user->depts()->latest()->first();
                        $dept->paid=$order->cash_back;
                        $dept->save();
                    }else{
                        $order->update([
                        'cash_back' => $dept_sum ,
                        ]);
                        // $total_minus_paid += $order->cash_back;

                        $dept = $order->user->depts()->get();
                        foreach($dept as $dep)
                        {
                           $dep->paid=0;
                           $dep->save();
                        }

                        $dept = $order->user->depts()->latest()->first();
                        $dept->paid=$cashback;
                        $dept->save();
                    }

                    }

                    if($cashback_of_current_order_id)
                    {

                        $order->update([
                        'future_cash_back' =>  $cashback_of_current_order_id
                        ]);
                    }

                }
            }*/


        if (Option::find(4)->is_active) {

            $depts = Dept::where('user_id', $order->user->id)->get();
            // $dept_sum = Dept::where('user_id',$id)->whereColumn('depts.total','>','depts.paid')->sum(DB::raw('total-paid'));
            $total_total = Dept::where('user_id', $order->user->id)->sum(DB::raw('total'));
            $total_paid = Dept::where('user_id', $order->user->id)->sum(DB::raw('paid'));
            if ($total_paid < $total_total) {

                $dept_sum = $total_total - $total_paid;
            } else {
                $dept_sum = 0;
            }
            if (!$dept_sum) {
                $dept_sum = 0;
            }

            $cashback = $this->getCashBackOfAllExceptWithOrderId($order->user->id, $order->id);
            // dd($cashback);
            $cashback_of_current_order_id = $this->getCashBackOfCurrentOrderId($order->user->id, $order->id);

            if ($cashback) {

                $second_last_order = $order->user->orders()->orderBy('created_at', 'desc')->skip(1)->take(1)->get()->first();
                if ($second_last_order != null) {

                    if ($second_last_order->future_cash_back != 0) {
                        $order->update([
                            'cash_back' => $second_last_order->future_cash_back,
                        ]);
                        // $total_minus_paid += $order->cash_back;
                        // $dept = $order->user->depts()->get();
                        foreach ($order->user->depts()->get() as $dep) {
                            $dep->paid = 0;
                            $dep->save();
                        }
                        $dept = $order->user->depts()->latest()->first();
                        $dept->paid = $cashback;
                        $dept->save();
                    } else {
                        /*$order->update([
                        'cash_back' => $dept_sum ,
                        ]);*/
                        // $total_minus_paid += $order->cash_back;
                        // $dept = $order->user->depts()->get();
                        foreach ($order->user->depts()->get() as $dep) {
                            $dep->paid = 0;
                            $dep->save();
                        }
                        $dept = $order->user->depts()->latest()->first();
                        $dept->paid = $cashback;
                        $dept->save();
                    }

                }/*else{
                        $order->update([
                        'future_cash_back' =>  $dept_sum
                        ]);
                    }*/

                if ($cashback_of_current_order_id) {

                    $order->update([
                        'future_cash_back' => $cashback_of_current_order_id
                    ]);
                }

            } else {
                $order->update([
                    'future_cash_back' => $dept_sum
                ]);
            }
        }


        // check offer total
        $checkOfferTotal = $this->checkOfferTotalFinal($order);
        if (!$checkOfferTotal == null) {


            if ($checkOfferTotal['min_total']) {
                $total_minus_paid += $checkOfferTotal['total_minus'];
            }
            if ($checkOfferTotal['min_unit']) {
                $total_minus_paid += $checkOfferTotal['unit_minus'];
            }
        }


        // $total_after_dis = $order->price_total_sum + $order->price_unit_sum - $total_minus_paid;
        //gemy
        $total_after_dis = $final_final_total_price + $final_final_unit_price - $total_minus_paid;
        // gemy


        $order->update([
            'rest_value' => $total_after_dis
        ]);

        $data['check_offer_total'] = $checkOfferTotal;
        $data['notify'] = $notify;
        $data['cashback'] = $this->getCashBack($order->user->id);
        $data['total_after_discount'] = $total_after_dis;
        return $data;

    }

    public function confirmOrder($order_id)
    {
        $order = Order::findOrFail($order_id);
        if ($order->mondob_stage_id == 2 && $order->order_stage_id == 5) {
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
            $lose = 0;
            foreach ($order_units as $order_unit) {
                $info = $order_unit->product->infos()->wherePivot('store_id', $order->store->id)->get()->first();
                if (($order_unit->receive_total < $order_unit->quantity_total) || ($order_unit->receive_unit < $order_unit->quantity_unit)) {
                    $order->update([
                        'mondob_stage_id' => 5
                    ]);
                }
                $lose += $info->loss * $order_unit->quantity_total;
                $lose += ($info->loss / $order_unit->product->quantity_unit) * $order_unit->quantity_unit;
            }
            // calculate loss
            // Make new Lose If bigger than 0
            if ($lose) {

                $lose_obj = new lose([
                    'store_id' => $order->store_id,
                    'order_id' => $order->id,
                    'loss' => $lose,
                ]);

                $lose_obj->save();
            }


            /*------------------------------------*/
            $total_minus_paid = 0;
            $notify = $this->checkNotify($order_id);
            if ($notify['notify']) {
                $revenue = $this->getTotalDiscount($notify, $order);
                $discounts = $this->calculateTotal($order_id, $revenue, $notify);
                $total_minus_paid += $discounts['total_discount_now'] + $discounts['unit_discount_now'];
                $int_value = $total_minus_paid;
                $order->update([
                    'minus_notify' => $discounts['total_discount_now'] + $discounts['unit_discount_now'],
                    'total_minus_paid' => $int_value,
                ]);
                if ($discounts['total_discount_later'] + $discounts['unit_discount_now'] > 0) {
                    // $dept = new Dept([
                    //     'user_id' => $order->user->id,
                    //     'order_id' => $order->id,
                    //     'total' => $discounts['total_discount_later'] + $discounts['unit_discount_now'],
                    //     'paid'  =>  0,
                    //     'date'  =>  Carbon::now()->addMonths(1)
                    // ]);

                } else {
                    $dept = false;
                }
            }
            // check cashback
            /*if (Option::find(4)->is_active)
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

                    }


                    }


                }else{
                    $second_last_order=$order->user->orders()->orderBy('created_at', 'desc')->skip(1)->take(1)->get()->first();
                    if($second_last_order!=null)
                    {

                    if($second_last_order->future_cash_back!=0)
                    {
                        $order->update([
                        'cash_back' => $second_last_order->future_cash_back  ,
                        ]);

                }
                    }
                }

                if($cashback_of_current_order_id)
                    {

                        $order->update([
                        'future_cash_back' =>  $cashback_of_current_order_id
                        ]);

                        $dept = $order->user->depts()->get();
                        foreach($dept as $dep)
                        {
                           $dep->paid=0;
                           $dep->save();
                        }

                        $dept = $order->user->depts()->latest()->first();
                        $dept->paid=$order->future_cash_back + $order->cash_back;
                        $dept->save();
                    }

            }*/


            // /*if (Option::find(4)->is_active)
            // {

            //         $depts=Dept::where('user_id',$order->user->id)->get();
            //         // $dept_sum = Dept::where('user_id',$id)->whereColumn('depts.total','>','depts.paid')->sum(DB::raw('total-paid'));
            //         $total_total = Dept::where('user_id',$order->user->id)->sum(DB::raw('total'));
            //         $total_paid = Dept::where('user_id',$order->user->id)->sum(DB::raw('paid'));
            //         if($total_paid<$total_total)
            //         {

            //             $dept_sum=$total_total-$total_paid;
            //         }else
            //         {
            //             $dept_sum=0;
            //         }
            //         if(!$dept_sum)
            //         {
            //             $dept_sum=0;
            //         }

            //     $cashback = $this->getCashBackOfAllExceptWithOrderId($order->user->id ,$order->id );
            //     // dd($cashback);
            //     $cashback_of_current_order_id = $this->getCashBackOfCurrentOrderId($order->user->id ,$order->id);

            //     if ($cashback)
            //     {

            //         $second_last_order=$order->user->orders()->orderBy('created_at', 'desc')->skip(1)->take(1)->get()->first();
            //         if($second_last_order!=null)
            //         {

            //         if($second_last_order->future_cash_back!=0)
            //         {
            //             $order->update([
            //             'cash_back' => $second_last_order->future_cash_back ,
            //             ]);
            //             // $total_minus_paid += $order->cash_back;
            //             // $dept = $order->user->depts()->get();
            //             foreach($order->user->depts()->get() as $dep)
            //             {
            //               $dep->paid=0;
            //               $dep->save();
            //             }
            //             $dept = $order->user->depts()->latest()->first();
            //             $dept->paid=$cashback;
            //             $dept->save();
            //         }else{
            //             /*$order->update([
            //             'cash_back' => $dept_sum ,
            //             ]);*/
            //             // $total_minus_paid += $order->cash_back;
            //             // $dept = $order->user->depts()->get();
            //             foreach($order->user->depts()->get() as $dep)
            //             {
            //               $dep->paid=0;
            //               $dep->save();
            //             }
            //             $dept = $order->user->depts()->latest()->first();
            //             $dept->paid=$cashback;
            //             $dept->save();
            //         }

            //         }/*else{
            //             $order->update([
            //             'future_cash_back' =>  $dept_sum
            //             ]);
            //         }*/

            //         if($cashback_of_current_order_id)
            //         {

            //             $order->update([
            //             'future_cash_back' =>  $cashback_of_current_order_id
            //             ]);
            //         }

            //     }else{
            //         $order->update([
            //             'future_cash_back' =>  $dept_sum
            //             ]);
            //     }
            // }*/


            // check offer total
            $checkOfferTotal = $this->checkOfferTotalFinal($order);
            if ($checkOfferTotal['min_total']) {
                $total_minus_paid += $checkOfferTotal['total_minus'];
                $order->update([
                    'total_minus' => $checkOfferTotal['total_minus']
                ]);
            }
            if ($checkOfferTotal['min_unit']) {
                $total_minus_paid += $checkOfferTotal['unit_minus'];
                $order->update([
                    'unit_minus' => $checkOfferTotal['unit_minus']
                ]);
            }

            $total_after_dis = $order->price_total_sum + $order->price_unit_sum - $total_minus_paid;
            $order->update([
                'rest_value' => 0,
                'paid_value' => $total_after_dis,
                'total_minus_paid' => $total_minus_paid,
            ]);

            $order->mandob()->update([
                'wallet' => $order->mandob->wallet + $order->paid_value
            ]);

            $data['order'] = $order;
            $data['store'] = $store;
            $data['order_units'] = $order_units;
            $data['check_offer_total'] = $checkOfferTotal;
            $data['notify'] = $notify;
            $data['dept'] = 0;
            $data['cashback'] = $this->getCashBack($order->user->id);
            $data['total_after_discount'] = $total_after_dis;

            return $data;
        } else {
            return $this->ApiResponce('cant confirm right now');
        }
    }

    public function seeBill($order_id)
    {
        $order = Order::findOrFail($order_id);
        $store = $order->store;

        $data['order'] = $order;
        $data['store'] = $store;

        return $data;
    }

    public function rateMandob(Request $request, $order_id)
    {
        $order = Order::findOrFail($order_id);
        $rate = new mondob_rate([
            'rate' => intval($request->rate),
            'mandob_id' => $order->mandob_id,
            'order_id' => $order->id,
        ]);
        $rate->save();
        return $this->ApiResponce($rate);
    }

    public function rateUser(Request $request, $order_id)
    {
        $order = Order::findOrFail($order_id);
        $rate = new user_rate([
            'rate' => intval($request->rate),
            'user_id' => $order->user_id,
            'order_id' => $order->id,
        ]);
        $rate->save();
        return $this->ApiResponce($rate);
    }

    public function userDepts()
    {
        $user = auth()->user();
        $orders = $user->orders()->where([
            ['is_complete', '=', 1],
            ['rest_value', '>', 0],
            ['order_stage_id', '=', 5]
        ])->get();
        return $this->ApiResponce($orders);
    }

    public function getTransfers()
    {
        $mandob = auth('man')->user();
        // $mandob = Mandob::findOrFail($mandob_id);

        $transfers = $mandob->orders()->where('transfer_id', '!=', null)->get();

        foreach ($transfers as $transfer) {
            $transfer->from = $transfer->transfer->from_store;
            $transfer->to = $transfer->transfer->to_store;


            $store_id = $transfer->store_id;
            //return $transfer->order_units;
            foreach ($transfer->order_units as $unit) {
                $waiting = $unit->product->waiting_status;
                $unit->waiting_status = $waiting;
                unset($unit["product"]);

                $product = $unit->product;

                // start calculating product price

                $price_of_total = 0;
                $price_of_unit = 0;

                if ($product->discount_total != 0) {
                    $price_of_total = ($product->price_total - $product->discount_total);

                } else {
                    $price_of_total = $product->price_total;

                }
                if ($product->discount_unit != 0) {
                    $price_of_unit = ($product->price_unit - $product->discount_unit);

                } else {
                    $price_of_unit = $product->price_unit;

                }

                // end calculating product price


                $clone_product = $product->replicate();
                $product_customs = $product->infos()->wherePivot('store_id', '=', $store_id)->get()->first();
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
                $minus_unit = $order_units->sum('quantity_unit');
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
                $product->sp_unit_price = $price_of_unit;
                $product->sp_total_price = $price_of_total;
                $product->images;

            }

            unset($transfer->transfer);

        }

        return $this->ApiResponce($transfers);
    }
}
