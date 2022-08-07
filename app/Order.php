<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, false|string $date)
 * @method static whereRaw(string $string, array $array)
 */
class Order extends Model
{
    protected $fillable = [
        'type',
        'invoice_type',
        'date_of_order',
        'price_total_sum',
        'price_unit_sum',
        'delivery_amount',
        'payment_type',
        'is_complete',
        'is_direct_sell',
        'date_of_receipt',
        'comment',
        'paid_value',
        'rest_value',
        'minus_notify',
        'cash_back',
        'total_minus_paid',
        'total_minus',
        'unit_minus',
        'user_id',
        'store_id',
        'mandob_id',
        'mondob_stage_id',
        'transfer_id',
        'order_stage_id',
        'direction_id',
        'min_total',
        'min_unit',
        'received_money',
        'is_canceled',
        'confirm_received_money',
        'received_money_from_f_m',
        'finance_manager_id',
        'seller_id',
        'received_direct_sell_money_from_f_m',
        'direct_sell_finance_manager_id',
        'confirm_delivery_receipt',
        'keeper_id',
        'direct_selle_keeper_id',
        'direct_selle_confirm_delivery_receipt',
        'has_recall',
        'recall_total_price',
        'recall_unit_price',
        'future_cash_back',
        'qema_modafa',
        'visa_amount',
        'fatora_dripa'
    ];
    protected $appends =[
        'total_price','recall_price'
    ];
    public function getTotalPriceAttribute(){
        return $this->price_total_sum + $this->price_unit_sum;
    }

    public function getRecallPriceAttribute(){
        return $this->recall_total_price ;
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function seller()
    {
        return $this->belongsTo('App\User','seller_id');
    }
    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function mandob()
    {
        return $this->belongsTo('App\Mandob');
    }
    public function order_units(){
        return $this->hasMany(order_unit::class);
    }
    public function order_stage(){
        return $this->belongsTo(Order_stage::class);
    }
    public function mandob_stage(){
        return $this->belongsTo(Mandob_stage::class , 'mondob_stage_id');
    }
    public function store(){
        return $this->belongsTo(Store::class);
    }
    public function out(){
        return $this->hasOne(Out::class);
    }
    public function in(){
        return $this->hasOne(In::class);
    }
    public function dept(){
        return $this->hasOne(Dept::class);
    }
    public function transfer(){
        return $this->belongsTo(Transfer::class);
    }
    public function direction(){
        return $this->belongsTo(Direction::class);
    }
    public function discount()
    {
        return $this->hasMany(Discount::class,'order_id');
    }
    public function promoCode()
    {
        return $this->hasOne(PromoCode::class,'order_id');
    }

    public function mongez()
    {
        return $this->hasOne(UserMongez::class,'order_id');
    }
}
