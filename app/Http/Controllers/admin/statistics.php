<?php

namespace App\Http\Controllers\admin;

use App\Dept;
use App\In_item;
use App\Locker;
use App\Item;
use App\lose;
use App\Order;
use App\Product;
use App\Store;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class statistics extends Controller
{
    public function getTotalInOut(){
        $month = Carbon::now()->month; // Current month with Carbon
        $year = Carbon::now()->year; // Current year with Carbon
        /*
         * Daily
         */
        // $total_in_today = In_item::where('date',date('Y-m-d'))->sum('price');
        // $total_in_today+= Order::where('date_of_receipt',date('Y-m-d'))->sum('paid_value');
            $total_in_today = Locker::where('type',0)->whereDate('created_at',date('Y-m-d'))->sum('number');
            // dd($total_in_today);
        // $total_out_today = Item::where('date',date('Y-m-d'))->sum('price');
        // $total_out_today+= Dept::where('date',date('Y-m-d'))->sum('paid');
        // $total_out_today+= lose::where('created_at',date('Y-m-d'))->sum('loss');
            $total_out_today = Locker::where('type',1)->whereDate('created_at',date('Y-m-d'))->sum('number');
        
        
        
        $total_in_out_today = $total_in_today - $total_out_today;
        /*
         * Monthly
         */
        // $total_in_monthly = In_item::whereRaw('MONTH(date) = ?', [$month])->sum('price');
        // $total_in_monthly+= Order::whereRaw('MONTH(date_of_receipt) = ?', [$month])->sum('paid_value');
            $total_in_monthly = Locker::where('type',0)->whereRaw('MONTH(created_at) = ?',[$month])->sum('number');
        
        // $total_out_monthly= Item::whereRaw('MONTH(date) = ?', [$month])->sum('price');
        // $total_out_monthly+= Dept::whereRaw('MONTH(date) = ?', [$month])->sum('paid');
        // $total_out_monthly+= lose::whereRaw('MONTH(created_at) = ?', [$month])->sum('loss');
            $total_out_monthly = Locker::where('type',1)->whereRaw('MONTH(created_at) = ?',[$month])->sum('number');
        
        $total_in_out_monthly = $total_in_monthly - $total_out_monthly;
        /*
         * Yearly
         */
        // $total_in_yearly = In_item::whereRaw('YEAR(date) = ?', [$year])->sum('price');
        // $total_in_yearly+= Order::whereRaw('YEAR(date_of_receipt) = ?', [$year])->sum('paid_value');
        $total_in_yearly = Locker::where('type',0)->whereRaw('YEAR(created_at) = ?',[$year])->sum('number');
        
        
        // $total_out_yearly= Item::whereRaw('YEAR(date) = ?', [$year])->sum('price');
        // $total_out_yearly+= Dept::whereRaw('YEAR(date) = ?', [$year])->sum('paid');
        // $total_out_yearly+= lose::whereRaw('YEAR(created_at) = ?', [$year])->sum('loss');
        $total_out_yearly = Locker::where('type',1)->whereRaw('YEAR(created_at) = ?',[$year])->sum('number');
        
        $total_in_out_yearly = $total_in_yearly - $total_out_yearly;

        return view('admin.statistics.total_in_out',compact('total_in_today','total_out_today','total_in_monthly','total_out_monthly','total_in_yearly','total_out_yearly','total_in_out_today','total_in_out_monthly','total_in_out_yearly'));
    }

    public function getTotalOrderProduct(){
        $products = Product::all();
        $month = Carbon::now()->month; // Current month with Carbon
        $year = Carbon::now()->year; // Current month with Carbon
        foreach ($products as $product)
        {
            // Daily
            $product->order_count_daily = $product->order_unit()->whereHas('order',function ($query){
                $query->where('orders.date_of_order',date('Y-m-d'));
            })->count();
            // monthly
            $product->order_count_monthly = $product->order_unit()->whereHas('order',function ($query)use ($month){
                $query->whereRaw('MONTH(date_of_order) = ?', [$month]);
            })->count();
            // yearly
            $product->order_count_yearly = $product->order_unit()->whereHas('order',function ($query)use ($year){
                $query->whereRaw('YEAR(date_of_order) = ?', [$year]);
            })->count();
        }
        return view('admin.statistics.total_order_products',compact('products'));
    }

    public function getIncomeProductTotal(){
        $products = Product::all();
        $month = Carbon::now()->month; // Current month with Carbon
        $year = Carbon::now()->year; // Current month with Carbon

        $total_daily =0;
        $total_monthly =0;
        $total_yearly =0;
        foreach ($products as $product)
        {
            // Daily
            $product->product_daily = $product->order_unit()->whereHas('order',function ($query){
                $query->where('orders.date_of_order',date('Y-m-d'));
            })->with('order')->get();
            $product->product_daily = $product->product_daily->sum('order.paid_value');
            $total_daily+= $product->product_daily;
            // monthly
            $product->product_monthly = $product->order_unit()->whereHas('order',function ($query)use ($month){
                $query->whereRaw('MONTH(date_of_order) = ?', [$month]);
            })->with('order')->get();
            $product->product_monthly = $product->product_monthly->sum('order.paid_value');
            $total_monthly+= $product->product_monthly;
            // yearly
            $product->product_yearly = $product->order_unit()->whereHas('order',function ($query)use ($year){
                $query->whereRaw('YEAR(date_of_order) = ?', [$year]);
            })->with('order')->get();
            $product->product_yearly = $product->product_yearly->sum('order.paid_value');
            $total_yearly+= $product->product_yearly;
        }
        return view('admin.statistics.total_income_product',compact('products','total_daily','total_monthly','total_yearly'));
    }

    public function getTotalPaidUsers(){
        $users = User::whereRoleIs('user')->get();
        foreach ($users as $user){
            $user->total_paid = $user->orders()->sum('paid_value');
            $user->total_reset = $user->orders()->sum('rest_value');
        }
        return view('admin.statistics.total_paid_users',compact('users'));
    }

    public function getTotalIncomeStore($id){
        $store = Store::findOrFail($id);
        $products = $store->products;
        $month = Carbon::now()->month; // Current month with Carbon
        $year = Carbon::now()->year; // Current month with Carbon

        $total_daily =0;
        $total_monthly =0;
        $total_yearly =0;
        $total_order_daily =0;
        $total_order_monthly =0;
        $total_order_yearly =0;
        foreach ($products as $product)
        {
            // Daily
            $product->product_daily = $product->order_unit()->whereHas('order',function ($query){
                $query->where('orders.date_of_order',date('Y-m-d'));
            })->with('order')->get();
            $product->product_daily = $product->product_daily->sum('order.paid_value');
            $total_daily+= $product->product_daily;
            // monthly
            $product->product_monthly = $product->order_unit()->whereHas('order',function ($query)use ($month){
                $query->whereRaw('MONTH(date_of_order) = ?', [$month]);
            })->with('order')->get();
            $product->product_monthly = $product->product_monthly->sum('order.paid_value');
            $total_monthly+= $product->product_monthly;
            // yearly
            $product->product_yearly = $product->order_unit()->whereHas('order',function ($query)use ($year){
                $query->whereRaw('YEAR(date_of_order) = ?', [$year]);
            })->with('order')->get();
            $product->product_yearly = $product->product_yearly->sum('order.paid_value');
            $total_yearly+= $product->product_yearly;
            /*
             * Count Orders
             */
            // Daily
            $product->order_count_daily = $product->order_unit()->whereHas('order',function ($query){
                $query->where('orders.date_of_order',date('Y-m-d'));
            })->count();
            $total_order_daily+= $product->order_count_daily;

            // monthly
            $product->order_count_monthly = $product->order_unit()->whereHas('order',function ($query)use ($month){
                $query->whereRaw('MONTH(date_of_order) = ?', [$month]);
            })->count();
            $total_order_monthly+= $product->order_count_monthly;

            // yearly
            $product->order_count_yearly = $product->order_unit()->whereHas('order',function ($query)use ($year){
                $query->whereRaw('YEAR(date_of_order) = ?', [$year]);
            })->count();
            $total_order_yearly+= $product->order_count_yearly;

        }

        return view('admin.statistics.total_income_store',compact('store','products','total_daily','total_monthly','total_yearly','total_order_daily','total_order_monthly','total_order_yearly'));
    }
}
