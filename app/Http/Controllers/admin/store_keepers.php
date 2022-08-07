<?php

namespace App\Http\Controllers\admin;

use App\Category;
use App\Dept;
use App\Examination;
use App\Examination_unit;
use App\Finance_shift;
use App\In;
use App\Info;
use App\lose;
use App\Mandob;
use App\mondob_rate;
use App\Notify_name;
use App\Option;
use App\Order;
use App\order_unit;
use App\Out;
use App\Product;
use App\Receipt_status;
use App\Return_reason;
use App\Shift;
use App\Store;
use App\Supplier;
use App\Supplier_dept;
use App\Traits\NotificationTrait;
use App\Transfer;
use App\User;
use App\Locker;
use App\Info_Expiration;
use App\user_rate;
use App\Edited_Order_Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class store_keepers extends Controller
{
    use NotificationTrait;

    public function index(Request $request)
    {
        // current store keeper
        if (!empty(Auth::user()->store()->get()->first())) {
            $store = Auth::user()->store()->get()->first();
        } // store manager
        elseif (!empty(Auth::user()->manager_store()->get()->first())) {
            $store = Auth::user()->manager_store()->get()->first();
        } elseif (!empty(Auth::user()->keeper_store()->get()->first())) {
            $store = Auth::user()->keeper_store()->get()->first();
        } elseif (!empty(Auth::user()->finance_manager_store()->get()->first())) {
            $store = Auth::user()->finance_manager_store()->get()->first();
        } else {
            return back()->withErrors('لا يمكنك رؤية فواتير الشراء');
        }
        $examinations = $store->examinations()->when($request->has('from_date'), function ($query) use ($request) {
            return $query->whereDate('date_of_examination', '>=', $request->from_date);
        })->when($request->has('to_date'), function ($query) use ($request) {
            return $query->whereDate('date_of_examination', '<=', $request->to_date);
        })->orderBy('is_received', 'asc')->orderBy('date_of_examination', 'desc')->get();

        return view('admin.examination.index', compact('store', 'examinations'));
    }

    public function indexExamination(Request $request, $store_id)
    {
        if (!empty(Auth::user()->store()->get()->first())) {
            $store = Store::find($store_id);
        } elseif (!empty(Auth::user()->seller_store()->get()->first())) {
            $store = Store::find($store_id);
        } elseif (!empty(Auth::user()->store_accountant()->get()->first())) {
            $store = Store::find($store_id);
        }
        $examinations = $store->examinations()->when($request->has('from_date'), function ($query) use ($request) {
            return $query->whereDate('date_of_examination', '>=', $request->from_date);
        })->when($request->has('to_date'), function ($query) use ($request) {
            return $query->whereDate('date_of_examination', '<=', $request->to_date);
        })->orderBy('created_at', 'desc')->get();

        return view('admin.examination.index', compact('store', 'examinations'));
    }


    public function indexOfExaminationOfFinance_managers(Request $request, $id)
    {
        // current store keeper
        if (!empty(Auth::user()->store()->get()->first())) {
            $store = Auth::user()->store()->get()->first();
        } // store manager
        elseif (!empty(Auth::user()->manager_store()->get()->first())) {
            $store = Auth::user()->manager_store()->get()->first();
        } elseif (!empty(Auth::user()->keeper_store()->get()->first())) {
            $store = Auth::user()->keeper_store()->get()->first();
        } elseif (!empty(Auth::user()->finance_manager_store()->get()->first())) {
            $store = Auth::user()->finance_manager_store()->get()->first();
        } else {
            return back()->withErrors('لا يمكنك رؤية فواتير الشراء');
        }
        $examinations = $store->examinations()->where('who_paid', $id)->when($request->has('from_date'), function ($query) use ($request) {
            return $query->whereDate('date_of_examination', '>=', $request->from_date);
        })->when($request->has('to_date'), function ($query) use ($request) {
            return $query->whereDate('date_of_examination', '<=', $request->to_date);
        })->orderBy('is_received', 'asc')->orderBy('date_of_examination', 'desc')->get();

        return view('admin.examination.index-of-examination-of-finance_managers', compact('store', 'examinations'));
    }


    public function indexOfExaminationOfSeller(Request $request, $id)
    {
        // current store keeper
        if (!empty(Auth::user()->store()->get()->first())) {
            $store = Auth::user()->store()->get()->first();
        } // store manager
        elseif (!empty(Auth::user()->manager_store()->get()->first())) {
            $store = Auth::user()->manager_store()->get()->first();
        } elseif (!empty(Auth::user()->keeper_store()->get()->first())) {
            $store = Auth::user()->keeper_store()->get()->first();
        } elseif (!empty(Auth::user()->finance_manager_store()->get()->first())) {
            $store = Auth::user()->finance_manager_store()->get()->first();
        } else {
            return back()->withErrors('لا يمكنك رؤية فواتير الشراء');
        }
        $examinations = $store->examinations()->where('who_paid', $id)->when($request->has('from_date'), function ($query) use ($request) {
            return $query->whereDate('date_of_examination', '>=', $request->from_date);
        })->when($request->has('to_date'), function ($query) use ($request) {
            return $query->whereDate('date_of_examination', '<=', $request->to_date);
        })->orderBy('is_received', 'asc')->orderBy('date_of_examination', 'desc')->get();

        return view('admin.examination.index-of-examination-of-finance_managers', compact('store', 'examinations'));
    }


    public function indexOfExaminationOfKeeper(Request $request, $id)
    {
        // current store keeper
        if (!empty(Auth::user()->store()->get()->first())) {
            $store = Auth::user()->store()->get()->first();
        } // store manager
        elseif (!empty(Auth::user()->manager_store()->get()->first())) {
            $store = Auth::user()->manager_store()->get()->first();
        } elseif (!empty(Auth::user()->keeper_store()->get()->first())) {
            $store = Auth::user()->keeper_store()->get()->first();
        } elseif (!empty(Auth::user()->finance_manager_store()->get()->first())) {
            $store = Auth::user()->finance_manager_store()->get()->first();
        } else {
            return back()->withErrors('لا يمكنك رؤية فواتير الشراء');
        }
        $examinations = $store->examinations()->where('keeper_id', $id)->when($request->has('from_date'), function ($query) use ($request) {
            return $query->whereDate('date_of_examination', '>=', $request->from_date);
        })->when($request->has('to_date'), function ($query) use ($request) {
            return $query->whereDate('date_of_examination', '<=', $request->to_date);
        })->orderBy('is_received', 'asc')->orderBy('date_of_examination', 'desc')->get();

        return view('admin.examination.index-of-examination-of-finance_managers', compact('store', 'examinations'));
    }


    public function indexOfExaminationOfManager(Request $request, $id)
    {

        // current store keeper
        if (!empty(Auth::user()->store()->get()->first())) {
            $store = Auth::user()->store()->get()->first();
        } // store manager
        elseif (!empty(Auth::user()->manager_store()->get()->first())) {
            $store = Auth::user()->manager_store()->get()->first();
        } elseif (!empty(Auth::user()->keeper_store()->get()->first())) {
            $store = Auth::user()->keeper_store()->get()->first();
        } elseif (!empty(Auth::user()->finance_manager_store()->get()->first())) {
            $store = Auth::user()->finance_manager_store()->get()->first();
        } else {
            return back()->withErrors('لا يمكنك رؤية فواتير الشراء');
        }
        $examinations = $store->examinations()->where('manager_id', $id)->when($request->has('from_date'), function ($query) use ($request) {
            return $query->whereDate('date_of_examination', '>=', $request->from_date);
        })->when($request->has('to_date'), function ($query) use ($request) {
            return $query->whereDate('date_of_examination', '<=', $request->to_date);
        })->orderBy('is_received', 'asc')->orderBy('date_of_examination', 'desc')->get();

        return view('admin.examination.index-of-examination-of-finance_managers', compact('store', 'examinations'));
    }

    public function makeExaminationOutBill($order_id)
    {
        $order = Examination::findOrFail($order_id);
        $order_units = $order->examination_units()->get();
        $store = $order->store()->get()->first();
        return view('admin.examination.out', compact('order', 'order_units', 'store'));
    }

    public function showFatora($order_id)
    {
        $order = Examination::findOrFail($order_id);
        $order_units = $order->examination_units()->get();
        return view('admin.examination.fatora', compact('order', 'order_units'));
    }

    // public function createExamination()
    // {
    //     $store_keeper = Auth::user();
    //     $store = $store_keeper->manager_store();
    //     $store = $store->with('products')->get();
    //     $products = $store->first()['products'];
    //     $store = $store->first();
    //     $receipt_statuses = Receipt_status::all();
    //     $return_reasons = Return_reason::all();
    //     $suppliers = Supplier::where('is_active', 1)->get();

    //     return view('admin.examination.create',
    //         compact('store_keeper', 'store', 'products', 'receipt_statuses', 'return_reasons', 'suppliers'));
    // }


    public function expiration(Request $request)
    {

        $info_expiration = Info_Expiration::when($request->has('from_date'), function ($query) use ($request) {
            return $query->whereDate('expiry_date', '>=', $request->from_date);
        })->when($request->has('to_date'), function ($query) use ($request) {
            return $query->whereDate('expiry_date', '<=', $request->to_date);
        })->get();

        $stores = Store::all();

        return view('admin.products.products-expiration', compact('stores', 'info_expiration'));
    }


    public function createExamination()
    {
        $store_keeper = Auth::user();
        // $store = $store_keeper->store();
        $store = $store_keeper->manager_store();
        $store = $store->with('products')->get();
        $products = $store->first()['products'];
        //  $products;
        $store = $store->first();
        $receipt_statuses = Receipt_status::all();
        $return_reasons = Return_reason::all();
        $suppliers = Supplier::where('is_active', 1)->get();
        //start new

        $pro_sub_catego = [];
        $pro_main_catego = Category::all();
        // $products = $store->products()->with('infos')->wherePivot('store_id', '=', $store->id)->get();
        $pro_sub_cat = $store->first()['products'];
        foreach ($pro_sub_cat as $pro_sub_ca) {
            if ($pro_sub_ca->subcategory) {
                $pro_sub_catego[] = $pro_sub_ca->subcategory;
            }
        }
        $pro_sub_catego = array_unique($pro_sub_catego);


        // end new

        return view('admin.examination.create',
            compact('store_keeper', 'store', 'products', 'receipt_statuses', 'return_reasons', 'suppliers', 'pro_main_catego', 'pro_sub_catego'));
    }


    public function createStepTwoExamination(Request $request)
    {
        $supplier_id = $request->supplier_id;
        $rest_price = 0;
        $store_id = $request->store_id;
        $id = $request->main_cat_id;

        $store_keeper = Auth::user();
        $receipt_statuses = Receipt_status::all();
        $return_reasons = Return_reason::all();
        $store = Store::where('id', $store_id)->first();

        $products = $store->products()->where('category_id', $id)->with('infos')->wherePivot('store_id', '=', $store->id)->get();

        foreach ($products as $prod) {
            $prod->infos()->wherePivot('store_id', '=', $store->id)->get()->first();
        }


        return view('admin.examination.create2',
            compact('store_keeper', 'store', 'products', 'receipt_statuses', 'return_reasons', 'supplier_id', 'rest_price'));
    }


    public function is_paid(Request $request)
    {
        $user_id = Auth::user()->id;
        // dd($user_id);
        $examination = Examination::where('id', $request->id)->first();
        $examination->paid = $request->paid_count;
        $examination->is_paid = 1;
        $examination->who_paid = $user_id;
        $examination->save();

        if (($examination->total - $request->paid_count) != 0) {
            $supplier_dept = new Supplier_dept([
                'amount' => $examination->total - $request->paid_count,
                'examination_id' => $examination->id,
                'supplier_id' => $examination->supplier_id,
                'store_id' => $examination->store_id,
            ]);
            $supplier_dept->save();
        }

        // $supplier_dept=new Supplier_dept;
        // $supplier_dept->amount=($examination->total - $request->paid_count);
        // $supplier_dept->supplier_id=$examination->supplier_id;
        // $supplier_dept->examination_id=$examination->id;

        return back();
    }


    public function is_recived(Request $request)
    {
        $user_id = Auth::user()->id;
        // dd($user_id);
        $examination = Examination::where('id', $request->id)->first();
        $examination->is_received = 1;
        $examination->who_received = $user_id;
        // dd($examination->who_paid);
        $examination->save();

        return back();
    }


    public function storeExamination(Request $request)
    {
//        return $request->all();

        if (empty(Auth::user()->manager_store)) {
            return back()->withErrors('المسؤلين فقط لديهم الحق بعمل فاتورة شراء');
        }
        function containsOnlyNull($input)
        {
            return empty(array_filter($input, function ($a) {
                return $a !== null;
            }));
        }

        // Check if there is at least recall or receive
        $receives = array_column($request->products, 'receive');
        $recalls = array_column($request->products, 'recall');
        if (containsOnlyNull($receives) && containsOnlyNull($recalls)) {
            return redirect()->back()->withErrors('لا يوجد اي منتجات مستلمة او مسترجعة');
        }


        $products = $request->products;
        $store_id = Auth::user()->manager_store->id;
        // create new Examination
        $examination = new Examination([
            'store_id' => $store_id,
            'date_of_examination' => now(),
            'supplier_id' => $request->supplier_id,
            'total' => $request->total,
            'delivery_price' => $request->delivery_price,
            'additional_price' => $request->additional_price,
            'paid' => $request->paid,
            'manager_id' => Auth::user()->id
        ]);
        $examination->save();
        // create supplier_dept
        if (isset($request->amount)) {
            $supplier_dept = new Supplier_dept([
                'amount' => $request->amount,
                'examination_id' => $examination->id,
                'supplier_id' => $request->supplier_id,
                'store_id' => $store_id,
            ]);
            $supplier_dept->save();
        }

        foreach ($products as $item) {
            $product = Product::findOrFail($item['product']);
            $product_info = $product->infos()->wherePivot('store_id', '=', $store_id)->get()->first();
            if (!($item['receive'] == null)) {
                // create examination unit if there is receive or recall for product
                $examination_unit = new Examination_unit();
                $examination_unit->product_id = $product->id;
                $examination_unit->examination_id = $examination->id;
                $examination_unit->quantity_before = $product_info->quantity;
                if ($item['receive'] !== null) {
                    $validator = Validator::make($item, [
                        'total_price' => 'required'
                    ]);
                    if ($validator->fails()) {
                        return back()->withErrors('اجمالي سعر الشراء مطلوب');
                    }
                    $examination_unit->receive = $item['receive'];
                    $examination_unit->quantity_after = $product_info->quantity + $item['receive'];
                    $examination_unit->receipt_status_id = $item['receipt_status'];
                    $examination_unit->total_price = $item['total_price'];
                    $examination_unit->production_date = $item['production_date'];
                    $examination_unit->expiry_date = $item['expiry_date'];

                    // $info_expiration= new Info_Expiration;
                    // $info_expiration->info_id=$product_info->id;
                    // $info_expiration->quantity_total=$item['receive'];
                    // $info_expiration->quantity_unit=$item['receive'] * $product->quantity_unit ;
                    // $info_expiration->production_date = $item['production_date'];
                    // $info_expiration->expiry_date = $item['expiry_date'];
                    // $info_expiration->save();



                    // //update product Quantity
                    // if ($product_info->quantity == 0) {
                    //     $product_info->update([
                    //         'first_period' => $examination_unit->quantity_after
                    //     ]);
                    // }
                    // $product_info->update([
                    //     'quantity' => $examination_unit->quantity_after,
                    //     'quantity_unit' => $product_info->quantity_unit + $item['receive'] * $product->quantity_unit,
                    // ]);
                    // // Update Price of the product
                    // $new_total_price = ($examination_unit->quantity_before * $product_info->buy_price) + $item['total_price'];
                    // $new_price = $new_total_price / $examination_unit->quantity_after;
                    // $product_info->update([
                    //     'buy_price' => $new_price,
                    // ]);
                } else {
                    $examination_unit->quantity_after = $product_info->quantity;
                }
                /*if ($item['recall'] !== null) {
                    $examination_unit->recall = $item['recall'];
                    $examination_unit->return_reason_id = $item['return_reason'];
                }*/
                $examination_unit->save();
            }
        }

        return redirect()->to(route('examinations.index'));

    }


    public function AddExaminationQuantitiesToInfo($id, $keeper_id)
    {

        $examination = Examination::where('id', $id)->get()->first();

        $store_id = $examination->store_id;
        $examination_unit = Examination_unit::where('examination_id', $id)->get();
        $examination_unit_count = Examination_unit::where('examination_id', $id)->count();
        foreach ($examination_unit as $examin_unit) {
            $product = Product::findOrFail($examin_unit['product_id']);
            $product_info = $product->infos()->wherePivot('store_id', '=', $store_id)->get()->first();
            $examin_unit->quantity_after = $product_info->quantity + $examin_unit->receive;

            $info_expiration = Info_Expiration::where('info_id', $product_info->id)->where('production_date', $examin_unit->production_date)->where('expiry_date', $examin_unit->expiry_date)->first();
            if ($info_expiration != null) {
                $info_expiration->update([
                    'quantity_total' => $info_expiration->quantity_total + $examin_unit->receive,
                    'quantity_unit' => $info_expiration->quantity_unit + ($examin_unit->receive * $product->quantity_unit),
                ]);
            } else {
                $info_expiration = new Info_Expiration;
                $info_expiration->info_id = $product_info->id;
                $info_expiration->store_id = $examination->store_id;
                $info_expiration->quantity_total = $examin_unit->receive;
                $info_expiration->quantity_unit = $examin_unit->receive * $product->quantity_unit;
                $info_expiration->production_date = $examin_unit->production_date;
                $info_expiration->expiry_date = $examin_unit->expiry_date;
                $info_expiration->save();
            }
            // start new for buy_price
            $all_additional_price = ($examin_unit->delivery_price + $examin_unit->additional_price);

            if ($all_additional_price != 0) {
                $additional_price = ($all_additional_price / $examination_unit_count);
            } else {
                $additional_price = 0;
            }

            $buy_price = (($examin_unit->total_price + $examin_unit->receive) / $examin_unit->receive);
            $product_info->update([
                'buy_price' => $buy_price,
            ]);

            // end new for buy_price
            //update product Quantity
            if ($product_info->quantity == 0) {
                $product_info->update([
                    'first_period' => $examin_unit->quantity_after
                ]);
            }
            $product_info->update([
                'quantity' => $examin_unit->quantity_after,
                'quantity_unit' => $product_info->quantity_unit + $examin_unit->receive * $product->quantity_unit,
            ]);
            // Update Price of the product
            $new_total_price = ($examin_unit->quantity_before * $product_info->buy_price) + $examin_unit->total_price;
            $new_price = $new_total_price / $examin_unit->quantity_after;
            // $product_info->update([
            //     'buy_price' => $new_price,
            // ]);


        }
        $examination->update([
            'is_received_keeper' => 1,
            'keeper_id' => $keeper_id,
        ]);
        $lockers = new Locker();
        $lockers->number = $examination->total;
        $lockers->foreign_id = $examination->id;
        $lockers->user_id = Auth::user()->id;
        $lockers->store_id = $store_id;
        $lockers->type = 1;
        $lockers->category = 'direct';
        $lockers->save();

        return redirect()->to(route('examinations.index'));

    }

    public function showStore()
    {
        if (!empty(Auth::user()->store()->get()->first())) {
            $store = Auth::user()->store()->get()->first();
            $check = Shift::where('from_user_id', Auth::user()->id)
//                ->where('to_user_id',$request->store_keeper)
                ->where('store_id', Auth::user()->store->id)
                ->where('is_confirmed', 0)->first();
            $receive_shift = false;
            $can_see = false;
            $check_finance = false;
            $receive_shift_finance = false;
        } elseif (!empty(Auth::user()->seller_store()->get()->first())) {
            $store = Auth::user()->seller_store()->get()->first();
            $check = false;
            $receive_shift = false;
            $can_see = false;
            $check_finance = false;
            $receive_shift_finance = false;
        } elseif (!empty(Auth::user()->manager_store()->get()->first())) {
            $store = Auth::user()->manager_store()->get()->first();
            $check = false;
            $receive_shift = false;
            $can_see = false;
            $check_finance = false;
            $receive_shift_finance = false;
        } elseif (!empty(Auth::user()->keeper_store()->get()->first())) {
            $store = Auth::user()->keeper_store()->get()->first();
            $check = Shift::where('from_user_id', Auth::user()->id)
//                ->where('to_user_id',$request->store_keeper)
                ->where('store_id', $store->id)
                ->where('is_confirmed', 0)->first();
            $receive_shift = Shift::where('to_user_id', Auth::user()->id)
                ->where('store_id', $store->id)
                ->where('is_confirmed', 0)->first();
            $can_see = false;
            $check_finance = false;
            $receive_shift_finance = false;
        } elseif (!empty(Auth::user()->finance_manager_store()->get()->first())) {
            $store = Auth::user()->finance_manager_store()->get()->first();
            $check_finance = Finance_shift::where('from_user_id', Auth::user()->id)
//                ->where('to_user_id',$request->store_keeper)
                ->where('store_id', $store->id)
                ->where('is_confirmed', 0)->first();
            $receive_shift_finance = Finance_shift::where('to_user_id', Auth::user()->id)
                ->where('store_id', $store->id)
                ->where('is_confirmed', 0)->first();
            $check = false;
            $receive_shift = false;
            $can_see = false;
        } else {
            $store = Auth::user()->store_accountant()->get()->first();
            $can_see = true;
            $check = false;
            $receive_shift = false;
            $can_see = false;
            $check_finance = false;
            $receive_shift_finance = false;
        }

        $products = $store->products()->get();
        return view('admin.stores.show', compact('store', 'products', 'check', 'receive_shift', 'can_see', 'check_finance', 'receive_shift_finance'));
    }

    public function createSell()
    {
        if (!empty(Auth::user()->store()->get()->first())) {
            $store = Auth::user()->store()->get()->first();
            $products = $store->products()->distinct()->get();
            $users = User::where('type', 'user')->get();
        } elseif (!empty(Auth::user()->seller_store()->get()->first())) {
            $store = Auth::user()->seller_store()->get()->first();
            $products = $store->products()->distinct()->get();
            $users = User::where('type', 'user')->get();
        } else {
            return back()->withErrors('لا يمكنك بيع من المخزن');
        }
        return view('admin.stores.create_sell', compact('store', 'products', 'users'));
    }

    public function storeSell(Request $request)
    {
//         dd($request->all());
        $request->validate([
            'user_id' => 'required'
        ]);
        /*
         * Create New Order
         */
        $order = new Order($request->all());
        $order->price_total_sum = 0;
        $order->price_unit_sum = 0;
        $order->is_direct_sell = 1;
        $order->date_of_order = now();
        $order->date_of_receipt = now();
        $order->seller_id = Auth::user()->id;
        // variable to check at least one is filled to save
        $at_least_one = false;


        $price_total_sum = 0;
        $price_unit_sum = 0;


        foreach ($request->info as $item) {
            $info = Info::findOrFail($item['info_id']);
            $product = $info->products()->get()->first();
            if (!(($item['quantity_total'] == 0 || $item['quantity_total'] == null) && ($item['quantity_unit'] == 0 || $item['quantity_unit'] == null))) {
                $at_least_one = true;
                /*
                 * Check if the quantity total and quantity unit is available
                 */
                $total = $item['quantity_total'] * $product->quantity_unit + $item['quantity_unit'];
                if ($total > $info->quantity_unit) {
                    // Remove Order
                    $order->order_units()->delete();
                    $order->delete();
                    $message = 'اجمالى المطلوب من المنتج ' . $product->name . ' هو: ' . $total . ' ' . $product->subunit_type . ' والموجود بالمخزن : ' . $info->quantity_unit . ' ' . $product->subunit_type;
                    return back()->withErrors($message);
                }
                // set quantity unit 0 if null
                $item['quantity_unit'] = $item['quantity_unit'] == null ? 0 : $item['quantity_unit'];
                // set quantity total 0 if null
                $item['quantity_total'] = $item['quantity_total'] == null ? 0 : $item['quantity_total'];
                /*
                 * Save Order And Make Order Unit Once The Info Of The Unit Is Valid
                 */
                $order->save();
                $order_unit = new order_unit($item);
                $order_unit->order_id = $order->id;
                $order_unit->save();
                $order_unit->update([
                    'receive_total' => $order_unit->quantity_total,
                    'receive_unit' => $order_unit->quantity_unit,
                ]);
                /*
                 * Update Price Sum
                 */
                //  from ring
                $order_unit->save();
                $product_info = $order_unit->product->infos()->wherePivot('store_id', '=', $request['store_id'])->get()->first();
                $price_total_sum += $order_unit->quantity_total * ($product_info->sell_total);
                $price_unit_sum += $order_unit->quantity_unit * ($product_info->sell_unit_original / $order_unit->product->quantity_unit);
                // if($item['quantity_unit']>=1 || $item['quantity_unit'] != null)
                //     {
                //       $final_quantity_unit=($product->quantity_unit*$item['quantity_total'])+$item['quantity_unit'];
                //       $data_gededa=($product_info->quantity-($item['quantity_total']+($item['quantity_unit']/$product->quantity_unit)));
                //     }
                //     elseif($item['quantity_unit']==0 || $item['quantity_unit'] == null){
                //         $final_quantity_unit=$item['quantity_unit']+($item['quantity_total']*$product->quantity_unit);
                //         $data_gededa=($product_info->quantity-$item['quantity_total']);
                //     }

                // $product_info->update([
                //     'quantity' => $data_gededa,

                //     'quantity_unit' => $product_info->quantity_unit - $final_quantity_unit,
                // ]);


                $order->update([
                    'price_total_sum' => $price_total_sum,
                    'price_unit_sum' => $price_unit_sum,
                ]);

                //start test
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
                    if ($discounts['total_discount_later'] + $discounts['unit_discount_now'] > 0) {
                        $dept = new Dept([
                            'user_id' => $order->user->id,
                            'order_id' => $order->id,
                            'total' => $discounts['total_discount_later'] + $discounts['unit_discount_now'],
                            'paid' => 0,
                            'date' => Carbon::now()->addMonths(1)
                        ]);
                        $dept->save();
                    } else {
                        $dept = false;
                    }
                }


                // end test


                // from ringo

                // foreach ($order->order_units as $order_unit) {
                //     $price_total_sum += $order_unit->quantity_total * ($info->sell_total);
                //     $price_unit_sum += $order_unit->quantity_unit * ($info->sell_unit($product));
                // }
                // $order->update([
                //     'price_total_sum' => +$price_total_sum,
                //     'price_unit_sum' => +$price_unit_sum,
                // ]);
            }
        }
        if ($at_least_one == false) {
            return back()->withErrors('يجب ادخال منتج واحد على الأقل');
        }
        session()->flash('success', ' تمت العملية بنجاح ');

        return redirect()->to(route('completeSell', $order->id));
    }


    public function editSell($id)
    {
        // $orders = Order::where('is_direct_sell',1)->get();
        $order_unit = order_unit::where('id', $id)->first();
        // dd($order_unit);
        return view('admin.orders.edit_sell_unit', compact('order_unit'));
    }

    public function editedOrders()
    {
        $orders = Edited_Order_Unit::orderBy('created_at', 'asc')->get();
        return view('admin.orders.index-edited-orders', compact('orders'));
    }

    public function updateSell(Request $request, $id)
    {
//return $request->all();
        $order_unit = order_unit::where('id', $id)->first();
        $quantity_total = $order_unit->quantity_total;
        $new_quantity_total = $request->quantity_total - $quantity_total;
//        return $new_quantity_total;
        $quantity_unit = $order_unit->quantity_unit;
        $new_quantity_unit = $request->quantity_unit - $quantity_unit;
        $product_id = $order_unit->product_id;
        // dd($product_id);
        $store_id = $order_unit->order->store_id;
        $order = $order_unit->order;
        // dd($order);
        // dd($store_id);
        $info = $order_unit->product->infos()->wherePivot('store_id', $store_id)->get()->first();
        // dd($info);
        // price
        $price_total_sum = 0;
        $price_unit_sum = 0;
        $price_total_sum = ($new_quantity_total) * ($info->buy_price + ($info->buy_price * ($info->sp_total_percentage / 100)));
        // dd($price_total_sum);
        $price_unit_sum = $new_quantity_unit * (($info->buy_price + ($info->buy_price * ($info->sp_unit_percentage / 100))) / $order_unit->product->quantity_unit);
        // dd($price_unit_sum);


        $edited_order_unit = new Edited_Order_Unit;
        $edited_order_unit->order_id = $order->id;
        $edited_order_unit->order_unit_id = $order_unit->id;
        $edited_order_unit->product_id = $order_unit->product_id;
        $edited_order_unit->user_id = Auth::user()->id;
        $edited_order_unit->owner_id = $order->user_id;
        $edited_order_unit->store_id = $order->store_id;
        $edited_order_unit->quantity_total_after = $order_unit->quantity_total;
        $edited_order_unit->quantity_total_before = $request->quantity_total;
        $edited_order_unit->quantity_unit_after = $order_unit->quantity_unit;
        $edited_order_unit->quantity_unit_before = $request->quantity_unit;
        $edited_order_unit->save();


        $order_unit->update([
            'quantity_total' => $request->quantity_total,
            'quantity_unit' => $request->quantity_unit,
        ]);

        $order->update([
            'price_total_sum' => $order->price_total_sum + $price_total_sum,
            'price_unit_sum' => $order->price_unit_sum + $price_unit_sum,
        ]);

        $info->update([
            'quantity_unit' => $info->quantity_unit - ($new_quantity_unit + $new_quantity_total * $order_unit->product->quantity_unit),
        ]);
        $new_quantity = floor($new_quantity_unit / $order_unit->product->quantity_unit) + $info->quantity;

        $info->update([
            'quantity' => $new_quantity
        ]);


        // $order_unit->delete();


        session()->flash('success','تم التعديل بنجاح');
        return redirect($request->url);
    }


    public function deleteSell($id)
    {
        $order_unit = order_unit::where('id', $id)->first();
        $quantity_total = $order_unit->quantity_total;
        // dd($quantity_total);
        $quantity_unit = $order_unit->quantity_unit;
        $product_id = $order_unit->product_id;
        // dd($product_id);
        $store_id = $order_unit->order->store_id;
        $order = $order_unit->order;
        // dd($order);
        // dd($store_id);
        $info = $order_unit->product->infos()->wherePivot('store_id', $store_id)->get()->first();
        // dd($info);
        // price
        $price_total_sum = 0;
        $price_unit_sum = 0;
        $price_total_sum = ($order_unit->quantity_total) * ($info->buy_price + ($info->buy_price * ($info->sp_total_percentage / 100)));
        // dd($price_total_sum);
        $price_unit_sum = $order_unit->quantity_unit * (($info->buy_price + ($info->buy_price * ($info->sp_unit_percentage / 100))) / $order_unit->product->quantity_unit);
        // dd($price_unit_sum);

        $order->update([
            'price_total_sum' => $price_total_sum,
            'price_unit_sum' => $price_unit_sum,
        ]);

        $info->update([
            'quantity_unit' => $info->quantity_unit + ($order_unit->quantity_unit + $order_unit->quantity_total * $order_unit->product->quantity_unit),
        ]);
        $new_quantity = floor($order_unit->quantity_unit / $order_unit->product->quantity_unit) + $info->quantity;

        $info->update([
            'quantity' => $new_quantity
        ]);

        $order_unit->delete();
        return back();
    }


    public function completeSell($order_id)
    {
        $order = Order::findOrFail($order_id);
        if (
            (!empty(Auth::user()->store()->get()->first()) && Auth::user()->store->id == $order->store->id) ||
            (!empty(Auth::user()->seller_store()->get()->first()) && Auth::user()->seller_store->id == $order->store->id)
        ) {
            /*
             * Check If The Order Is Completed (paid before)
             */
            if ($order->is_complete) {
                return redirect()->to(route('seeBill', $order->id))->withErrors('هذا الطلب مدفوع من قبل');
            }
            $store = $order->store;
            $order_units = $order->order_units;
            $notify = $this->checkNotify($order_id);

            if ($notify['notify']) {
                $revenue = $this->getTotalDiscount($notify, $order);
                $discounts = $this->calculateTotal($order_id, $revenue, $notify);
            } else {
                $revenue = false;
                $discounts = false;
            }
            // check cashback
            $cashback = $this->getCashBack($order->user->id);
            return view('admin.stores.complete_sell', compact('order', 'notify', 'store', 'order_units', 'revenue', 'discounts', 'cashback'));
        } else {
            return back()->withErrors('لا يمكنك بيع الطلب من المخزن');
        }

    }

    public function finalSell(Request $request, $order_id)
    {
        $order = Order::findOrFail($order_id);
        if (
            (!empty(Auth::user()->store()->get()->first()) && Auth::user()->store->id == $order->store->id) ||
            (!empty(Auth::user()->seller_store()->get()->first()) && Auth::user()->seller_store->id == $order->store->id)
        ) {
            /*
             * Check If The Order Is Completed (paid before)
             */
            if ($order->is_complete) {
                return redirect()->to(route('seeBill', $order->id))->withErrors('هذا الطلب مدفوع من قبل');
            }
            $store = $order->store;
            $order_units = $order->order_units;
            $notify = $this->checkNotify($order_id);
            if ($notify['notify']) {
                $revenue = $this->getTotalDiscount($notify, $order);
                $discounts = $this->calculateTotal($order_id, $revenue, $notify);
            } else {
                $revenue = false;
                $discounts = false;
            }
            // check cashback
            $cashback = $this->getCashBack($order->user->id);
            //
            if ($discounts) {
                $total_dis_now = $discounts['total_discount_now']
                    + $discounts['unit_discount_now'];
                $total_dis_later = $discounts['total_discount_later']
                    + $discounts['unit_discount_later'];
                $total_after_dis = ($order->price_total_sum + $order->price_unit_sum) - $total_dis_now - $cashback;
            } else {
                $total_dis_later = 0;
                $total_after_dis = $order->price_total_sum + $order->price_unit_sum - $cashback;
            }
            $request->validate([
                'paid_value' => 'numeric|required|min:0|max:' . $total_after_dis
            ]);
            /*
             * Check If Store have the quantity required
             */
            foreach ($order->order_units as $unit) {

                $info = $unit->product->infos()->wherePivot('store_id', $order->store->id)->get()->first();
                if (($unit->quantity_total * $unit->product->quantity_unit) + $unit->quantity_unit > $info->quantity_unit) {
                    return back()->withErrors('الكمية المطلوبة من المنتج ' . $unit->product->name . ' غير متاحة حاليا لتنفيذ الطلب ');
                }
            }
            /*
             *  Minus the Quantity from the Store and calculate loss
             */
            $lose = 0;
            foreach ($order->order_units as $unit) {

                $info = $unit->product->infos()->wherePivot('store_id', $order->store->id)->get()->first();
                $product = $info->products()->get()->first();

                if ($unit['quantity_unit'] >= 1 || $unit['quantity_unit'] != null) {
                    $final_quantity_unit = ($product->quantity_unit * $unit['quantity_total']) + $unit['quantity_unit'];
                    $data_gededa = ($info->quantity - ($unit['quantity_total'] + ($unit['quantity_unit'] / $product->quantity_unit)));
                } elseif ($unit['quantity_unit'] == 0 || $unit['quantity_unit'] == null) {
                    $final_quantity_unit = $unit['quantity_unit'] + ($unit['quantity_total'] * $product->quantity_unit);
                    $data_gededa = ($info->quantity - $unit['quantity_total']);
                }

                $info->update([
                    'quantity' => $data_gededa,

                    'quantity_unit' => $info->quantity_unit - $final_quantity_unit,
                ]);


                // $info->update([
                //     'quantity_unit' => $info->quantity_unit - ($unit->quantity_unit + $unit->quantity_total * $unit->product->quantity_unit),
                // ]);
                // $info->update([
                //     'quantity' => floor($info->quantity_unit / $unit->product->quantity_unit)
                // ]);
                $lose += $info->loss * $unit->quantity_total;
                $lose += ($info->loss / $unit->product->quantity_unit) * $unit->quantity_unit;
            }
            // Make new Lose If bigger than 0
            if ($lose) {
                $lose_obj = new lose([
                    'store_id' => $order->store_id,
                    'order_id' => $order->id,
                    'loss' => $lose,
                ]);
                $lose_obj->save();
            }
            /*----------*/
            $rest_value = $total_after_dis - $request->paid_value;
            $order->update([
                'is_complete' => 1,
                'paid_value' => $request->paid_value,
                'rest_value' => $rest_value
            ]);
            /*
             * Depts on Us if there is a Total_dis_later
             */
            if ($total_dis_later != 0) {
                $dept = new Dept([
                    'user_id' => $order->user->id,
                    'order_id' => $order->id,
                    'total' => $total_dis_later,
                    'paid' => 0,
                    'date' => Carbon::now()->addMonth()
                ]);
                $dept->save();
            } else {
                $dept = false;
            }
            return view('admin.stores.generate_sell_bill', compact('order', 'notify', 'store', 'order_units', 'revenue', 'discounts', 'dept', 'cashback'));
        } else {
            return back()->withErrors('لا يمكنك بيع الطلب من المخزن');
        }
    }

    public function seeBill($order_id)
    {
        $order = Order::findOrFail($order_id);
        $store = $order->store;
        $order_units = $order->order_units;
        $notify = $this->checkNotify($order_id);
        if ($notify['notify']) {
            $revenue = $this->getTotalDiscount($notify, $order);
            $discounts = $this->calculateTotal($order_id, $revenue, $notify);
        } else {
            $revenue = false;
            $discounts = false;
        }
        // check cashback
        $cashback = $this->getCashBack($order->user->id);
        $dept = $order->dept;
        if (is_null($dept)) {
            $dept = false;
        }
        return view('admin.stores.generate_sell_bill', compact('order', 'notify', 'store', 'order_units', 'revenue', 'discounts', 'dept', 'cashback'));
    }

    public function cancelSell($order_id)
    {
        $order = Order::findOrFail($order_id);
        if ($order->is_complete) {
            return back()->withErrors('لا يمكنك الغاء الطلب اكتمل بالفعل');
        }
        $order->order_units()->delete();
        $order->delete();
        return redirect()->route('createSell');
    }

    public function createTransfer()
    {
        if (!empty(Auth::user()->store()->get()->first())) {
            $store = Auth::user()->store()->get()->first();
            $stores = Store::all();
            $products = $store->products()->get();
            $mandobs = Mandob::all();
        } elseif (!empty(Auth::user()->seller_store()->get()->first())) {
            $store = Auth::user()->seller_store()->get()->first();
            $stores = Store::all();
            $products = $store->products()->get();
            $mandobs = Mandob::all();
        } else {
            return back()->withErrors('لا يمكنك النقل من المخزن');
        }
        return view('admin.stores.create_transfer', compact('stores', 'store', 'products', 'mandobs'));
    }

    public function storeTransfer(Request $request)
    {
        /*
         * Create New Transfer
         */
        $request->validate([
            'to_store' => ['required', Rule::notIn($request->store_id)],
            'mandob_id' => 'required'
        ]);
        $transfer = new Transfer([
            'from_id' => $request->store_id,
            'to_id' => $request->to_store
        ]);
        /*
         * Create New Order
         */
        $order = new Order($request->all());
        $order->price_total_sum = 0;
        $order->price_unit_sum = 0;
        $order->date_of_order = now();

        // variable to check at least one is filled to save
        $at_least_one = false;
        foreach ($request->info as $item) {
            $info = Info::findOrFail($item['info_id']);
            $product = $info->products()->get()->first();
            if (!(($item['quantity_total'] == 0 || $item['quantity_total'] == null) && ($item['quantity_unit'] == 0 || $item['quantity_unit'] == null))) {
                $at_least_one = true;
                /*
                 * Check if the quantity total and quantity unit is available
                 */
                $total = $item['quantity_total'] * $product->quantity_unit + $item['quantity_unit'];
                if ($total > $info->quantity_unit) {
                    // Remove Order
                    $order->order_units()->delete();
                    $order->delete();
                    $message = 'اجمالى المطلوب من المنتج ' . $product->name . ' هو: ' . $total . ' ' . $product->subunit_type . ' والموجود بالمخزن : ' . $info->quantity_unit . ' ' . $product->subunit_type;
                    return back()->withErrors($message);
                }
                // set quantity unit 0 if null
                $item['quantity_unit'] = $item['quantity_unit'] == null ? 0 : $item['quantity_unit'];
                // set quantity total 0 if null
                $item['quantity_total'] = $item['quantity_total'] == null ? 0 : $item['quantity_total'];
                /*
                 * Save Order And Make Order Unit Once The Info Of The Unit Is Valid
                 */
                $order->save();
                $order_unit = new order_unit($item);
                $order_unit->order_id = $order->id;
                $order_unit->save();
//                $order_unit->update([
//                    'receive_total' => $order_unit->quantity_total,
//                    'receive_unit' => $order_unit->quantity_unit,
//                ]);
                /*
                 * Update Price Sum
                 */
//                $price_total_sum = 0;
//                $price_unit_sum = 0;
//                foreach ($order->order_units as $order_unit)
//                {
//                    $price_total_sum+= $order_unit->quantity_total * ($info->buy_price +($info->buy_price * ($info->sp_total_percentage/100)));
//                    $price_unit_sum+= $order_unit->quantity_unit * ($info->buy_price  +($info->buy_price * ($info->sp_unit_percentage/100)));
//                }
//                $order->update([
//                    'price_total_sum' => $price_total_sum,
//                    'price_unit_sum' => $price_unit_sum,
//                ]);
            }
        }
        if ($at_least_one == false) {
            return back()->withErrors('يجب ادخال منتج واحد على الأقل');
        }
        /*
         * order saved successfully add transfer to it
         */
        $transfer->save();
        $order->update([
            'transfer_id' => $transfer->id
        ]);
        session()->flash('success', ' تمت العملية بنجاح ');
        return redirect()->to(route('orders.show', $order->id));
    }

    public function outTransfer($order_id)
    {
        // $order = Order::findOrFail($order_id);
        // if (!isset($order->mandob_id)) {
        //     return back()->withErrors('لم يتم تعيين مندوب بعد');
        // }
        // if ($order->mondob_stage_id != 1) {
        //     return back()->withErrors('المندوب لم يؤكد على استلام الطلب بعد');
        // }
        $order = Order::find($order_id);
        $order_units = $order->order_units()->get();
        $store = $order->store()->get()->first();
        if (empty($order->out()->get()->first())) {
            // check first if all order Units are available
            foreach ($order_units as $order_unit) {
                $product = Product::find($order_unit->product_id);
                $product_info = $product->infos()->wherePivot('store_id', '=', $store->id)->get()->first();
//                dd($product_info);
                // Calculate total quantity of units and total as units
                $all_as_units = $order_unit->quantity_total * $product->quantity_unit + $order_unit->quantity_unit;
                // if ($all_as_units > $product_info->quantity_unit) {
                //     return back()->withErrors(
                //         'لا يوجد ما يكفي من '
                //         . $product->name .
                //         ' لتنفيذ النقل '
                //     );
                // }
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

            //Update order_stages
            $order->update([
                'order_stage_id' => 4
            ]);

            //Create out permission
            $out = new Out([
                'date' => now(),
                'order_id' => $order_id
            ]);
            $out->save();
        } else {
            $out = $order->out()->get()->first();
        }
        return view('admin.stores.transfer_out', compact('order', 'order_units', 'store', 'out'));
    }

    public function inTransfer($order_id)
    {
        $order = Order::findOrFail($order_id);
        if ($order->mondob_stage_id != 2) {
            return back()->withErrors('المندوب لم يؤكد على تسليم الطلب بعد');
        }
        $order_units = $order->order_units()->get();
        $store = $order->store()->get()->first();
        if (empty($order->in()->get()->first())) {
            // Change values in Store In
            foreach ($order_units as $order_unit) {
                $product = Product::find($order_unit->product_id);
                $product_info = $product->infos()->wherePivot('store_id', '=', $store->id)->get()->first();
                // Change Quantity
                $all_as_units = $order_unit->quantity_total * $product->quantity_unit + $order_unit->quantity_unit;
                $quantity_unit = $product_info->quantity_unit + $all_as_units;
                //floor down Quantity
                $quantity = floor($quantity_unit / $product->quantity_unit);
                $product_info->update([
                    'quantity' => $quantity,
                    'quantity_unit' => $quantity_unit
                ]);
            }

            //Update order_stages
            $order->update([
                'order_stage_id' => 5
            ]);

            //Create In permission
            $in = new In([
                'date' => now(),
                'order_id' => $order_id
            ]);
            $in->save();
        } else {
            $in = $order->in()->get()->first();
        }
        return view('admin.stores.transfer_in', compact('order', 'order_units', 'store', 'in'));
    }

    public function getTransfers()
    {
        if (!empty(Auth::user()->store()->get()->first())) {
            $store = Auth::user()->store()->get()->first();
        } elseif (!empty(Auth::user()->seller_store()->get()->first())) {
            $store = Auth::user()->seller_store()->get()->first();
        } else {
            $store = Auth::user()->store_accountant()->get()->first();
        }
        $transfers = Transfer::where('from_id', $store->id)->orWhere('to_id', $store->id)->get();

        return view('admin.stores.store_transfer', compact('transfers'));
    }

    public function getOrders()
    {
        if (!empty(Auth::user()->store()->get()->first())) {
            $store = Auth::user()->store()->get()->first();
        } elseif (!empty(Auth::user()->seller_store()->get()->first())) {
            $store = Auth::user()->seller_store()->get()->first();
        } elseif (!empty(Auth::user()->manager_store()->get()->first())) {
            $store = Auth::user()->manager_store()->get()->first();
        } elseif (!empty(Auth::user()->keeper_store()->get()->first())) {
            $store = Auth::user()->keeper_store()->get()->first();
        } else {
            $store = Auth::user()->store_accountant()->get()->first();
        }

        $orders = $store->orders()->where([
            ['is_complete', '=', 1],
            ['is_direct_sell', '=', 0],
        ])->orderBy('order_stage_id', 'asc')->get();

        $option = Option::findOrFail(2)->is_active;

        return view('admin.orders.index', compact('orders', 'option'));
    }

    public function preShift()
    {
        if (!empty(Auth::user()->store()->get()->first())) {
            $user = Auth::user();
            $store = $user->store;
            $store_keepers = $store->store_keepers;
            return view('admin.stores.shift', compact('user', 'store', 'store_keepers'));
        }
        return back();
    }

    public function shift(Request $request)
    {
        if (!empty(Auth::user()->store()->get()->first())) {
            // check if there is already a shift request
            $check = Shift::where('from_user_id', Auth::user()->id)
//                ->where('to_user_id',$request->store_keeper)
                ->where('store_id', Auth::user()->store->id)
                ->where('is_confirmed', 0)->first();
            if (empty($check)) {
                $shift = new Shift([
                    'from_user_id' => Auth::user()->id,
                    'to_user_id' => $request->store_keeper,
                    'store_id' => Auth::user()->store->id
                ]);
                $shift->save();
                return redirect(route('store_keeper.show_store', Auth::user()->store->id));
            }
        }
        return back()->withErrors('لقت تم بالفعل طلب نقل شيفت وبانتظار الموافقه');
    }

    public function receive()
    {
        if (!empty(Auth::user()->keeper_store()->get()->first())) {
            $store = Auth::user()->keeper_store()->get()->first();
            $receive_shift = Shift::where('to_user_id', Auth::user()->id)
                ->where('store_id', $store->id)
                ->where('is_confirmed', 0)->first();
            if ($receive_shift) {
                // confirm
                $receive_shift->update([
                    'start_date' => now(),
                    'is_confirmed' => 1
                ]);
                // close last shift
                $last_shift = Shift::where('to_user_id', $receive_shift->from_user_id)
                    ->where('store_id', $store->id)
                    ->where('is_confirmed', 1)->latest()->first();
                $last_shift->update([
                    'end_date' => now()
                ]);
                // update current store keeper
                $store->update([
                    'store_keeper_id' => Auth::user()->id
                ]);
                return redirect(url('/admin/store/receive'));
            }
        }
        return back();
    }

    public function preShift_finance()
    {
        if (!empty(Auth::user()->store_finance_manager()->get()->first())) {
            $user = Auth::user();
            $store = $user->store_finance_manager;
            $finance_managers = $store->finance_managers;
            return view('admin.stores.shift_finance', compact('user', 'store', 'finance_managers'));
        }
        return back();
    }

    public function shift_finance(Request $request)
    {
        $request->validate([
            'finance_manager' => 'required'
        ]);

        if (!empty(Auth::user()->store_finance_manager()->get()->first())) {
            // check if there is already a shift request
            $check = Finance_shift::where('from_user_id', Auth::user()->id)
//                ->where('to_user_id',$request->store_keeper)
                ->where('store_id', Auth::user()->store_finance_manager->id)
                ->where('is_confirmed', 0)->first();
            if (empty($check)) {
                $shift = new Finance_shift([
                    'from_user_id' => Auth::user()->id,
                    'to_user_id' => $request->finance_manager,
                    'store_id' => Auth::user()->store_finance_manager->id
                ]);
                $shift->save();
                return redirect(route('store_keeper.show_store', Auth::user()->store_finance_manager->id));
            }
        }
        session()->flash('success', ' لقت تم بالفعل طلب نقل شيفت وبانتظار الموافقه ');
        return back()->withErrors('لقت تم بالفعل طلب نقل شيفت وبانتظار الموافقه');
    }

    public function receive_finance()
    {
        if (!empty(Auth::user()->finance_manager_store()->get()->first())) {
            $store = Auth::user()->finance_manager_store()->get()->first();
            $receive_shift = Finance_shift::where('to_user_id', Auth::user()->id)
                ->where('store_id', $store->id)
                ->where('is_confirmed', 0)->first();
            if ($receive_shift) {
                // confirm
                $receive_shift->update([
                    'start_date' => now(),
                    'is_confirmed' => 1
                ]);
                // close last shift
                $last_shift = Finance_shift::where('to_user_id', $receive_shift->from_user_id)
                    ->where('store_id', $store->id)
                    ->where('is_confirmed', 1)->latest()->first();
                $last_shift->update([
                    'end_date' => now()
                ]);
                // update current store keeper
                $store->update([
                    'store_finance_manager_id' => Auth::user()->id
                ]);
                return redirect(url('/admin/show/store'));
            }
        }
        return back();
    }


    public function supplierDepts()
    {
        $depts = Supplier_dept::all();
        return view('admin.depts.supplier-depts-index', compact('depts'));
    }

    public function supplierDeptsById($id)
    {
        $depts = Supplier_dept::where('supplier_id', $id)->get();
        return view('admin.depts.supplier-depts-index', compact('depts'));
    }

    public function editSupplierDepts($id)
    {
        $depts = Supplier_dept::find($id);
        return view('admin.depts.supplier-depts-edit', compact('depts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function updateSupplierDepts(Request $request, $id)
    {
        $depts = Supplier_dept::find($id);
        if ($request->additional_amount > 0) {
            $depts->amount = $depts->amount - $request->additional_amount;
            $depts->save();
            $examination = $depts->examination()->first();

            $examination->update(
                [
                    'paid' => ($examination->paid + $request->additional_amount),
                ]);
        } else {

        }
        session()->flash('success', 'تم التعديل بنجاح');
        return redirect('/admin/supplier_depts');
    }

    public function getSupplierDepts(Store $store)
    {
        $data['depts'] = $store->depts;
        $data['store'] = $store;
        return view('admin.stores.depts', $data);
    }

    public function settleDept(Store $store, Supplier_dept $supplier_dept)
    {
        if (!empty(Auth::user()->manager_store()->get()->first())) {
            if ($store->id == Auth::user()->manager_store->id) {
                $supplier_dept->update([
                    'is_settlement' => 1
                ]);
            } else {
                return back()->withErrors('لا يمكنك التصفية');
            }
        } else {
            return back()->withErrors('لا يمكنك التصفية');
        }
        return redirect(url('/admin/store/supplier_depts', $store->id));
    }
}
