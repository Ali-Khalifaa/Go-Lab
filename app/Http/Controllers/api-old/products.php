<?php

namespace App\Http\Controllers\api;

use App\Company;
use App\Notify;
use App\Option;
use App\order_unit;
use App\Store;
use App\Subcategory;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Category;

class products extends Controller
{
    use ApiResponceTrait ;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (true) {
            return Product::all();
        }
    }

    public function store(Request $request)
    {
        return Product::create([

            'name' => $request['name'],
            'category_id' => $request['category_id'],
            'company_id' => $request['company_id'],
            'subcategory_d' => $request['subcategory_d'],
            'price' => $request['price'],
            'price_unit' => $request['price_unit'],
            'unit_type' => $request['unit_type'],
            'quantity_unit' => $request['quantity_unit'],
            'description' => $request['description'],
            'quantity' => $request['quantity'],
            'discount' => $request['discount'],
            'quantity_status' => $request['quantity_status'],
            'max_quantity' => $request['max_quantity'],
            'subunit_type' => $request['subunit_type'],
            'image' => $request['image'],
            'store_id' => $request['store_id'],
            'status' => $request['status'],
            'waiting_status' => $request['waiting_status'],
        ]);
    }

    public function show($id)
    {
        // if (true) {
        return Product::find($id);
        // }
    }

    public function update(Request $request )
    {
        $products = Product::findOrFail($request->id);
        $products->name = $request->name;
        $products->category_id = $request->category_id;
        $products->company_id = $request->company_id;
        $products->subcategory_id = $request->subcategory_id;
        $products->discount = $request->discount;
        $products->quantity = $request->quantity;
        $products->price = $request->price;
        $products->price_unit = $request->price_unit;
        $products->unit_type = $request->unit_type;
        $products->quantity_unit = $request->quantity_unit;
        $products->description = $request->description;
        $products->image = $request->image;
        $products->quantity_status = $request->quantity_status;
        $products->subunit_type = $request->subunit_type;
        $products->max_quantity = $request->max_quantity;
        $products->store_id = $request->store_id;
        $products->status = $request->status;
        $products->waiting_status = $request->waiting_status;
        $products->save();
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

    public function offers()
    {
        return Product::where('discount' , '!=' ,null)->get();

    }

    public function getProducts($store_id, $company_id){
        $store = Store::findOrFail($store_id);
        $products = $store->products()->where('company_id',$company_id)->where('is_hidden','=',0)->get();


        foreach ($products as $index => $product){
            $clone_product = $product->replicate();

            $product_customs = $product->infos()->wherePivot('store_id','=',$store_id)->get()->first();
            $product->quantity = $product_customs->quantity;
            $product->reorder_limit = $product_customs->reorder_limit;
            $product->sp_unit_percentage = $product_customs->sp_unit_percentage;
            $product->sp_total_percentage	 = $product_customs->sp_total_percentage;
            $product->buy_price = $product_customs->buy_price;
            $product->sp_unit_price =  $product_customs->sell_unit($clone_product);
            $product->sp_total_price =  $product_customs->sell_total;
        }

//        dd($products);
        return  $this->ApiResponce($products);

    }

   public function getStoreProducts($store_id, $user_id){
        /*
         * Get Store Products
         */
        $store = Store::findOrFail($store_id);
        $products = $store->products()->where('is_hidden','=',0)->get();
        foreach ($products as $index => $product){
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
            // $product->quantity_info = $product->quantity_info - $minus_total;
            // $product->quantity_unit_info = $product->quantity_unit_info - $minus_unit;

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
        }
        $data['products']= $products;
        $data['option'] = Option::findOrFail(1)->is_active;
        $check_store_notify = $store->notify()->get()->first();
        if(is_null($check_store_notify))
        {
            if (is_null(Notify::where('store_id', 0)->get()->first()))
            {
                $data['store_notify']=false;
                $data['option']=0;
            }
            else
            {
                $global_notify = Notify::where('store_id', 0)->get()->first();
                $data['store_notify'] = $global_notify;
                $data['store_notify']['units'] = $global_notify->notify_units()->get();
            }
        }
        else
        {
            $data['store_notify'] = $check_store_notify;
            $data['store_notify']['units'] = $check_store_notify->notify_units()->get();
        }
        return  $this->ApiResponce($data);
    }
    
    
    
    
       public function getStoreProductsV1($store_id, $user_id ,$search){
        /*
         * Get Store Products
         */
        if( $user_id==0 && $store_id==0 ){
        $store = Store::all()->first();
        $store_id=$store->id;
        }
        else{
        $store = Store::findOrFail($store_id);
        }
        // $store = Store::findOrFail($store_id);
        if($search=='all')
        {
        $products = $store->products()->where('is_hidden','=',0)->paginate(20);
        }
        else{
            $products = $store->products()->where('is_hidden','=',0)->where('name','like', '%'.$search.'%')->paginate(20);
        }
        foreach ($products as $index => $product){
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
            // $product->quantity_info = $product->quantity_info - $minus_total;
            // $product->quantity_unit_info = $product->quantity_unit_info - $minus_unit;
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
        }
        $data['products']= $products;
        $data['option'] = Option::findOrFail(1)->is_active;
        $check_store_notify = $store->notify()->get()->first();
        if(is_null($check_store_notify))
        {
            if (is_null(Notify::where('store_id', 0)->get()->first()))
            {
                $data['store_notify']=false;
                $data['option']=0;
            }
            else
            {
                $global_notify = Notify::where('store_id', 0)->get()->first();
                $data['store_notify'] = $global_notify;
                $data['store_notify']['units'] = $global_notify->notify_units()->get();
            }
        }
        else
        {
            $data['store_notify'] = $check_store_notify;
            $data['store_notify']['units'] = $check_store_notify->notify_units()->get();
        }
        return  $this->ApiResponce($data);
    }
    
    
    
    
    
    public function storeNotify ($store_id){
        
        if( $store_id==0 ){
        $store = Store::all()->first();
        $store_id=$store->id;
        }
        else{
        $store = Store::findOrFail($store_id);
        }
        
        $check_store_notify = $store->notify()->get()->first();
     
        if(is_null($check_store_notify))
        {
            if (is_null(Notify::where('store_id', 0)->get()->first()))
            {
                $data['store_notify']=false;
                $data['option']=0;
            }
            else
            {
                $global_notify = Notify::where('store_id', 0)->get()->first();
                $data['store_notify'] = $global_notify;
                $data['store_notify']['units'] = $global_notify->notify_units()->get();
            }
        }
        else
        {
            $data['store_notify'] = $check_store_notify;
            $data['store_notify']['units'] = $check_store_notify->notify_units()->get();
        }
        
        
        // return $data['store_notify']['units'];
        // dd($data['store_notify']['units']);
        
        if(Option::findOrFail(7)->is_active)
            {
                $data['show_banner']=true;
            }
            else
            {
                $data['show_banner']=false;
            }
        
        
        if($data['store_notify']!=null){
       if($data['store_notify']->to>= now())
       {
        foreach( $data['store_notify']['units'] as $unit )
        {
            // if($unit->product->is_hidden!=1){
                
            $product=$unit->product;
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
            // $product->quantity_info = $product->quantity_info - $minus_total;
            // $product->quantity_unit_info = $product->quantity_unit_info - $minus_unit;
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
            
            // }
            
        }
        return  $this->ApiResponce($data);
            
       }
            
        }
       $data['store_notify']=false;

        // return $data['store_notify']['units'];
        return  $this->ApiResponce($data,null,null,404);
    }
    
    
    

    
    public function getStoreProductsApple(){
        /*
         * Get Store Products
         */
         
         
         
         
        $store = Store::all()->first();
        // dd($store);
        $store_id=$store->id;
        $products = $store->products()->where('is_hidden','=',0)->paginate(20);
        foreach ($products as $index => $product){
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
            // $minus_unit = $order_units->sum('quantity_unit');
            // $product->quantity_info = $product->quantity_info - $minus_total;
            // $product->quantity_unit_info = $product->quantity_unit_info - $minus_unit;

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
        }
        $data['products']= $products;
        $data['option'] = Option::findOrFail(1)->is_active;
        $check_store_notify = $store->notify()->get()->first();
        if(is_null($check_store_notify))
        {
            if (is_null(Notify::where('store_id', 0)->get()->first()))
            {
                $data['store_notify']=false;
                $data['option']=0;
            }
            else
            {
                $global_notify = Notify::where('store_id', 0)->get()->first();
                $data['store_notify'] = $global_notify;
                $data['store_notify']['units'] = $global_notify->notify_units()->get();
            }
        }
        else
        {
            $data['store_notify'] = $check_store_notify;
            $data['store_notify']['units'] = $check_store_notify->notify_units()->get();
        }
        return  $this->ApiResponce($data);
    }
    
    
    
    

    
    /*
     *  get product by company & sub_category $ store
     */
    public function getProductsByCompanySubCategoryStore(Company $company,Subcategory $subcategory,Store $store){
        $store_id=$store->id;
        $products = $store->products()->where([
            ['company_id','=',$company->id],
            ['subcategory_id','=',$subcategory->id],
            ['is_hidden','=',0],
        ])->get();
        
            foreach ($products as $index => $product){
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
            // $product->quantity_info = $product->quantity_info - $minus_total;
            // $product->quantity_unit_info = $product->quantity_unit_info - $minus_unit;

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
        }
        
        return $products;
    }
    
    
    
    
    public function getProductsByCompanySubCategoryStoreApple(Company $company,Subcategory $subcategory,$store){
        if( $store==0 ){
        $store = Store::all()->first();
        $store_id=$store->id;
        }
        else{
        $store = Store::findOrFail($store);
        $store_id=$store->id;
        
        }
        // $store=Store::all()->first();
        // $store_id=$store->id;
        $products = $store->products()->where([
            ['company_id','=',$company->id],
            ['subcategory_id','=',$subcategory->id],
            ['is_hidden','=',0],
        ])->paginate(20);
        
            foreach ($products as $index => $product){
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
            // $product->quantity_info = $product->quantity_info - $minus_total;
            // $product->quantity_unit_info = $product->quantity_unit_info - $minus_unit;

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
        }
        
        
        return $products;
    }

    /*
     *  get product by company & category $ store
     */
    public function getProductsByCompanyCategoryStore(Company $company,Category $category,$store){
        if( $store==0 ){
        $store = Store::all()->first();
        $store_id=$store->id;
        }
        else{
        $store = Store::findOrFail($store);
        $store_id=$store->id;
        }
        $products = $store->products()->where([
            ['company_id','=',$company->id],
            ['category_id','=',$category->id],
            ['is_hidden','=',0],
        ])->get();
        return $products;
    }
    
    
    public function getProductsByCompany(Company $company , $store){
        
        if( $store==0 ){
        $store = Store::all()->first();
        $store_id=$store->id;
        }
        else{
        $store = Store::findOrFail($store);
        $store_id=$store->id;
        
        }
        
        $products = $company->products()->where('is_hidden','=',0)->paginate(20);
        
        
        
                    foreach ($products as $index => $product){
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
            // $product->quantity_info = $product->quantity_info - $minus_total;
            // $product->quantity_unit_info = $product->quantity_unit_info - $minus_unit;

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
        }
        
        
        
        
        return $products;
    }
    
    

    public function options(){
        return Option::all();
    }
}
