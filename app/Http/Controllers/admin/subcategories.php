<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Subcategory;
use App\Company;
use File;
use Illuminate\Support\Facades\Validator;

class subcategories extends Controller
{
    public function index()
    {
        $categories=Category::all();
        $subcategories=Subcategory::all();
        $companies=Company::all();
        return view('admin.subcategories.index',compact('companies','subcategories','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subcategories=Subcategory::all();
        $categories=Category::all();
        $companies=Company::all();
        return view('admin.subcategories.create',compact('categories','companies','subcategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'company' => 'required',
            'name' => 'required',
            'name_en' => 'required',
            'is_hidden' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif|required|max:50000', // max 10000kb
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }
        $subcategories = new Subcategory();
        $subcategories->name = $request->name;
        $subcategories->name_en = $request->name_en;
        $subcategories->is_hidden = $request->is_hidden;
        $subcategories->category_id = $request->category_id;
        // $subcategories->company_id = $request->company_id;

        $subcategories->save();
        $subcategories->companys()->attach($request->company);

        $id= $subcategories->id;

        if($image = $request->file('image')){
            $destinationPath = public_path('uploads/subcategories');
            $extension = $image->getClientOriginalExtension();
            $fileName = $id.'_image'.'.'.$extension;

            $image->move($destinationPath, $fileName);

            Subcategory::where('id',$id)->update(['image' => $fileName]);
        }
        session()->flash('success',' تمت الأضافة بنجاح ');

        return redirect('admin/subcategories');
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
        $subcategories = Subcategory::find($id);
        $categories = Category::all();
        $companies = Company::all();

        return view('admin.subcategories.edit',compact('subcategories','companies','categories'));
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
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'companys' => 'required',
            'name' => 'required',
            'name_en' => 'required',
            'is_hidden' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }
        $subcategories = Subcategory::find($id);
        $subcategories->name = $request->name;
        $subcategories->name_en = $request->name_en;
        $subcategories->is_hidden = $request->is_hidden;
        // $subcategories->company_id = $request->company_id;
        $subcategories->category_id = $request->category_id;
        $subcategories->save();
        if($request->companys)
        {
         $subcategories->companys()->sync($request->companys);
        }

        $id= $subcategories->id;

        if($image = $request->file('image')){
            $validator = Validator::make($request->all(), [
                'image' => 'mimes:jpeg,jpg,png,gif|required|max:50000', // max 10000kb
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return back()->with('errors', $errors);
            }
            $destinationPath = public_path('uploads/subcategories');
            $extension = $image->getClientOriginalExtension();
            $fileName = $id.'_image'.'.'.$extension;

            $image->move($destinationPath, $fileName);

            Subcategory::where('id',$id)->update(['image' => $fileName]);
        }
        session()->flash('success','تم التعديل بنجاح');

        return redirect('admin/subcategories');
    }


    public function activeProduct($id)
    {
        $categories=Subcategory::where('id',$id)->first();
        $categories->is_hidden=1;
        $categories->save();

        foreach($categories->products as $prod)
        {
            $prod->is_hidden=1;
            $prod->save();
        }
        // return view('option', compact('option'));
        session()->flash('success','تم ايقاف التفعيل بنجاح');
        return back();
    }

    public function deActiveProduct($id)
    {
        $categories=Subcategory::where('id',$id)->first();
        $categories->is_hidden=0;
        $categories->save();

        foreach($categories->products as $prod)
        {
            $prod->is_hidden=0;
            $prod->save();
        }
        // return view('option', compact('option'));
        session()->flash('success','تم التفعيل بنجاح');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subcategories = Subcategory::findOrFail($id);
        $destinationPath = public_path('uploads/subcategories/'.$subcategories->image);
        if(File::exists($destinationPath)){
          File::delete($destinationPath);
              }
         $subcategories = Subcategory::destroy($id);
        return back(); //ck();
    }
}
