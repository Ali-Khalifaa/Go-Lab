<?php

namespace App\Http\Controllers\admin;

use App\Company;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DiscountCompanyController extends Controller
{
    public function index($id)
    {
        //
    }

    public function create($id)
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function edit($id)
    {
        $company=Company::findOrFail($id);

        return view('admin.discountCompany.edit',compact('company'));
    }

    public function update(Request $request, $id)
    {
        $company=Company::findOrFail($id);
        $company->update($request->all());

        session()->flash('success','تم التعديل بنجاح');

        return redirect('admin/companies');
    }

    public function destroy($id)
    {
        //
    }
}
