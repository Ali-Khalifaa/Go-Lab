<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name','name_en', 'category_id', 'company_id', 'subcategory_id','price', 'price_unit', 'discount',
        'price_total','price_unit','discount_total','discount_unit','is_unit',
        'quantity', 'unit_type','unit_type_en', 'quantity_unit', 'description','description_en', 'image','quantity_status','code',
        'max_quantity' ,'subunit_type','subunit_type_en', 'store_id', 'status', 'waiting_status','package_id','is_hidden','recently_arrived',
        'discount_type','date_end','rank_code'
    ];
    protected $appends = [
        'image_path',
        'price_after_discount',
        'discount_percentage',
        'end_offer',
        'deserved_price',
    ];

    //============== appends paths ===========

    //append img path

    public function getImagePathAttribute(): string
    {
        return asset('uploads/products/'.$this->image);
    }
    public function getDiscountTypeAttribute($value): int
    {
        if ($value== 0)
        {
            if ($this->company->discount_status == 1)
            {
                return 1;
            }else{
                return 0;
            }
        }else{
            return $value;
        }
    }
    public function getDeservedPriceAttribute(): string
    {
        if ($this->date_end >= now())
        {
            return $this->price_total - $this->discount_total;

        }else{
            if ($this->company->discount_status == 1)
            {
                return $this->price_total - (($this->price_total * $this->company->percentage) / 100);
            }else{
                return $this->price_total;
            }
        }
    }

    public function getPriceAfterDiscountAttribute(): string
    {
        if ($this->discount_type == 0)
        {
            return 0;
        }else{
            if ($this->date_end >= now()) {
                return $this->price_total - $this->discount_total;

            } elseif($this->company->discount_status == 1) {
                return $this->price_total - (($this->price_total * $this->company->percentage) / 100);
            }else{
                return 0;
            }
        }
    }
    public function getDiscountPercentageAttribute(): string
    {
        if ($this->discount_type == 0)
        {
            return 0;
        }else{
            if ($this->date_end >= now()) {
                return  ($this->price_total - $this->price_after_discount)/$this->price_total * 100 ;

            } elseif($this->company->discount_status == 1) {
                return $this->company->percentage;
            }else{
                return 0;
            }

        }
    }
    public function getEndOfferAttribute(): string
    {
        if ($this->date_end >= now())
        {
            return  now()->diffInDays($this->date_end,false);
        }else{
            if ($this->company->discount_status == 1){
                return 5;
            }else{
                return 0;
            }
        }
    }

    //relations

    public function productImages()
    {
        return $this->hasMany(\App\ProductImage::class);
    }
    public function company(){
        return $this->belongsTo(Company::class);
    }
    public function slider(){
        return $this->hasOne(Slider::class);
    }
    public function subcategory(){
        return $this->belongsTo(Subcategory::class);
    }
    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
    public function stores(){
        return $this->belongsToMany(Store::class);
    }
    public function infos(){
        return $this->belongsToMany(Info::class)->withPivot('store_id');
    }
    public function info(){
        return $this->belongsTo(Info::class);
    }
    public function order_unit(){
        return $this->hasMany(order_unit::class);
    }
    public function notify_units(){
        return $this->hasMany(order_unit::class);
    }
    public function users(){
        return $this->belongsToMany(User::class);
    }
    public function notify_totals(){
        return $this->belongsToMany(Notify_total::class);
    }
}
