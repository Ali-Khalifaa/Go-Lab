<?php

namespace App\Http\Controllers\stores;

use App\StoreCategories;
use App\StoreSubcategory;
use App\Subcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class StoreSubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategories=StoreSubcategory::all();

        return view('stores.subcategories.index',compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=StoreCategories::all();
        return view('stores.subcategories.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subcategories = new StoreSubcategory();
        $subcategories->name = $request->name;
        $subcategories->category_id = $request->category_id;
        $subcategories->store_id =Auth::guard('store')->user()->id;

        $subcategories->save();
        $id= $subcategories->id;
        if($image = $request->file('image')){
            $destinationPath = public_path('uploads/storesubcatecories');
            $extension = $image->getClientOriginalExtension();
            $fileName = $id.'_image'.'.'.$extension;

            $image->move($destinationPath, $fileName);

            StoreSubcategory::where('id',$id)->update(['image' => $fileName]);
        }

        return redirect('store/storesubcategories');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories=StoreCategories::all();
        $subcategory= StoreSubcategory::find($id);
        return view('stores.subcategories.edit',compact('subcategory','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $subcategories = StoreSubcategory::find($id);
        $subcategories->name = $request->name;
        $subcategories->category_id = $request->category_id;
        $subcategories->save();
        $id= $subcategories->id;

        if($image = $request->file('image')){
            $destinationPath = public_path('uploads/storesubcatecories');
            $extension = $image->getClientOriginalExtension();
            $fileName = $id.'_image'.'.'.$extension;

            $image->move($destinationPath, $fileName);

            StoreSubcategory::where('id',$id)->update(['image' => $fileName]);
        }
        return redirect('store/storesubcategories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subcategories = StoreSubcategory::findOrFail($id);
        $destinationPath = public_path('uploads/storesubcatecories/'.$subcategories->image);
        if(File::exists($destinationPath)){
            File::delete($destinationPath);
        }
        $categories = StoreSubcategory::destroy($id);
        return back();

    }
}
