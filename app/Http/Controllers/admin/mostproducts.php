<?php

namespace App\Http\Controllers\admin;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mostproduct;
use App\Product;
use Illuminate\Support\Facades\DB;

class mostproducts extends Controller
{
    public function index()
    {
        $mostproducts= Order::where('is_complete',1)
            ->with('order_units')
            ->join('order_units', 'order_units.order_id', '=', 'orders.id')
            ->join('products', 'order_units.product_id', '=', 'products.id')
            ->select('product_id','products.*',DB::raw('COUNT(product_id) as count'))
            ->groupBy('product_id')
            ->orderBy('count', 'desc')
            ->take(10)->get();
        return view('admin.mostproducts.index',compact('mostproducts'));
    }
}
