<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use File;
use Illuminate\Support\Facades\Validator;

class categories extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.categories.create', compact('categories'));
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
            'name' => 'required|string|max:100|unique:categories,name',
            'name_en' => 'required|string|max:100|unique:categories,name_en',
            'is_hidden' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif|required|max:50000', // max 10000kb
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }
        $categories = new Category();
        $categories->name = $request->name;
        $categories->name_en = $request->name_en;
        $categories->is_hidden = $request->is_hidden;
        $categories->save();

        $id = $categories->id;

        if ($image = $request->file('image')) {
            $destinationPath = public_path('uploads/categories');
            $extension = $image->getClientOriginalExtension();
            $fileName = $id . '_image' . '.' . $extension;

            $image->move($destinationPath, $fileName);

            Category::where('id', $id)->update(['image' => $fileName]);
        }
        session()->flash('success', ' تمت الأضافة بنجاح ');
        return redirect('admin/categories');
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
        $categories = Category::find($id);
        return view('admin.categories.edit', compact('categories'));
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
            'name' => 'required|string|max:100|unique:categories,name' . ($id ? ",$id" : ''),
            'name_en' => 'required|string|max:100|unique:categories,name_en' . ($id ? ",$id" : ''),
            'is_hidden' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }
        $categories = Category::find($id);
        $categories->name = $request->name;
        $categories->name_en = $request->name_en;
        $categories->is_hidden = $request->is_hidden;
        $categories->save();
        $id = $categories->id;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $validator = Validator::make($request->all(), [
                'image' => 'mimes:jpeg,jpg,png,gif|required|max:50000', // max 10000kb
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return back()->with('errors', $errors);
            }
            $destinationPath = public_path('uploads/categories');
            $extension = $image->getClientOriginalExtension();
            $fileName = $id . '_image' . '.' . $extension;

            $image->move($destinationPath, $fileName);

            Category::where('id', $id)->update(['image' => $fileName]);
        }
        session()->flash('success', 'تم التعديل بنجاح');

        return redirect('admin/categories');
    }

    public function activeProduct($id)
    {
        $categories = Category::where('id', $id)->first();
        $categories->is_hidden = 1;
        $categories->save();

        foreach ($categories->subcategories as $subcategories) {
            $subcategories->is_hidden = 1;
            $subcategories->save();

            foreach ($subcategories->products as $prod) {
                $prod->is_hidden = 1;
                $prod->save();
            }

        }
        session()->flash('success', 'تم ايقاف التفعيل بنجاح');

        // return view('option', compact('option'));
        return back();
    }

    public function deActiveProduct($id)
    {
        $categories = Category::where('id', $id)->first();
        $categories->is_hidden = 0;
        $categories->save();

        foreach ($categories->subcategories as $subcategories) {
            $subcategories->is_hidden = 0;
            $subcategories->save();

            foreach ($subcategories->products as $prod) {
                $prod->is_hidden = 0;
                $prod->save();
            }

        }
        session()->flash('success', 'تم التفعيل بنجاح');
        // return view('option', compact('option'));
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
        $categories = Category::findOrFail($id);
        $destinationPath = public_path('uploads/categories/' . $categories->image);
        if (File::exists($destinationPath)) {
            File::delete($destinationPath);
        }
        $categories = Category::destroy($id);
        return back();
    }
}
