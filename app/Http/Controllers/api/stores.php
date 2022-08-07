<?php

namespace App\Http\Controllers\api;

use App\Http\Resources\storesResource;
use App\Place;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Store;
use Hash;

class stores extends Controller
{

    use ApiResponceTrait ;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        $stores= Store::all();

            return  $this->ApiResponce($stores);

    }

    public function store(Request $request)
    {
        return Store::create([
            'name' => $request['name'],
            'section' => $request['section'],
            'address' => $request['address'],

        ]);
    }


    public function show($id)
    {

    }



    public function update(Request $request)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getByPlace($id){
        $place = Place::findOrFail($id);
        $stores = $place->stores()->get();
        return  $this->ApiResponce($stores);
    }
}
