<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static find(mixed $id)
 */
class Info extends Model
{
    protected $fillable = [
        'quantity',
        'quantity_unit',
        'lower_limit',
        'max_limit',
        'first_period',
        'reorder_limit',
        'buy_price',
        'sp_unit_percentage',
        'sp_total_percentage',
        'loss',
        'sell_unit_original',
        'sell_total',
        'sp_unit_LE',
        'sp_total_LE',
    ];
    protected $appends = [
        'sell_total',
        'sell_unit_original',
        // 'buy_unit_original'
    ];

    public function products(){
        return $this->belongsToMany(Product::class)->withPivot('store_id');
    }
    
    public function store(){
        return $this->belongsToMany(Store::class)->withPivot('store_id');
    }
    
    // public function info_products(){
    //     return $this->belongsToMany(InfoProduct::class);
    // }
    
    public function info_expirations(){
        return $this->hasMany(Info_Expiration::class , 'info_id');
    }
    
    public function sell_unit(Product $product){
        $num = (($this->sp_unit_percentage * $this->buy_price)/100 + $this->buy_price)/$product->quantity_unit;
        $num = $num *4;
        $num = round($num);
        return $num/4;
    }
    public function getSellUnitOriginalAttribute(){
        $num =  ($this->sp_unit_percentage * $this->buy_price)/100 + $this->buy_price;
        $num = $num *4;
        $num = round($num);
        return $num/4;
    }
    
    // public function getBuyUnitOriginalAttribute(){
    //     $num =  ($this->sp_unit_percentage * $this->buy_price)/100 + $this->buy_price;
    //     $num =  ($this->buy_price)/100 + $this->buy_price;
    //     $num = $num *4;
    //     $num = round($num);
    //     return $num/4;
    // }
    
    
    public function getSellTotalAttribute(){
        $num = ($this->sp_total_percentage * $this->buy_price)/100 + $this->buy_price;
        $num = $num *4;
        $num = round($num);
        return $num/4;
    }



}
