<?php

namespace App\Http\Controllers\admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Company;
use File;
use Illuminate\Support\Facades\Validator;

class companies extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $companies = Company::all();
        return view('admin.companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $companies = Company::all();
        return view('admin.companies.create', compact('companies','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100|unique:companies,name',
            'name_en' => 'required|string|max:100|unique:companies,name_en',
            'company_field' => 'required|string|max:100',
            'company_field_en' => 'required|string|max:100',
            'is_hidden' => 'required',
            'category_id' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif|required|max:50000', // max 10000kb
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }
        $companies = new Company();
        $companies->name = $request->name;
        $companies->name_en = $request->name_en;
        $companies->is_hidden = $request->is_hidden;
        $companies->category_id = $request->category_id;
        $companies->company_field = $request->company_field;
        $companies->company_field_en = $request->company_field_en;

        $companies->save();

        $id = $companies->id;

        if ($image = $request->file('image')) {
            $destinationPath = public_path('uploads/companies');
            $extension = $image->getClientOriginalExtension();
            $fileName = $id . '_image' . '.' . $extension;

            $image->move($destinationPath, $fileName);

            Company::where('id', $id)->update(['image' => $fileName]);
        }

        session()->flash('success',' تمت الأضافة بنجاح ');

        return redirect('admin/companies');
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
        $categories = Category::all();
        $companies = Company::find($id);
        return view('admin.companies.edit', compact('companies','categories'));
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100|unique:companies,name' . ($id ? ",$id" : ''),
            'name_en' => 'required|string|max:100|unique:companies,name_en' . ($id ? ",$id" : ''),
            'company_field' => 'required|string|max:100',
            'company_field_en' => 'required|string|max:100',
            'is_hidden' => 'required',
            'category_id' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }
        $companies = Company::find($id);
        $companies->name = $request->name;
        $companies->name_en = $request->name_en;
        $companies->is_hidden = $request->is_hidden;
        $companies->category_id = $request->category_id;
        $companies->company_field = $request->company_field;
        $companies->company_field_en = $request->company_field_en;
        $companies->save();
        $id = $companies->id;

        if ($image = $request->file('image')) {
            $validator = Validator::make($request->all(), [
                'image' => 'mimes:jpeg,jpg,png,gif|required|max:50000', // max 10000kb
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return back()->with('errors', $errors);
            }
            $destinationPath = public_path('uploads/companies');
            $extension = $image->getClientOriginalExtension();
            $fileName = $id . '_image' . '.' . $extension;

            $image->move($destinationPath, $fileName);

            Company::where('id', $id)->update(['image' => $fileName]);
        }
        session()->flash('success','تم التعديل بنجاح');

        return redirect('admin/companies');
    }


    public function activeProduct($id)
    {
        $companies = Company::where('id', $id)->first();
        $companies->is_hidden = 1;
        $companies->save();
        foreach ($companies->products as $prod) {
            $prod->is_hidden = 1;
            $prod->save();
        }
        // return view('option', compact('option'));
        session()->flash('success','تم ايقاف التفعيل بنجاح');
        return back();
    }

    public function deActiveProduct($id)
    {
        $companies = Company::where('id', $id)->first();
        $companies->is_hidden = 0;
        $companies->save();
        foreach ($companies->products as $prod) {
            $prod->is_hidden = 0;
            $prod->save();
        }
        // return view('option', compact('option'));
        session()->flash('success','تم التفعيل بنجاح');
        return back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $companies = Company::findOrFail($id);
        $destinationPath = public_path('uploads/companies/' . $companies->image);
        if (File::exists($destinationPath)) {
            File::delete($destinationPath);
        }
        $companies = Company::destroy($id);
        return back(); //
    }
}
