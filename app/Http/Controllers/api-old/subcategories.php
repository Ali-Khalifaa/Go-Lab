<?php

namespace App\Http\Controllers\api;

use App\Company;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Subcategory;

class subcategories extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (true) {
            return Subcategory::where('is_hidden','=',0)->get();;
        }
    }

    /*
     * Get SubCategories that have products with specific Company
     */
    public function getAvailableSubCategories(Company $company){
        // Retrieve Categories with at least one product has this company
        $categories = Subcategory::whereHas('products', function (Builder $query)use ($company) {
            $query->where('company_id','=',$company->id)->where('is_hidden','=',0);
        })->get();
        return $categories;
    }
    /*
     * Get Available Companies
     */
    public function getAvailableCompanies(Subcategory $sub_category){
        // Retrieve Categories with at least one product has this company
        $companies = Company::whereHas('products', function (Builder $query)use ($sub_category) {
            $query->where('subcategory_id','=',$sub_category->id)->where('is_hidden','=',0);
        })->get();
        return $companies;
    }
}
