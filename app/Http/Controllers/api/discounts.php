<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Discount;

class discounts extends Controller
{

    public function immediately()
    {
        $user_id = auth()->user()->id;

        $discount = Discount::where([
            ['user_id', $user_id],
            ['immediately',1]
        ])->with(['discountType','order'])->latest()->take(10)->get();

        return response()->json($discount);
    }

    public function postponed()
    {
        $user_id = auth()->user()->id;

        $discount = Discount::where([
            ['user_id', $user_id],
            ['immediately',0],
            ['end_discount','=',0],
            ['to_date', '>=', now()],
        ])->with(['discountType','order'])->get();


        return response()->json($discount);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (true) {
            return Discount::all();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
