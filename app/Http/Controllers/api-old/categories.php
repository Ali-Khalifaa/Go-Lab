<?php

namespace App\Http\Controllers\api;

use App\Company;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;

class categories extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (true) {
            return Category::where('is_hidden','=',0)->get();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Category::create([
            'name' => $request['name'],
            'image' => $request['image'],
        ]);
    }

    /*
     * Get All sub_categories
     */
    public function getSubCategories(Category $category){
        return $category->subcategories()->where('is_hidden','=',0)->get();
    }

    /*
     * Get Categories that have products with specific Company
     */
    public function getAvailableCategories(Company $company){
        // Retrieve Categories with at least one product has this company
        $categories = Category::whereHas('products', function (Builder $query)use ($company) {
            $query->where('company_id','=',$company->id)->where('is_hidden','=',0);
        })->get();
        return $categories;
    }
}
