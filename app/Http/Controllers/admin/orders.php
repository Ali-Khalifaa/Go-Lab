<?php

namespace App\Http\Controllers\admin;

use App\Option;
use App\Out;
use App\Dept;
use App\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use App\order_unit;
use App\Mandob;
use App\Product;
use App\Sms_Message;
use App\Min_price;
use App\Locker;
use App\User;
use App\Offer_point;
use App\User_Point;
use App\Info_Expiration;
use App\Traits\NotificationTrait;
use Auth;
use File;
use App\Receipt_status;
use App\Return_reason;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class orders extends Controller
{
    use NotificationTrait;

    public function index()
    {
        $orders = Order::where([
            ['is_complete', '=', 1],
            ['is_direct_sell', '=', 0]
        ])->orderBy('order_stage_id', 'asc')->orderBy('date_of_order', 'desc')->get();
        $option = Option::findOrFail(2)->is_active;
        return view('admin.orders.index', compact('orders', 'option'));
    }


    public function indexOfInvoices()
    {
        $orders = Order::where([
            ['is_complete', '=', 1],
            ['is_direct_sell', '=', 1]
        ])->orderBy('order_stage_id', 'asc')->orderBy('date_of_order', 'desc')->get();

        $drepy = Order::where([
            ['is_complete', '=', 1],
            ['is_direct_sell', '=', 1],
            ['fatora_dripa','=',1]
        ])->count();

        $not_drepy = Order::where([
            ['is_complete', '=', 1],
            ['is_direct_sell', '=', 1],
            ['fatora_dripa','=',0]
        ])->count();
        return view('admin.Invoices.index', compact('orders','drepy','not_drepy'));
    }

    public function indexNetProfitOfInvoices()
    {
        $orders = Order::where([
            ['is_complete', '=', 1],
            ['is_direct_sell', '=', 1],
            // ['invoice_type','!=',0]
        ])->orderBy('order_stage_id', 'asc')->orderBy('date_of_order', 'desc')->get();
        foreach ($orders as $order) {

            foreach ($order->order_units as $units) {
                if ($order->type == "total") {
                    $order->net_profit = +($units->buy_price * $units->quantity_total);
                } else {
                    $order->net_profit = +($units->buy_price * $units->quantity_unit);
                }
            }
        }
        return view('admin.Invoices.net_profit_report', compact('orders'));
    }

    public function createOfInvoices($store_id)
    {
        $store = Store::find($store_id);
        $users = User::where('type', 'user')->get();
        $products = $store->products;
//        return  $products;
        $receipt_status = Receipt_status::all();
        $return_reason = Return_reason::all();
        return view('admin.Invoices.create', compact('store', 'products', 'users', 'receipt_status', 'return_reason'));
    }

    public function showFatora($id)
    {
        $order = Order::findOrFail($id);
        $order_units = $order->order_units()->get();
        return view('admin.orders.fatora', compact('order', 'order_units'));
    }

    public function store(Request $request)
    {
//        return $request->all();
        // dd($request->all());
        // dd($request->paid_value);

        //check quantity
        foreach ($request->products as $product_request)
        {
            $product = Product::findOrFail($product_request['product']);
            $av_quantity = $product->infos()->wherePivot('store_id', '=', $request['store_id'])->get()->first()->quantity;

            if ($av_quantity < $product_request['quantity'])
            {
                session()->flash('success'," الكمية المطلوبة من المنتج " .$product->name. " أكثر من الكمية المتاحة ");
                return back();
            }
        }


        if ($request->invoice_type == 0) {

            $request->validate([
                'user_id' => 'required',
                'invoice_type' => 'required',
                'type' => 'required',
                // 'payment_type'=>'required',
            ]);
            $user = User::where('id', $request['user_id'])->first();
            $user_id = $user->id;
            $products = $request->products;
            $price_total_sum = 0;
            $price_unit_sum = 0;
            $after_discount_price_of_total = 0;
            $after_discount_percentage_of_total = 0;
            $type = "";
            if ($request->type == 0) {
                $type = "total";
            } else {
                $type = "unit";
            }

            $order = new Order([
                'user_id' => $user_id,
                'store_id' => $request['store_id'],
                'comment' => $request['comment'],
                'fatora_dripa' => $request['fatora_dripa'],
                'payment_type' => 0,
                'delivery_amount' => $request['delivery_amount'],
                'visa_amount' => $request['visa_amount'],
                'qema_modafa' => $request['qema_modafa'],
                'paid_value' => $request['paid_value'],
                'price_total_sum' => 0,
                'price_unit_sum' => 0,
                'is_complete' => 1,
                'is_direct_sell' => 1,
                'order_stage_id' => 5,
                'type' => $type,
                'invoice_type' => $request['invoice_type'],
                'date_of_order' => now(),
            ]);
            $order->save();

            foreach ($products as $item) {
                $price_of_total = 0;
                $price_of_unit = 0;
                // return $item;
                $product = Product::findOrFail($item['product']);
                if (!($item['quantity'] == null || $item['quantity'] == 0)) {
                    if ($item['quantity'] == null || $item['quantity'] == 0) {
                        $item['quantity'] = 0;
                    }
                    //start of extracting price when there is a discount in product or not
                    if ($product->discount_total != 0) {
                        $price_of_total = ($product->price_total - $product->discount_total);
                        // start of calculate additional discount
                        if ($item['additional_discount_price'] != 0) {
                            $after_discount_price_of_total = $price_of_total - $item['additional_discount_price'];
                        } else {
                            $after_discount_percentage_of_total = $price_of_total - (($item['additional_discount_percentage'] / 100) * $price_of_total);
                        }
                        // start of calculate additional discount
                    } else {
                        $price_of_total = $product->price_total;
                        // start of calculate additional discount
                        if ($item['additional_discount_price'] != 0) {
                            $after_discount_price_of_total = $price_of_total - $item['additional_discount_price'];
                        } else {
                            $after_discount_percentage_of_total = $price_of_total - (($item['additional_discount_percentage'] / 100) * $price_of_total);
                        }
                        // start of calculate additional discount
                    }
                    if ($product->discount_unit != 0) {
                        $price_of_unit = ($product->price_unit - $product->discount_unit);
                        // start of calculate additional discount
                        if ($item['additional_discount_price'] != 0) {
                            $after_discount_price_of_total = $price_of_unit - $item['additional_discount_price'];
                        } else {
                            $after_discount_percentage_of_total = $price_of_unit - (($item['additional_discount_percentage'] / 100) * $price_of_unit);
                        }
                        // start of calculate additional discount
                    } else {
                        $price_of_unit = $product->price_unit;
                        // start of calculate additional discount
                        if ($item['additional_discount_price'] != 0) {
                            $after_discount_price_of_total = $price_of_unit - $item['additional_discount_price'];
                        } else {
                            $after_discount_percentage_of_total = $price_of_unit - (($item['additional_discount_percentage'] / 100) * $price_of_unit);
                        }
                        // start of calculate additional discount
                    }
                    //end of extracting price when there is a discount in product or not
                    if ($request['type'] == 0) {
                        $qty_total = $item['quantity'];
                        $qty_unit = 0;
                    } else {
                        $qty_total = 0;
                        $qty_unit = $item['quantity'];
                    }
                    $order_unit = new order_unit([
                        'quantity_total' => $qty_total,
                        'quantity_unit' => $qty_unit,
                        'price' => $price_of_total,
                        'price_unit' => $price_of_unit,
                        'buy_price' => $item['buy_price'],
                        'additional_discount_price' => $item['additional_discount_price'],
                        'additional_discount_percentage' => $item['additional_discount_percentage'],
                        'return_status' => $item['return_status'],
                        'product_id' => $item['product'],
                        'order_id' => $order->id,
                    ]);
                    $order_unit->save();
                    $product_info = $order_unit->product->infos()->wherePivot('store_id', '=', $request['store_id'])->get()->first();
                    if ($product->discount_total != 0) {
                        if ($item['additional_discount_price'] != 0) {
                            $price_total_sum += $order_unit->quantity_total * (($product->price_total - $product->discount_total) - $order_unit->additional_discount_price);
                        } else {
                            $price_total_sum += $order_unit->quantity_total * (($product->price_total - $product->discount_total) - (($item['additional_discount_percentage'] / 100) * $price_of_total));
                        }
                    } else {
                        if ($item['additional_discount_price'] != 0) {
                            $price_total_sum += $order_unit->quantity_total * ($product->price_total - $order_unit->additional_discount_price);
                        } else {
                            $price_total_sum += $order_unit->quantity_total * ($product->price_total - (($item['additional_discount_percentage'] / 100) * $price_of_total));
                        }
                    }
                    if ($product->discount_unit != 0) {
                        if ($item['additional_discount_price'] != 0) {
                            $price_unit_sum += $order_unit->quantity_unit * (($product->price_unit - $product->discount_unit) - $order_unit->additional_discount_price);
                        } else {
                            $price_unit_sum += $order_unit->quantity_unit * (($product->price_unit - $product->discount_unit) - (($item['additional_discount_percentage'] / 100) * $price_of_unit));
                        }
                    } else {
                        if ($item['additional_discount_price'] != 0) {
                            $price_unit_sum += $order_unit->quantity_unit * ($product->price_unit - $order_unit->additional_discount_price);
                        } else {
                            $price_unit_sum += $order_unit->quantity_unit * ($product->price_unit - (($item['additional_discount_percentage'] / 100) * $price_of_unit));
                        }
                        $price_unit_sum += $order_unit->quantity_unit * ($product->price_unit - $order_unit->additional_discount_unit);
                    }
                    if ($request['type'] == 0) {
                        $final_quantity_unit = ($product->quantity_unit * $item['quantity']);
                        $data_gededa = ($product_info->quantity - ($item['quantity']));
                    } else {
                        $final_quantity_unit = ($item['quantity']);
                        $data_gededa = ($product_info->quantity - ($item['quantity'] / $product->quantity_unit));
                    }
                    if ($request['invoice_type'] == 3) {
                        $final_quantity_unit = ($product->quantity_unit * $item['quantity']);
                        $data_gededa = ($product_info->quantity + ($item['quantity']));
                    } else {
                    }
                }
                $order->update([
                    'price_total_sum' => $price_total_sum,
                    'price_unit_sum' => $price_unit_sum,
                ]);
                // gemy
            }

        }
        else {

            $request->validate([
                'user_id' => 'required',
                'invoice_type' => 'required',
                'type' => 'required',
                'payment_type' => 'required',
            ]);
            $user = User::where('id', $request['user_id'])->first();
            $user_id = $user->id;
            $products = $request->products;
            $price_total_sum = 0;
            $price_unit_sum = 0;
            $after_discount_price_of_total = 0;
            $after_discount_percentage_of_total = 0;
            $type = "";
            if ($request->type == 0) {
                $type = "total";
            } else {
                $type = "unit";
            }

            $order = new Order([
                'user_id' => $user_id,
                'store_id' => $request['store_id'],
                'comment' => $request['comment'],
                'fatora_dripa' => $request['fatora_dripa'],
                'payment_type' => $request['payment_type'],
                'delivery_amount' => $request['delivery_amount'],
                'visa_amount' => $request['visa_amount'],
                'qema_modafa' => $request['qema_modafa'],
                'paid_value' => $request['paid_value'],
                'price_total_sum' => 0,
                'price_unit_sum' => 0,
                'is_complete' => 1,
                'is_direct_sell' => 1,
                'order_stage_id' => 5,
                'type' => $type,
                'invoice_type' => $request['invoice_type'],
                'date_of_order' => now(),
            ]);
            $order->save();
            // gemy
            foreach ($products as $item) {
                $price_of_total = 0;
                $price_of_unit = 0;
                // return $item;
                $product = Product::findOrFail($item['product']);
                if (!($item['quantity'] == null || $item['quantity'] == 0)) {
                    if ($item['quantity'] == null || $item['quantity'] == 0) {
                        $item['quantity'] = 0;
                    }
                    $validator = Validator::make($item, [
                        'info_id' => 'required'
                    ]);
                    if ($validator->fails()) {
                        return back()->withErrors(' يرجى اختيار تواريخ الصلاحيه  ');
                    }
                    //start of extracting price when there is a discount in product or not
                    if ($product->discount_total != 0 && $product->date_end >= now()) {
                        $price_of_total = ($product->price_total - $product->discount_total);
                        // start of calculate additional discount
                        if ($item['additional_discount_price'] != 0) {
                            $after_discount_price_of_total = $price_of_total - $item['additional_discount_price'];
                        } else {
                            $after_discount_percentage_of_total = $price_of_total - (($item['additional_discount_percentage'] / 100) * $price_of_total);
                        }
                        // start of calculate additional discount
                    } else {
                        $price_of_total = $product->price_total;
                        // start of calculate additional discount
                        if ($item['additional_discount_price'] != 0) {
                            $after_discount_price_of_total = $price_of_total - $item['additional_discount_price'];
                        } else {
                            $after_discount_percentage_of_total = $price_of_total - (($item['additional_discount_percentage'] / 100) * $price_of_total);
                        }
                        // start of calculate additional discount
                    }
                    if ($product->discount_unit != 0) {
                        $price_of_unit = ($product->price_unit - $product->discount_unit);
                        // start of calculate additional discount
                        if ($item['additional_discount_price'] != 0) {
                            $after_discount_price_of_total = $price_of_unit - $item['additional_discount_price'];
                        } else {
                            $after_discount_percentage_of_total = $price_of_unit - (($item['additional_discount_percentage'] / 100) * $price_of_unit);
                        }
                        // start of calculate additional discount
                    } else {
                        $price_of_unit = $product->price_unit;
                        // start of calculate additional discount
                        if ($item['additional_discount_price'] != 0) {
                            $after_discount_price_of_total = $price_of_unit - $item['additional_discount_price'];
                        } else {
                            $after_discount_percentage_of_total = $price_of_unit - (($item['additional_discount_percentage'] / 100) * $price_of_unit);
                        }
                        // start of calculate additional discount
                    }
                    //end of extracting price when there is a discount in product or not
                    if ($request['type'] == 0) {
                        $qty_total = $item['quantity'];
                        $qty_unit = 0;
                    } else {
                        $qty_total = 0;
                        $qty_unit = $item['quantity'];
                    }
                    $order_unit = new order_unit([
                        'quantity_total' => $qty_total,
                        'quantity_unit' => $qty_unit,
                        'price' => $price_of_total,
                        'price_unit' => $price_of_unit,
                        'buy_price' => $item['buy_price'],
                        'additional_discount_price' => $item['additional_discount_price'],
                        'additional_discount_percentage' => $item['additional_discount_percentage'],
                        'return_status' => $item['return_status'],
                        'product_id' => $item['product'],
                        'order_id' => $order->id,
                    ]);
                    $order_unit->save();
                    $product_info = $order_unit->product->infos()->wherePivot('store_id', '=', $request['store_id'])->get()->first();
                    if ($product->discount_total != 0) {
                        if ($item['additional_discount_price'] != 0) {
                            $price_total_sum += $order_unit->quantity_total * (($product->price_total - $product->discount_total) - $order_unit->additional_discount_price);
                        } else {
                            $price_total_sum += $order_unit->quantity_total * (($product->price_total - $product->discount_total) - (($item['additional_discount_percentage'] / 100) * $price_of_total));
                        }
                    } else {
                        if ($item['additional_discount_price'] != 0) {
                            $price_total_sum += $order_unit->quantity_total * ($product->price_total - $order_unit->additional_discount_price);
                        } else {
                            $price_total_sum += $order_unit->quantity_total * ($product->price_total - (($item['additional_discount_percentage'] / 100) * $price_of_total));
                        }
                    }
                    if ($product->discount_unit != 0) {
                        if ($item['additional_discount_price'] != 0) {
                            $price_unit_sum += $order_unit->quantity_unit * (($product->price_unit - $product->discount_unit) - $order_unit->additional_discount_price);
                        } else {
                            $price_unit_sum += $order_unit->quantity_unit * (($product->price_unit - $product->discount_unit) - (($item['additional_discount_percentage'] / 100) * $price_of_unit));
                        }
                    } else {
                        if ($item['additional_discount_price'] != 0) {
                            $price_unit_sum += $order_unit->quantity_unit * ($product->price_unit - $order_unit->additional_discount_price);
                        } else {
                            $price_unit_sum += $order_unit->quantity_unit * ($product->price_unit - (($item['additional_discount_percentage'] / 100) * $price_of_unit));
                        }
                        $price_unit_sum += $order_unit->quantity_unit * ($product->price_unit - $order_unit->additional_discount_unit);
                    }
                    if ($request['type'] == 0) {
                        $final_quantity_unit = ($product->quantity_unit * $item['quantity']);
                        $data_gededa = ($product_info->quantity - ($item['quantity']));
                        $info_expiration = Info_Expiration::where('id', $item['info_id'])->first();
                        if ($info_expiration != null) {
                            $info_expiration->update([
                                'quantity_total' => $info_expiration->quantity_total - $item['quantity'],
                                'quantity_unit' => $info_expiration->quantity_unit - ($product->quantity_unit * $item['quantity']),
                            ]);
                        } else {
                        }
                    } else {
                        $final_quantity_unit = ($item['quantity']);
                        $data_gededa = ($product_info->quantity - ($item['quantity'] / $product->quantity_unit));
                        $info_expiration = Info_Expiration::where('id', $item['info_id'])->first();
                        if ($info_expiration != null) {
                            $info_expiration->update([
                                'quantity_total' => $info_expiration->quantity_total - ($item['quantity'] / $product->quantity_unit),
                                'quantity_unit' => $info_expiration->quantity_unit - $item['quantity'],
                            ]);
                        } else {
                        }
                    }
                    if ($request['invoice_type'] == 3) {
                        $final_quantity_unit = ($product->quantity_unit * $item['quantity']);
                        $data_gededa = ($product_info->quantity + ($item['quantity']));
                    } else {
                        // $final_quantity_unit=($item['quantity']);
                        // $data_gededa=($product_info->quantity+($item['quantity']/$product->quantity_unit));
                    }
                    $product_info->update([
                        'quantity' => $data_gededa,

                        'quantity_unit' => $product_info->quantity_unit + $final_quantity_unit,
                    ]);
                }
                $order->update([
                    'price_total_sum' => $price_total_sum,
                    'price_unit_sum' => $price_unit_sum,
                ]);
                $depts_total = 0;
                if ($request->type == 0) {
                    $depts_total = $order->price_total_sum;
                } else {
                    $depts_total = $order->price_unit_sum;
                }
                if ($order->payment_type == 1) {
                    $depts = new Dept([
                        'user_id' => $order->user->id,
                        'order_id' => $order->id,
                        'total' => $depts_total,
                        'paid' => $order->paid_value,
                        'status' => 1,
                        'date' => now(),
                    ]);
                    $depts->save();
                }
                //start cash back
                $order_id = $order->id;
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
                        $dept = new Dept([
                            'user_id' => $order->user->id,
                            'order_id' => $order->id,
                            'total' => $discounts['total_discount_later'] + $discounts['unit_discount_now'],
                            'paid' => 0,
                            'date' => now(),
                        ]);
                        $dept->save();
                    } else {
                        $dept = false;
                    }
                }
                // check cashback
                if (Option::find(4)->is_active) {
                    $cashback = $this->getCashBackOfAllExceptWithOrderId($order->user->id, $order->id);
                    $cashback_of_current_order_id = $this->getCashBackOfCurrentOrderId($order->user->id, $order->id);
                    if ($cashback) {
                        $second_last_order = $order->user->orders()->orderBy('created_at', 'desc')->skip(1)->take(1)->get()->first();
                        if ($second_last_order != null) {
                            if ($second_last_order->future_cash_back != 0) {
                                $order->update([
                                    'cash_back' => $second_last_order->future_cash_back + $cashback,
                                ]);
                            }
                        }
                    } else {
                        $second_last_order = $order->user->orders()->orderBy('created_at', 'desc')->skip(1)->take(1)->get()->first();
                        if ($second_last_order != null) {
                            if ($second_last_order->future_cash_back != 0) {
                                $order->update([
                                    'cash_back' => $second_last_order->future_cash_back,
                                ]);
                            }
                        }
                    }
                    if ($cashback_of_current_order_id) {
                        $order->update([
                            'future_cash_back' => $cashback_of_current_order_id
                        ]);

                        $dept = $order->user->depts()->first();
                        $dept->paid = $order->future_cash_back;
                        $dept->save();
                    }
                }
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
                    // 'paid_value'   => $total_after_dis,
                    'total_minus_paid' => $total_minus_paid,
                ]);

                // end cash back
                // gemy
            }

            $price_total = $order->total_price;
            $actual_price = $order->total_price;
            $offer_point = Offer_point::all();
            $cash_back = 0;
            $offer_points_id = 0;
            // if(!$offer_point==null)
            // {
            // foreach ($offer_point as $disc) {
            /*$price_total=$order->total_price;
            $offer_point=Offer_point::all();
            $cash_back=0;*/
            if (!$offer_point == null) {
                foreach ($offer_point as $disc) {
                    if ($disc->total <= $price_total) {

                        $cash_back = $disc->points;
                        $offer_points_id = $disc->id;
                    } else {
                    }

                }
                if ($cash_back != 0) {
                    $user_point = new User_Point;
                    $user_point->user_id = $order->user->id;
                    $user_point->order_id = $order->id;
                    $user_point->offer_point_id = $offer_points_id;
                    $user_point->points = $cash_back;
                    $user_point->save();
                }
                // $price_total-=$cash_back;
                // $order->price_before_discount=$actual_price;
                // $order->total_price=$price_total;
                // $order->update();
            } else {
            }

            // }
            // }else
            // {
            // }

        }
        return redirect('admin/invoices');
    }


    public function indexOfMinPrice()
    {
        $orders = Min_price::all();
        return view('admin.orders.index-of-min-price', compact('orders'));
    }

    public function changeMinPrice(Request $request)
    {
        $orders = Min_price::findOrFail($request->id);
        $orders->price = $request->price;
        $orders->save();
        session()->flash('success', 'تم التعديل بنجاح');
        return back();
    }

    public function indexOfOrderOfFinance_managers($id)
    {
        $orders = Order::where([
            ['is_complete', '=', 1],
            ['is_direct_sell', '=', 0],
            ['finance_manager_id', '=', $id]
        ])->orderBy('order_stage_id', 'asc')->get();
        $option = Option::findOrFail(2)->is_active;
        return view('admin.orders.index', compact('orders', 'option'));
    }

    public function indexOfOrderOfSeller($id)
    {
        $orders = Order::where([
            ['is_complete', '=', 1],
            ['is_direct_sell', '=', 0],
            ['seller_id', '=', $id]
        ])->orderBy('order_stage_id', 'asc')->get();
        $option = Option::findOrFail(2)->is_active;
        return view('admin.orders.index', compact('orders', 'option'));
    }

    public function indexOfOrderOfKeeper($id)
    {
        $orders = Order::where([
            ['is_complete', '=', 1],
            ['is_direct_sell', '=', 0],
            ['keeper_id', '=', $id]
        ])->orderBy('order_stage_id', 'asc')->get();
        $option = Option::findOrFail(2)->is_active;
        return view('admin.orders.index', compact('orders', 'option'));
    }

    public function indexOfDirectSellOrderOfFinance_managers($id)
    {
        $orders = Order::where([
            ['is_direct_sell', '=', 1],
            ['direct_sell_finance_manager_id', '=', $id]
        ])->orderBy('is_complete', 'asc')->get();
        $option = Option::findOrFail(2)->is_active;
        return view('admin.orders.direct_sell', compact('orders', 'option'));
    }

    public function indexOfDirectSellOrderOfSeller($id)
    {
        $orders = Order::where([
            ['is_direct_sell', '=', 1],
            ['seller_id', '=', $id]
        ])->orderBy('is_complete', 'asc')->get();
        $option = Option::findOrFail(2)->is_active;
        return view('admin.orders.direct_sell', compact('orders', 'option'));
    }

    public function indexOfDirectSellOrderOfKeeper($id)
    {
        $orders = Order::where([
            ['is_direct_sell', '=', 1],
            ['direct_selle_keeper_id', '=', $id]
        ])->orderBy('is_complete', 'asc')->get();
        $option = Option::findOrFail(2)->is_active;
        return view('admin.orders.direct_sell', compact('orders', 'option'));
    }


    public function orderReport()
    {
        $orders = Order::where([
            ['is_complete', '=', 1],
            ['is_direct_sell', '=', 0]
        ])->orderBy('order_stage_id', 'asc')->get();
        $option = Option::findOrFail(2)->is_active;
        return view('admin.orders.order_report', compact('orders', 'option'));
    }


    public function ordersWithRecalls()
    {
        $orders = Order::where([
            ['is_complete', '=', 1],
            ['is_direct_sell', '=', 0],
            ['has_recall', '=', 1],
        ])->orderBy('order_stage_id', 'asc')->get();
        $option = Option::findOrFail(2)->is_active;
        return view('admin.orders.order_report', compact('orders', 'option'));
    }


    public function confirmReceivedMoneyOfOrder($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.orders.confirm-received-money', compact('order'));
    }


    public function confirmReceivedMoneyOfDirectSellOrder($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.orders.confirm-received-money', compact('order'));
    }

    public function yesConfirmReceivedMoneyOfOrder(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->confirm_received_money = 1;
        $order->received_money_from_f_m = $request->received_money_from_f_m;
        $order->finance_manager_id = Auth::user()->id;
        $order->save();
        $orders = Order::where([
            ['is_complete', '=', 1],
            ['is_direct_sell', '=', 0]
        ])->orderBy('order_stage_id', 'asc')->get();
        $option = Option::findOrFail(2)->is_active;
        return view('admin.orders.index', compact('orders', 'option'));
        // return view('admin.orders.confirm-received-money',compact('order'));
    }


    public function yesConfirmDeliveryReceiptOfOrder($id)
    {

        $order = Order::findOrFail($id);
        $order->confirm_delivery_receipt = 1;
        $order->keeper_id = Auth::user()->id;
        $order->save();

        $lockers = new Locker();
        $lockers->number = ($order->price_total_sum + $order->price_unit_sum);
        $lockers->type = 0;
        $lockers->foreign_id = $order->id;
        $lockers->user_id = Auth::user()->id;
        $lockers->store_id = $order->store_id;
        $lockers->category = 'online';
        $lockers->save();

        // dd($order);
        $orders = Order::where([
            ['is_complete', '=', 1],
            ['is_direct_sell', '=', 0]
        ])->orderBy('order_stage_id', 'asc')->get();
        $option = Option::findOrFail(2)->is_active;
        return back();
        // return view('admin.orders.confirm-received-money',compact('order'));
    }


    public function yesConfirmDirectSelleDeliveryReceiptOfOrder($id)
    {

        $order = Order::findOrFail($id);
        $order->direct_selle_confirm_delivery_receipt = 1;
        $order->direct_selle_keeper_id = Auth::user()->id;
        $order->save();

        $lockers = new Locker();
        $lockers->number = ($order->price_total_sum + $order->price_unit_sum);
        $lockers->type = 0;
        $lockers->foreign_id = $order->id;
        $lockers->user_id = Auth::user()->id;
        $lockers->store_id = $order->store_id;
        $lockers->category = 'direct';
        $lockers->save();

        // dd($order);
        $orders = Order::where([
            ['is_direct_sell', '=', 1],
        ])->orderBy('order_stage_id', 'asc')->get();
        $option = Option::findOrFail(2)->is_active;
        return back();
        // return view('admin.orders.confirm-received-money',compact('order'));
    }

    public function yesConfirmReceivedMoneyOfDirectSellOrder(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->received_direct_sell_money_from_f_m = $request->received_direct_sell_money_from_f_m;
        $order->direct_sell_finance_manager_id = Auth::user()->id;
        $order->save();
        $orders = Order::where([
            ['is_direct_sell', '=', 1],
        ])->orderBy('is_complete', 'asc')->get();
        $option = Option::findOrFail(2)->is_active;
        return view('admin.orders.direct_sell', compact('orders', 'option'));
        // return view('admin.orders.confirm-received-money',compact('order'));
    }

    public function indexOfMandopsOrder($id)
    {
        $orders = Order::where([
            ['mandob_id', '=', $id],
        ])->orderBy('order_stage_id', 'asc')->get();
        $option = Option::findOrFail(2)->is_active;
        return view('admin.orders.index', compact('orders', 'option'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     $orders=Order::orderBy('order_stage_id', 'asc')->get();
    //     $products=Product::all();
    //     return view('admin.orders.create',compact('orders','products'));
    // }

    public function create($id)
    {
        $orders = Order::all();
        $store = Store::findOrFail($id);
        $users = User::where('role', 'user')->get();
        $products = Product::all();
        return view('admin.orders.create', compact('orders', 'products', 'users', 'store'));
    }

    public function needed($id)
    {
        $array = [];
        $store = Store::where('id', $id)->first();
        $products = $store->products()->get();
        foreach ($products as $prod) {
            $value = $prod->infos()->wherePivot('store_id', '=', $id)->first();
            //   where('quantity','<','reorder_limit')->
            if ($value->quantity < $value->reorder_limit) {
                $array[] = $prod;
            }

        }

        // dd($array);
        return view('admin.stores.show-needed-product', compact('array', 'store'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     $orders = new Order();
    //     $orders->product_id = $request->product_id;
    //     $products=Product::where('id', $orders->product_id)->first();

    //     $orders->user_id = Auth::id();
    //     $orders->quantity = $request->quantity;
    //     $orders->complete_id = $request->complete_id;
    //     $orders->stage_id = $request->stage_id;
    //     $orders->quantity_unit = $request->quantity_unit;
    //     $orders->discount = $products->discount * $request->quantity;
    //     $orders->price = $products->price * $request->quantity - $orders->discount;
    //     $orders->price_unit = $products->price_unit * $request->quantity_unit;

    //     $orders->save();
    //     return redirect('admin/orders');
    // }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);
        $order_units = $order->order_units()->get();
//        return $order_units;
        return view('admin.orders.show', compact('order', 'order_units'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $orders = Order::find($id);
        $products = Product::all();

        return view('admin.orders.edit', compact('orders', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $orders = Order::find($id);
        $orders->product_id = $request->product_id;
        $products = Product::where('id', $orders->product_id)->first();

        $orders->user_id = Auth::id();
        $orders->quantity = $request->quantity;
        $orders->complete_id = $request->complete_id;
        $orders->stage_id = $request->stage_id;
        $orders->quantity_unit = $request->quantity_unit;
        $orders->discount = $products->discount * $request->quantity;
        $orders->price = $products->price * $request->quantity - $orders->discount;
        $orders->price_unit = $products->price_unit * $request->quantity_unit;
        $orders->save();

        return redirect('admin/orders');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        foreach ($order->order_units() as $order_unit) {
            $order_unit->delete();
        }
        $order->delete();
        return back(); //
    }

    public function tracks($id)
    {
        $orders = Order::find($id);
        return view('admin.orders.track', compact('orders'));
    }

    public function track(Request $request, $id, $user_id)
    {
        $orders = Order::find($id);
        $distinct = Order::select('order_id')->distinct()->get();
        $order = Order::where('order_id', $id)->where('user_id', $user_id)->get();
        foreach ($order as $orde) {
            $orde->stage_id = $request->stage_id;

            $orde->save();
        }
        return redirect('admin/orders');
    }

    public function mandobs($id)
    {
        $order = Order::find($id);
        $place = $order->store->place;
        $mandobs = $place->mandobs;
        return view('admin.orders.mandobs', compact('order', 'mandobs'));
    }

    public function mandob(Request $request, $id)
    {
        $request->validate([
            'mandob_id' => 'required'
        ]);
        $order = Order::find($id);
        $order->update([
            'mandob_id' => $request->mandob_id
        ]);

        return redirect('admin/orders/show/' . $id);
    }

    public function changeStage($order_id, $stage_id)
    {
        if ($stage_id < 1 || $stage_id > 3) {
            return 'error';
        }
        $order = Order::findOrFail($order_id);
        $order->update([
            'order_stage_id' => $stage_id,
            'seller_id' => Auth::user()->id,
        ]);
        if ($order->order_stage_id == 2) {
            // dd('here');
            $order_units = $order->order_units;
            foreach ($order_units as $index => $order_unit) {
                // if($index==4){
                $info = $order_unit->product->infos()->wherePivot('store_id', $order->store_id)->get()->first();

                // $receive_total=0;
                // $receive_unit=$order_unit->quantity_unit;


                $product = Product::findOrFail($order_unit->product_id);


                if ($order_unit->quantity_unit > 0) {
                    // dd('quantity_unit > 0');

                    // $final_quantity=$order_unit->quantity_total;
                    $final_quantity_unit = ($product->quantity_unit * $order_unit->quantity_total) + $order_unit->quantity_unit;
                    $data_gededa = ($info->quantity - ($order_unit->quantity_total + ($order_unit->quantity_unit / $product->quantity_unit)));
                    // $final_quantity_unit;
                } else {
                    // dd('quantity_unit = 0');
                    $final_quantity_unit = ($order_unit->quantity_total * $product->quantity_unit);
                    //  return   $order_unit->quantity_total;
                    $data_gededa = ($info->quantity - ($order_unit->quantity_total));
                }
                // if($order_unit['quantity']>0)
                // {
                //     $data_gededa=($info->quantity-($order_unit['quantity']+($order_unit['quantity_unit']/$product->quantity_unit)));
                // }
                // elseif($order_unit['quantity']==0){
                //     $data_gededa=($info->quantity-($order_unit['quantity']+($order_unit['quantity_unit']/$product->quantity_unit)));
                // }
                // $data_gededa=($info->quantity-($order_unit['quantity']+($order_unit['quantity_unit']/$product->quantity_unit)));

                $info->update([
                    // 'quantity' => $info->quantity -$quantity,
                    'quantity' => $data_gededa,
                    // 'quantity_unit' => $info->quantity_unit- $quantity_unit
                    'quantity_unit' => $info->quantity_unit - $final_quantity_unit,
                ]);


                // if($item['quantity_unit']>0)
                // {
                //   $final_quantity_unit=($product->quantity_unit*$item['quantity'])+$item['quantity_unit'];
                // }
                // else{
                //     $final_quantity_unit=$item['quantity_unit'];
                // }
                // $data_gededa=($product_info->quantity-($item['quantity']+($item['quantity_unit']/$product->quantity_unit)));
                // $product_info->update([
                //     'quantity' => $data_gededa,

                //     'quantity_unit' => $product_info->quantity_unit - $final_quantity_unit,
                // ]);


            }
        }
        // }
        // dd('here1');


        return back();
    }

    public function cancelOrder($order_id)
    {

        $order = Order::findOrFail($order_id);
        $order->update([
            'is_canceled' => 1,
        ]);
        return back();
    }

    public function makeOutPermission($order_id)
    {
        $order = Order::findOrFail($order_id);
        $discount = 0;

        if (count($order->discount) > 0)
        {
            $discount += $order->discount->sum('discount');
        }

        if ($order->promoCode != null)
        {
            $discount += $order->promoCode->discount;
        }

        $order_units = $order->order_units()->get();

        $store = $order->store()->get()->first();
        if (empty($order->out()->get()->first())) {
            // check first if all order Units are available
            foreach ($order_units as $order_unit) {
                $product = Product::find($order_unit->product_id);
                $product_info = $product->infos()->wherePivot('store_id', '=', $store->id)->get()->first();
                $all_as_units = $order_unit->quantity_total * $product->quantity_unit + $order_unit->quantity_unit;
            }
            // Change values in Store Out
            foreach ($order_units as $order_unit) {
                $product = Product::find($order_unit->product_id);
                $product_info = $product->infos()->wherePivot('store_id', '=', $store->id)->get()->first();
                // Change Quantity
                $all_as_units = $order_unit->quantity_total * $product->quantity_unit + $order_unit->quantity_unit;
                $quantity_unit = $product_info->quantity_unit - $all_as_units;
                //floor down Quantity
                $quantity = floor($quantity_unit / $product->quantity_unit);
                $product_info->update([
                    'quantity' => $quantity,
                    'quantity_unit' => $quantity_unit
                ]);
            }


            //Create out permission
            $out = new Out([
                'date' => now(),
                'order_id' => $order_id
            ]);
            $out->save();
        } else {
            $out = $order->out()->get()->first();
        }
        return view('admin.orders.out', compact('order', 'order_units', 'store', 'out','discount'));

    }

    public function directSells()
    {
        $orders = Order::where('is_direct_sell', 1)->orderBy('is_complete', 'asc')->get();
        return view('admin.orders.direct_sell', compact('orders'));
    }

    public function selectStore($order_id)
    {
        $order = Order::findOrFail($order_id);
        $stores = Store::all();
        return view('admin.orders.select_store', compact('order', 'stores'));
    }

    public function postSelect(Request $request)
    {
        $order = Order::findORFail($request->order_id);
        $order->update([
            'store_id' => $request->store_id
        ]);
        return redirect(url('admin/orders'));
    }

}
