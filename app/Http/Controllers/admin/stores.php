<?php

namespace App\Http\Controllers\admin;

use App\Areas;
use App\Examination_unit;
use App\Finance_shift;
use App\Info;
use App\Notify;
use App\Notify_total;
use App\Notify_unit;
use App\Place;
use App\Product;
use App\Shift;
use App\User;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use DB;

class stores extends Controller
{
    public function index()
    {
        $stores = Store::with('products')->get();
        return view('admin.stores.index', compact('stores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stores = Store::all();
        $areas = Place::all();
        $products = Product::all();
        $store_keepers = User::where('type', 'employee')->get();
        $sellers = User::where('type', 'employee')->get();
        $managers = User::where('type', 'employee')->get();
        $finance_managers = User::where('type', 'employee')->get();
        $accountants = User::where('type', 'employee')->get();
        return view('admin.stores.create', compact('stores', 'areas', 'products', 'store_keepers', 'sellers', 'accountants', 'managers', 'finance_managers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:stores',
            'place_id' => 'required',
            'store_keeper_id' => 'required|in:' . implode(',', $request->store_keepers),
            'store_finance_manager_id' => 'required|in:' . implode(',', $request->finance_managers),
            'accountant_id' => 'required',
            'address' => 'required',
            'products' => 'required',
            'store_keepers' => 'required',
            'finance_managers' => 'required',
            'sellers' => 'required',
        ]);

        $store = new Store($request->all());
        $store->place()->associate($request->place_id);
        $store->store_keeper()->associate($request->store_keeper_id);
        $store->store_finance_manager()->associate($request->store_finance_manager_id);
        $store->save();
        $shift = new Shift([
            'start_date' => now(),
            'is_confirmed' => 1,
            'from_user_id' => $request->store_keeper_id,
            'to_user_id' => $request->store_keeper_id,
            'store_id' => $store->id
        ]);
        $shift->save();
        $finance_shift = new Finance_shift([
            'start_date' => now(),
            'is_confirmed' => 1,
            'from_user_id' => $request->store_keeper_id,
            'to_user_id' => $request->store_keeper_id,
            'store_id' => $store->id
        ]);
        $finance_shift->save();
        $store->products()->attach($request->products);

        foreach ($store->products as $product) {
            $info = new Info();
            $info->save();
            $info->products()->attach($product, ['store_id' => $store->id]);
        }
        // attach store keepers to the store
        foreach ($request->store_keepers as $store_keeper) {
            $user = User::findOrFail($store_keeper);
            if (is_null($user->keeper_store) && is_null($user->seller_store) && is_null($user->manager_store) && is_null($user->finance_manager_store)) {
                $user->update([
                    'keeper_id' => $store->id
                ]);
            }
        }

        // attach store sellers to the store
        foreach ($request->sellers as $seller) {
            $user = User::findOrFail($seller);
            if (is_null($user->keeper_store) && is_null($user->seller_store) && is_null($user->manager_store) && is_null($user->finance_manager_store)) {
                $user->update([
                    'seller_id' => $store->id
                ]);
            }
        }

        // attach store managers to the store
        foreach ($request->managers as $manager) {
            $user = User::findOrFail($manager);
            if (is_null($user->keeper_store) && is_null($user->seller_store) && is_null($user->manager_store) && is_null($user->finance_manager_store)) {
                $user->update([
                    'manager_id' => $store->id
                ]);
            }
        }
        // attach store managers to the store
        foreach ($request->finance_managers as $finance_manager) {
            $user = User::findOrFail($finance_manager);
            if (is_null($user->keeper_store) && is_null($user->seller_store) && is_null($user->manager_store) && is_null($user->manager_store)) {
                $user->update([
                    'finance_manager' => $store->id
                ]);
            }
        }

        session()->flash('success', ' تمت الأضافة بنجاح ');

        return redirect('admin/stores');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show(Store $store)
    {
        if (!empty(Auth::user()->store()->get()->first())) {
            $store = Auth::user()->store()->get()->first();
            $check = Shift::where('from_user_id', Auth::user()->id)
//                ->where('to_user_id',$request->store_keeper)
                ->where('store_id', Auth::user()->store->id)
                ->where('is_confirmed', 0)->first();
            $receive_shift = false;
            $check_finance = false;
            $receive_shift_finance = false;
            $can_see = false;
        } elseif (!empty(Auth::user()->store_finance_manager()->get()->first())) {
            $store = Auth::user()->store_finance_manager()->get()->first();
            $check_finance = Finance_shift::where('from_user_id', Auth::user()->id)
//                ->where('to_user_id',$request->store_keeper)
                ->where('store_id', $store->id)
                ->where('is_confirmed', 0)->first();
            $receive_shift_finance = false;
            $check = false;
            $receive_shift = false;
            $can_see = false;
        } elseif (!empty(Auth::user()->seller_store()->get()->first())) {
            $store = Auth::user()->seller_store()->get()->first();
            $check = false;
            $receive_shift = false;
            $check_finance = false;
            $receive_shift_finance = false;
            $can_see = false;
        } elseif (!empty(Auth::user()->keeper_store()->get()->first())) {
            $store = Auth::user()->keeper_store()->get()->first();
            $check = Shift::where('from_user_id', Auth::user()->id)
//                ->where('to_user_id',$request->store_keeper)
                ->where('store_id', $store->id)
                ->where('is_confirmed', 0)->first();
            $receive_shift = Shift::where('to_user_id', Auth::user()->id)
                ->where('store_id', $store->id)
                ->where('is_confirmed', 0)->first();
            $check_finance = false;
            $receive_shift_finance = false;
            $can_see = false;
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
            $can_see = true;
            $check = false;
            $receive_shift = false;
            $check_finance = false;
            $receive_shift_finance = false;
        }
        $products = $store->products()->get();
        return view('admin.stores.show', compact('store', 'products', 'check', 'receive_shift', 'can_see', 'check_finance', 'receive_shift_finance'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $areas = Place::all();
        $stores = Store::find($id);
        $products = Product::all();
        $store_keepers = User::where('type', 'employee')->get();
        $sellers = User::where('type', 'employee')->get();
        $managers = User::where('type', 'employee')->get();
        $finance_managers = User::where('type', 'employee')->get();
        $accountants = User::where('type', 'employee')->get();

        return view('admin.stores.edit', compact('stores', 'areas', 'products', 'store_keepers', 'accountants', 'sellers', 'managers', 'finance_managers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */


    public function getSubProd($id)
    {
        $main_cat = Category::where('id', $id)->first();
        $sub_cat = $main_cat->subcategories;
        // dd($pro_main_catego);
        return $sub_cat;
    }

    public function getProdInfo($id, $store_id)
    {
        $store = Store::where('id', $store_id)->first();
        $products = $store->products()->where('subcategory_id', $id)->with('infos')->wherePivot('store_id', '=', $store->id)->get();
        foreach ($products as $prod) {
            $prod->infos()->wherePivot('store_id', '=', $store->id)->get()->first();
        }
        return $products;
        // $main_cat=Subcategory::where('id',$id)->first();
        // $sub_cat=$main_cat->subcategories;
        // dd($pro_main_catego);
        return $sub_cat;
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => [
                'required',
                Rule::unique('stores')->ignore($id)
            ],
            'place_id' => 'required',
            'address' => 'required',
            'products' => 'required',
            'store_keepers' => 'required',
            // 'sellers' => 'required',
        ]);
//        $data = $request->except('place_id','store_keeper_id','products');
        $store = Store::findOrFail($id);
        foreach ($request->products as $product) {
            if (!$store->products->contains($product)) {
                $info = new Info();
                $info->save();
                $info->products()->attach($product, ['store_id' => $store->id]);
            }
        }
        $store->products()->sync($request->products);
        $store->place()->associate($request->place_id);
        $store->update($request->all());
        foreach ($store->products as $index => $product) {
            if (!in_array($product->id, $request->products)) {
                $product->infos()->wherePivot('store_id', '=', $id)->detach();
                $store->products()->detach($product);
            }
        }
        foreach ($store->store_keepers as $store_keeper) {
            $store_keeper->update([
                'keeper_id' => null
            ]);
        }
        foreach ($store->store_sellers as $store_seller) {
            $store_seller->update([
                'seller_id' => null
            ]);
        }
        foreach ($store->store_managers as $store_manager) {
            $store_manager->update([
                'manager_id' => null
            ]);
        }
        foreach ($store->finance_managers as $finance_manager) {
            $finance_manager->update([
                'finance_manager' => null
            ]);
        }

        // attach store keepers to the store
        foreach ($request->store_keepers as $store_keeper) {
            $user = User::findOrFail($store_keeper);
            if (is_null($user->keeper_store) && is_null($user->seller_store) && is_null($user->manager_store)) {
                $user->update([
                    'keeper_id' => $store->id
                ]);
            }
        }

        // attach store sellers to the store
        if ($request->sellers) {
            foreach ($request->sellers as $seller) {
                $user = User::findOrFail($seller);
                if (is_null($user->keeper_store) && is_null($user->seller_store) && is_null($user->manager_store)) {
                    $user->update([
                        'seller_id' => $store->id
                    ]);
                }
            }
        }


        // attach store sellers to the store
        if ($request->managers) {
            foreach ($request->managers as $manager) {
                $user = User::findOrFail($manager);
                if (is_null($user->keeper_store) && is_null($user->seller_store) && is_null($user->manager_store)) {
                    $user->update([
                        'manager_id' => $store->id
                    ]);
                }
            }
            
        }

        if ($request->finance_managers) {
            foreach ($request->finance_managers as $manager) {
                $user = User::findOrFail($manager);
                if (is_null($user->keeper_store) && is_null($user->seller_store) && is_null($user->manager_store)) {
                    $user->update([
                        'finance_manager' => $store->id
                    ]);
                }
            }
           
        }
        
        $admin = User::findOrFail(1);
        $admin->update([
            'keeper_id' => $store->id,
            'finance_manager' => $store->id,
            'manager_id' => $store->id
        ]);
        session()->flash('success', 'تم التعديل بنجاح');
        return redirect('admin/stores');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $stores = Store::findOrFail($id);
        foreach ($stores->products as $product) {
//            $infos = Info::with('products')->wherePivot('store_id','=',$id)->delete();
            $product->infos()->wherePivot('store_id', '=', $id)->delete();
            $product->infos()->wherePivot('store_id', '=', $id)->detach();
        }
        foreach ($stores->examinations as $examination) {
            $examination->examination_units()->delete();
            $examination->delete();
        }
        foreach ($stores->notify->notify_users as $user_notify) {
            $user_notify->delete();
        }
        $stores->notify()->delete();
        $stores->products()->detach();
        $stores->delete();
        return back();
    }

    public function editProductsInfo(Store $store)
    {
        $products = $store->products()->with('infos')->wherePivot('store_id', '=', $store->id)->get();
        return view('admin.stores.edit_products', compact('products', 'store'));
    }


    // gemy search ajax start


    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = "";
// $products=DB::table('products')->where('title','LIKE','%'.$request->search."%")->get();
            $products = $store->products()->with('infos')->wherePivot('store_id', '=', $store->id)->where('title', 'LIKE', '%' . $request->search . "%")->get();
            if ($products) {
                foreach ($products as $key => $product) {
// $output.='<tr>'.
// '<td>'.$product->id.'</td>'.
// '<td>'.$product->title.'</td>'.
// '<td>'.$product->description.'</td>'.
// '<td>'.$product->price.'</td>'.
// '</tr>';

                    $info = $product->infos()->wherePivot('store_id', '=', $store->id)->get()->first();
                    $output .=
                        '<label> اسم المنتج : ' . $product->name . '</label>' .
                        '<input type="hidden" name="info[' . $product->id . '][product]" value="' . $product->id . '">' .
                        '<input type="hidden" name="info[' . $product->id . '][id]" value="' . $info->id . '">' .
                        '<div class="form-row">' .
                        '<div class="form-group col-md-2">' .
                        '<label for="inputEmail4">الحد الادنى</label>' .
                        '<input type="number" min="0" name="info[' . $product->id . '][lower_limit]"value="' . $info->lower_limit . '" class="form-control" id="inputEmail4"required>' .
                        '</div>' .
                        '</div>';


                }
                return Response($output);
            }

        }
    }

    // gemy search ajax end


    public function updateProductsInfo(Store $store, Request $request)
    {
        // dd($request->all());
        foreach ($request->info as $item) {
//            dd(round($item['sp_unit_percentage'],3));
//            dd($item['sp_total_percentage']);
            $info = Info::Find($item['id']);
            $info->update($item);
//            $info->store()->associate($store->id);
//            $info->save();
//            $info->products()->sync($item['product']);
        }
        session()->flash('success', 'تم التعديل بنجاح');

        return redirect()->route('stores.show', $store->id);
    }

    public function createNotify(Store $store)
    {
        $products = $store->products()->get();
        return view('admin.stores.create_notify', compact('store', 'products'));
    }

    public function storeNotify(Request $request)
    {
        // Check Date
        $validator = Validator::make($request->all(), [
            'min_total' => 'required',
            'min_unit' => 'required',
            'from' => 'required|before_or_equal:' . $request->to,
            'to' => 'required|after_or_equal:' . $request->from,
        ]);
        if ($validator->fails()) {
            return back()->withErrors('يجب ان يكون تاريخ انتهاء المكافأه بعد تاريخ بدايته|البيانات الأساسية مطلوية');
        }
        /*
         *  Create New Notify
         */
        $notify = new Notify($request->all());
        // variable to check at least one is filled to save
        $at_least_one = false;
        foreach ($request->info as $notify_unit) {
            if ($notify_unit['discount_unit'] != null && $notify_unit['discount_total'] != null) {
                $at_least_one = true;

                // Check First if discount rate less or equal than revenue
                $validator = Validator::make($notify_unit, [
                    'discount_unit' => 'min:1|max:' . $notify_unit['revenue_unit'],
                    'discount_total' => 'min:1|max:' . $notify_unit['discount_total'],
                ]);
                if ($validator->fails()) {
                    $notify->notify_units()->delete();
                    $notify->delete();
                    return back()->withErrors('لا يجب ان يتعدى المكافأه نسبة المكسب ويجب ان يكون 1% على الأقل');
                } else {
                    // Check Later Unit and Later Total
                    // Check Also if now + later discount it equal the discount rete
                    $validator = Validator::make($notify_unit, [
                        'now_total' => 'required',
                        'later_total' => 'required',
                        'now_unit' => 'required',
                        'later_unit' => 'required',
                    ]);
                    if ($validator->fails()) {
                        $notify->notify_units()->delete();
                        $notify->delete();
                        return back()->withErrors('نسبة المكافأه الأجلة والفورية مطلوية');
                    }
                    // Check Also if now + later discount it equal the discount rete
                    $validator = Validator::make($notify_unit, [
                        'discount_unit' => 'in:' . ($notify_unit['now_unit'] + $notify_unit['later_unit']),
                        'discount_total' => 'in:' . ($notify_unit['now_total'] + $notify_unit['later_total']),
                    ]);
                    if ($validator->fails()) {
                        $notify->notify_units()->delete();
                        $notify->delete();
                        return back()->withErrors('يجب ان يكون نسبة المكافأه الأجلة + الفورية مساوية لنسية المكافأه');
                    } else {
                        $notify->save();
                        $notify_unit = new Notify_unit($notify_unit);
                        $notify_unit->notify_id = $notify->id;
                        $notify_unit->save();
                    }
                }
            }
        }
        if ($at_least_one) {
            session()->flash('success', 'تم اضافة المكافأه بنجاح');
            return redirect('admin/stores')->with('تم اضافة المكافأه بنجاح');
        } else {
            $notify->delete();
            return back()->withErrors('يجب عليك اختيار منتج واحد داخل العرض على الاقل');
        }

    }

    public function createNotifyTotal(Store $store)
    {
        $products = $store->products()->get();
        return view('admin.stores.create_notify_total', compact('store', 'products'));
    }

    public function storeNotifyTotal(Request $request)
    {
        // Check Date
        $validator = Validator::make($request->all(), [
            'min_total' => 'required',
            'min_unit' => 'required',
            'from' => 'required|before_or_equal:' . $request->to,
            'to' => 'required|after_or_equal:' . $request->from,
            'percentage_total' => 'required',
            'percentage_unit' => 'required',
//            'products' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withErrors('يجب ان يكون تاريخ انتهاء المكافأه بعد تاريخ بدايته|البيانات الأساسية مطلوية');
        }
        $notify_total = new Notify_total($request->all());
        $notify_total->save();
        $notify_total->products()->attach($request->products);
        session()->flash('success', 'تم اضافة المكافأه بنجاح');
        return redirect('admin/stores')->with('تم اضافة المكافأه بنجاح');
    }

    public function editNotify($notify_id)
    {
        $notify = Notify::find($notify_id);
        $notify_units = $notify->notify_units();
        $store = $notify->store()->get()->first();
        $products = $store->products()->get();


        return view('admin.stores.edit_notify', compact('store', 'products', 'notify', 'notify_units'));
    }

    public function editNotifyTotal($notify_id)
    {
        $notify = Notify_total::find($notify_id);
        $store = $notify->store;
        $products = $store->products()->get();


        return view('admin.stores.edit_notify_total', compact('store', 'products', 'notify'));
    }

    public function updateNotify(Request $request, $notify_id)
    {
        // Check Date
        $validator = Validator::make($request->all(), [
            'min_total' => 'required',
            'min_unit' => 'required',
            'from' => 'required|before_or_equal:' . $request->to,
            'to' => 'required|after_or_equal:' . $request->from,
        ]);
        if ($validator->fails()) {
            return back()->withErrors('يجب ان يكون تاريخ انتهاء المكافأه بعد تاريخ بدايته');
        }
        /*
         *  Get Notify And Update
         */
        $notify = Notify::findOrFail($notify_id);
        $notify->update([
            $request->all()
        ]);
        // variable to check at least one is filled to save
        foreach ($request->info as $notify_unit) {
            /*
             * Check if the product have notify_unit or not
             */
            $current = $notify->notify_units()->where('product_id', $notify_unit['product_id'])->get()->first();
            $data[] = $current;
            if (is_null($current)) {
                $have_product = false;
            } else {
                $have_product = true;
            }
            /*---------------------*/
            // if discount is filled update or create a new one
            if ($notify_unit['discount_unit'] != null && $notify_unit['discount_total'] != null) {

                // Check First if discount rate less or equal than revenue
                $validator = Validator::make($notify_unit, [
                    'discount_unit' => 'min:1|max:' . $notify_unit['revenue_unit'],
                    'discount_total' => 'min:1|max:' . $notify_unit['discount_total'],
                ]);
                if ($validator->fails()) {
                    return back()->withErrors('لا يجب ان يتعدى المكافأه نسبة المكسب ويجب ان يكون 1% على الأقل');
                } else {
                    // Check Later Unit and Later Total
                    // Check Also if now + later discount it equal the discount rete
                    $validator = Validator::make($notify_unit, [
                        'now_total' => 'required',
                        'later_total' => 'required',
                        'now_unit' => 'required',
                        'later_unit' => 'required',
                    ]);
                    if ($validator->fails()) {
                        return back()->withErrors('نسبة المكافأه الأجلة والفورية مطلوية');
                    }
                    // Check Also if now + later discount it equal the discount rete
                    $validator = Validator::make($notify_unit, [
                        'discount_unit' => 'in:' . ($notify_unit['now_unit'] + $notify_unit['later_unit']),
                        'discount_total' => 'in:' . ($notify_unit['now_total'] + $notify_unit['later_total']),
                    ]);
                    if ($validator->fails()) {
                        return back()->withErrors('يجب ان يكون نسبة المكافأه الأجلة + الفورية مساوية لنسية المكافأه');
                    } else {
                        /*
                         * If Have Products Update The Unit
                         * If Not Have Product Create A new one
                         */
                        if ($have_product) {
                            $current->update([
                                $notify_unit
                            ]);
                        } else {
                            $notify_unit = new Notify_unit($notify_unit);
                            $notify_unit->notify_id = $notify->id;
                            $notify_unit->save();
                        }
                        /*---------------------------------------------*/
                    }
                }
            } // if not filled delete the notify unit if exist
            else {
                if ($have_product) {
                    $current->delete();
                }
            }
        }
        session()->flash('success', 'تم تعديل المكافأه بنجاح');
        return redirect('/admin/stores/' . $notify->store->id);
    }

    public function updateNotifyTotal(Request $request, $notify_id)
    {
        // Check Date
        $validator = Validator::make($request->all(), [
            'products' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withErrors('المنتجات مطلوبه');
        }
        $notify = Notify_total::findOrFail($notify_id);
        $notify->products()->sync($request->products);
        session()->flash('success', 'تم تعديل المكافأه بنجاح');
        return redirect('/admin/stores/' . $notify->store->id);
    }

    public function deleteNotify($notify_id)
    {
        $notify = Notify::findOrFail($notify_id);
        /*
         * Delete Notify Users
         */
        foreach ($notify->notify_users as $notify_user) {
            $notify_user->delete();
        }
        /*
         * Delete Notify Units
         */
        foreach ($notify->notify_units as $notify_unit) {
            $notify_unit->delete();
        }
        $notify->delete();
        session()->flash('success', 'تم حذف المكافأه بنجاح');
        return redirect('/admin/stores/' . $notify->store->id);
    }

    public function deleteNotifyTotal($notify_id)
    {
        $notify = Notify_total::findOrFail($notify_id);
        $notify->delete();
        session()->flash('success', 'تم حذف المكافأه بنجاح');
        return redirect('/admin/stores/' . $notify->store->id);
    }

    public function createGlobalNotify()
    {
        $products = Product::all();
        return view('admin.stores.create_global_notify', compact('products'));
    }

    public function indexGlobalNotify()
    {
        $global_notify = Notify::where('store_id', 0)->get()->first();
        if (Notify::where('store_id', 0)->get()->count()) {
            $units = $global_notify->notify_units()->get();
            $create = false;
        } else {
            $units = [];
            $create = true;
        }


        return view('admin.stores.index_global_notify', compact('global_notify', 'units', 'create'));
    }

    public function storeGlobalNotify(Request $request)
    {
        // Check Date
        $validator = Validator::make($request->all(), [
            'min_total' => 'required',
            'min_unit' => 'required',
            'from' => 'required|before_or_equal:' . $request->to,
            'to' => 'required|after_or_equal:' . $request->from,
        ]);
        if ($validator->fails()) {
            return back()->withErrors('يجب ان يكون تاريخ انتهاء المكافأه بعد تاريخ بدايته|البيانات الأساسية مطلوية');
        }
        /*
         *  Create New Notify
         */
        $request->store_id = 0;
        $notify = new Notify($request->all());
        // variable to check at least one is filled to save
        $at_least_one = false;
        foreach ($request->info as $notify_unit) {
            if ($notify_unit['discount_unit'] != null && $notify_unit['discount_total'] != null) {
                $at_least_one = true;

                // Check Later Unit and Later Total
                // Check Also if now + later discount it equal the discount rete
                $validator = Validator::make($notify_unit, [
                    'now_total' => 'required',
                    'later_total' => 'required',
                    'now_unit' => 'required',
                    'later_unit' => 'required',
                ]);
                if ($validator->fails()) {
                    $notify->notify_units()->delete();
                    $notify->delete();
                    return back()->withErrors('نسبة المكافأه الأجلة والفورية مطلوية');
                }
                // Check Also if now + later discount it equal the discount rete
                $validator = Validator::make($notify_unit, [
                    'discount_unit' => 'in:' . ($notify_unit['now_unit'] + $notify_unit['later_unit']),
                    'discount_total' => 'in:' . ($notify_unit['now_total'] + $notify_unit['later_total']),
                ]);
                if ($validator->fails()) {
                    $notify->notify_units()->delete();
                    $notify->delete();
                    return back()->withErrors('يجب ان يكون نسبة المكافأه الأجلة + الفورية مساوية لنسية المكافأه');
                } else {
                    $notify->save();
                    $notify_unit = new Notify_unit($notify_unit);
                    $notify_unit->notify_id = $notify->id;
                    $notify_unit->save();
                }
            }
        }
        if ($at_least_one) {
            return redirect('/admin/global_notify');
        } else {
            $notify->delete();
            return back()->withErrors('يجب عليك اختيار منتج واحد داخل العرض على الاقل');
        }

    }

    public function editGlobalNotify()
    {
        $notify = Notify::where('store_id', 0)->get()->first();
        $notify_units = $notify->notify_units();
        $products = Product::all();
        return view('admin.stores.edit_global_notify', compact('products', 'notify', 'notify_units'));
    }

    public function updateGlobalNotify(Request $request)
    {
        // Check Date
        $validator = Validator::make($request->all(), [
            'min_total' => 'required',
            'min_unit' => 'required',
            'from' => 'required|before_or_equal:' . $request->to,
            'to' => 'required|after_or_equal:' . $request->from,
        ]);
        if ($validator->fails()) {
            return back()->withErrors('يجب ان يكون تاريخ انتهاء المكافأه بعد تاريخ بدايته');
        }
        /*
         *  Get Notify And Update
         */
        $notify = Notify::where('store_id', 0)->get()->first();
        $notify->update($request->all());
        // variable to check at least one is filled to save
        foreach ($request->info as $notify_unit) {
            /*
             * Check if the product have notify_unit or not
             */
            $current = $notify->notify_units()->where('product_id', $notify_unit['product_id'])->get()->first();
            if ($current == null) {
                $have_product = false;
            } else {
                $have_product = true;
            }
            /*---------------------*/
            // if discount is filled update or create a new one
            if ($notify_unit['discount_unit'] != null && $notify_unit['discount_total'] != null) {
//                dd($notify_unit);

                // Check Later Unit and Later Total
                // Check Also if now + later discount it equal the discount rete
                $validator = Validator::make($notify_unit, [
                    'now_total' => 'required',
                    'later_total' => 'required',
                    'now_unit' => 'required',
                    'later_unit' => 'required',
                ]);
                if ($validator->fails()) {
                    return back()->withErrors('نسبة المكافأه الأجلة والفورية مطلوية');
                }
                // Check Also if now + later discount it equal the discount rete
                $validator = Validator::make($notify_unit, [
                    'discount_unit' => 'in:' . ($notify_unit['now_unit'] + $notify_unit['later_unit']),
                    'discount_total' => 'in:' . ($notify_unit['now_total'] + $notify_unit['later_total']),
                ]);
                if ($validator->fails()) {
                    return back()->withErrors('يجب ان يكون نسبة المكافأه الأجلة + الفورية مساوية لنسية المكافأه');
                } else {
                    /*
                     * If Have Products Update The Unit
                     * If Not Have Product Create A new one
                     */
//                        dd($have_product);
                    if ($have_product) {
                        $current->update([
                            $notify_unit
                        ]);
                    } else {
                        $notify_unit = new Notify_unit($notify_unit);
                        $notify_unit->notify_id = $notify->id;
                        $notify_unit->save();
                    }
                    /*---------------------------------------------*/
                }
            } // if not filled delete the notify unit if exist
            else {
                if ($have_product) {
                    $current->delete();
                }
            }
        }
        session()->flash('success', 'تم التعديل بنجاح');
        return redirect('/admin/global_notify');
    }

    public function deleteGlobalNotify()
    {
        $global_notify = Notify::where('store_id', 0)->get()->first();
        $global_notify->notify_units()->delete();
        $global_notify->delete();
        return redirect('/admin/global_notify');
    }

    public function getShiftLogs(Store $store)
    {
        $shifts = $store->shifts()->where('is_confirmed', 1)->get();
        return view('admin.stores.shifts', compact('store', 'shifts'));
    }

    public function getShiftFinanceLogs(Store $store)
    {
        $shifts = $store->finance_shifts()->where('is_confirmed', 1)->get();
        return view('admin.stores.shifts_finance', compact('store', 'shifts'));
    }

    public function getStoreKeepers(Store $store)
    {
        $store_keepers = $store->store_keepers;
        return view('admin.stores.store_keepers', compact('store_keepers', 'store'));
    }

    public function editKeeperProducts(User $user)
    {
        $user_products = $user->products;
        $products = $user->keeper_store->products;
        return view('admin.stores.keeper_products', compact('user_products', 'products', 'user'));
    }

    public function storeKeeperProducts(Request $request, User $user)
    {
        $request->validate([
            'products' => 'required'
        ]);
        $user->products()->sync($request->products);
        session()->flash('success', ' تم التعديل بنجاح ');
        return redirect()->back();
    }

    public function storeExaminationUnits(User $user)
    {
        if (!empty(Auth::user()->keeper_store)) {
            $examination_units = Examination_unit::whereHas('examination', function ($query) use ($user) {
                return $query->where('store_id', '=', $user->keeper_store->id);
            })->where('is_confirmed', 0)->get();
            $user_products = $user->products;
        } else {
            return back()->withErrors('امين المخزن فقط من يمكنه استلام البضاعه');
        }
        return view('admin.stores.receive_units', compact('examination_units', 'user_products'));
    }

    public function receiveExamination(Examination_unit $examination_unit)
    {
        if (!empty(Auth::user()->keeper_store)) {
            if (Auth::user()->keeper_store->id == $examination_unit->examination->store->id) {
                //update product Quantity
                $product_info = $examination_unit->product->infos()->wherePivot('store_id', '=', $examination_unit->examination->store->id)->get()->first();
                if ($product_info->quantity == 0) {
                    $product_info->update([
                        'first_period' => $examination_unit->quantity_after
                    ]);
                }
                $product_info->update([
                    'quantity' => $examination_unit->quantity_after,
                    'quantity_unit' => $product_info->quantity_unit + $examination_unit->receive * $examination_unit->product->quantity_unit,
                ]);
                return redirect(route('store_keeper.show_store'));
            } else {
                return back()->withErrors('امين المخزن الحالي فقط من يمكنه استلام البضاعه');
            }
        } else {
            return back()->withErrors('امين المخزن فقط من يمكنه استلام البضاعه');
        }
    }
}
