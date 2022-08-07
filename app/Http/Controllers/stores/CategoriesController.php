<?php

namespace App\Http\Controllers\stores;

use App\Store;
use App\StoreCategories;

use App\StoreSubcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class CategoriesController extends Controller
{
  use UploadTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories=StoreCategories::all();
        return view('stores.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stores= Store::all();
        return view('stores.categories.create',compact('stores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $categories = new StoreCategories();
        $categories->name = $request->name;
        $categories->store_id =Auth::guard('store')->user()->id;

        $categories->save();
        $id= $categories->id;
        if($image = $request->file('image')){
            $destinationPath = public_path('uploads/storecatecories');
            $extension = $image->getClientOriginalExtension();
            $fileName = $id.'_image'.'.'.$extension;

            $image->move($destinationPath, $fileName);

            StoreCategories::where('id',$id)->update(['image' => $fileName]);
        }

        return redirect('store/storecategories');
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
        $category= StoreCategories::find($id);
        return view('stores.categories.edit',compact('category'));
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
        $categories = StoreCategories::find($id);
        $categories->name = $request->name;
        $categories->save();


        if($image = $request->file('image')){
            $destinationPath = public_path('uploads/storecatecories');
            $extension = $image->getClientOriginalExtension();
            $fileName = $id.'_image'.'.'.$extension;

            $image->move($destinationPath, $fileName);

            StoreCategories::where('id',$id)->update(['image' => $fileName]);
        }

        return redirect('store/storecategories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subcategories=StoreSubcategory::where('category_id',$id)->first();

        if ($subcategories == null){

            $categories = StoreCategories::findOrFail($id);
            $destinationPath = public_path('uploads/storecatecories/'.$categories->image);
            if(File::exists($destinationPath)){
                File::delete($destinationPath);
            }
            $categories = StoreCategories::destroy($id);
            return back(); //
        }
        return back();
    }
}
