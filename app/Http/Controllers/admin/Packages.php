<?php

namespace App\Http\Controllers\admin;

use App\Package;
use App\PackageProducts;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class Packages extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages=Package::all();
        return view('admin.packages.index',compact('packages'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $products=Product::all();

        return view('admin.packages.create',compact('products'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    $package=Package::create([
        'name'=>$request->name,
        'price'=>$request->price,
    ]);
$products=Product::whereIn('id',$request->product_id)->get();

foreach ($products as $product){
PackageProducts::create([
    'package_id'=>$package->id,
    'product_id'=>$product->id,
]);
}
        return redirect('admin/packages');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $products=Product::all();
        $package=Package::find($id);
        return view('admin.packages.edit',compact('products','package'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $products=Product::all();
        $package=Package::find($id);
        return view('admin.packages.edit',compact('products','package'));    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $products = PackageProducts::where('package_id', $request->package_id)->get();
        foreach ($products as $product) {
            $product->delete();
        }


        foreach ($request->product_id as $product) {

            PackageProducts::create([
                'package_id' => $request->package_id,
                'product_id' => $product,
            ]);
        }
        $package = Package::find($request->package_id)->update([
            'name' => $request->name,
            'price' => $request->price
        ]);

        return redirect('admin/packages');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $packages=PackageProducts::where('package_id',$id)->get();
       foreach ($packages as $package){
           $package->delete();
       }
       Package::find($id)->delete();
        return redirect('admin/packages');
    }
}
