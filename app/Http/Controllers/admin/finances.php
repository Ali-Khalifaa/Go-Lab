<?php

namespace App\Http\Controllers\admin;

use App\In_item;
use App\Item;
use App\Mandob;
use App\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class finances extends Controller
{
    public function getFinanceMandobs(Store $store){
        if (Auth::user()->id == $store->store_finance_manager->id)
        {
            $mandobs = $store->place->mandobs;
            return view('admin.finance.mandobs' , compact('mandobs','store'));
        }
        else
        {
            return back()->withErrors('لا يمكنك رؤية حسابات المندوبين');
        }
    }
    public function mandob_zero(Store $store , Mandob $mandob){
        if (Auth::user()->id == $store->store_finance_manager->id)
        {
            $store->update([
                'finance' => $store->finance + $mandob->wallet
            ]);
            $mandob->update([
                'wallet' => 0
            ]);
            $mandobs = $store->place->mandobs;
            return view('admin.finance.mandobs' , compact('mandobs','store'));
        }
        else
        {
            return back()->withErrors('لا يمكنك تصفية حسابات المندوبين');
        }
    }
    public function getOutStore(Store $store){
        $outs = $store->outs;

        return view('admin.finance.finance_out' , compact('outs','store'));
    }
    public function confirmOut(Item $item){
        if (!empty(Auth::user()->store_finance_manager))
        {
            if (Auth::user()->store_finance_manager->id == $item->store->id){
                $store = $item->store;
                /*
                 * check first if Storage have enough money
                 */
                if ($store->finance >= $item->price)
                {
                    $store->update([
                        'finance'   =>  $store->finance - $item->price
                    ]);
                    $item->update([
                        'is_confirmed'  =>  1,
                        'finance_manager_id'    =>  Auth::user()->store_finance_manager->id,
                    ]);
                    return back();
                }
                else
                {
                    return back()->withErrors('لا يوجد ما يكفي من المال للصرف');
                }
            }
        }
        return back()->withErrors('لا يمكنك الموافقة على الصرف');
    }
    public function getInStore(Store $store){
        $ins = $store->ins;
        return view('admin.finance.finance_in' , compact('ins','store'));
    }
    public function confirmIn(In_item $item){
        if (!empty(Auth::user()->store_finance_manager))
        {
            if (Auth::user()->store_finance_manager->id == $item->store->id){
                $store = $item->store;
                $store->update([
                    'finance'   =>  $store->finance + $item->price
                ]);
                $item->update([
                    'is_confirmed' => 1,
                    'finance_manager_id' => Auth::user()->store_finance_manager->id,
                ]);
                return back();
            }
        }
        return back()->withErrors('لا يمكنك الموافقة على الايراد');
    }
}
