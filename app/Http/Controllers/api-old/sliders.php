<?php

namespace App\Http\Controllers\api;

use App\Category;
use App\Http\Resources\SliderResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Slider;
use App\Option;
use App\order_unit;

class sliders extends Controller
{
    use ApiResponceTrait ;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders= Slider::all();
        foreach ($sliders as $slider){
            $slider->product;
            $slider->category;
        }
        return $this->ApiResponce($sliders) ;
//        if (true) {
//            return Slider::latest()->take(6)->get();
//        }
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($store_id)
    {
        $sliders= Slider::all();
        $sliders_with_hidden_prod=[];
        foreach ($sliders as $slider){
            
            $product=$slider->product;
            
            $clone_product = $product->replicate();
            $product_customs = $product->infos()->wherePivot('store_id','=',$store_id)->get()->first();
//            --------------
            if(Option::findOrFail(3)->is_active)
            {
                $product_all = $product->infos;
                $product->quantity_info = $product_all->pluck('quantity')->sum();
                $product->quantity_unit_info = $product_all->pluck('quantity_unit')->sum();
            }
            else
            {
                $product->quantity_info = $product_customs->quantity;
                $product->quantity_unit_info = $product_customs->quantity_unit;
            }
//            --------------
            /* دمج جميع المنتجات اللي اطلبت ومكافأهها من الكميه لكي لا يطلب اكثر من المتاح */
            $order_units = order_unit::whereHas('order',function ($query) use ($store_id){
                $query->where([
                    ['store_id' , '=' ,$store_id],
                    ['is_complete' , '=' ,1],
                    ['is_direct_sell' , '=' ,0],
                    ['order_stage_id' , '<' ,5],
                ]);
            })->get();
            $minus_total = $order_units->sum('quantity_total');
            $minus_unit = $order_units->sum('quantity_unit');
            $product->quantity_info = $product->quantity_info - $minus_total;
            $product->quantity_unit_info = $product->quantity_unit_info - $minus_unit;
            if ($product->quantity_info < 0)
            {
                $product->quantity_info =0;
            }
            if ($product->quantity_unit_info < 0)
            {
                $product->quantity_unit_info =0;
            }
            /*------------------------------------------------------------------------*/
            $product->reorder_limit = $product_customs->reorder_limit;
            $product->sp_unit_percentage = $product_customs->sp_unit_percentage;
            $product->sp_total_percentage	 = $product_customs->sp_total_percentage;
            $product->buy_price = $product_customs->buy_price;
            $product->sp_unit_price =  $product_customs->sell_unit($clone_product);
            $product->sp_total_price =  $product_customs->sell_total;
            $product->images;
                        // end
            
            $slider->category;
            if($slider->product->is_hidden==0)
            {
             $sliders_with_not_hidden_prod[]=$slider;
            //  return  $sliders = array_diff($sliders, $sliders_with_hidden_prod);
            }
            
        }
        // return $sliders;
    //   return  $sliders = array_diff($sliders, $sliders);
    //   $differenceArray = array_diff($category, $TagNames);
        
        return $this->ApiResponce($sliders_with_not_hidden_prod) ;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
    public function getByCategory($category_id){
        $category = Category::findOrFail($category_id);
        $sliders=  $category->sliders;
        foreach ($sliders as $slider){
            $slider->product;
            $slider->category;
        }
        return $this->ApiResponce($sliders) ;
    }
}
