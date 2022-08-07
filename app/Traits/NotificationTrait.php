<?php

namespace App\Traits;

use App\Dept;
use App\Notify;
use App\Notify_user;
use App\Offer_point;
use App\Option;
use App\Order;
use App\User;
use Illuminate\Support\Facades\DB;

trait NotificationTrait
{
    public function checkNotify($order)
    {
        $order = Order::findOrFail($order);
        $store = $order->store()->get()->first();

        /*
         * Check First If The User Have Notify On Store
         */
        $user_notify = $store->notify;
        if (!is_null($user_notify)) {
            /*
             * Check first if the notify in date or not
             */
            $notify = $store->notify;
            if ($notify->from <= now() && $notify->to >= now()) {
                $user_notify = $notify->notify_users->where('user_id', $order->user_id)->first();;
                if (!empty($user_notify)) {
                    /*
                     * There Is A User Notify For The
                     * Check if the User Notify working for this order
                     */
                    // get the price of Min Total
                    $price_min = 0;
                    $price_total = 0;
                    foreach ($order->order_units as $index => $unit) {


                        // start calculating product price

                        $product = $unit->product;
                        $price_of_total = 0;
                        $price_of_unit = 0;

                        if ($product->discount_total != 0) {
                            $price_of_total = ($product->price_total - $product->discount_total);

                        } else {
                            $price_of_total = $product->price_total;

                        }
                        if ($product->discount_unit != 0) {
                            $price_of_unit = ($product->price_unit - $product->discount_unit);

                        } else {
                            $price_of_unit = $product->price_unit;

                        }

                        // end calculating product price


                        // Check if the unit is in the Offer Or not
                        $check_unit = $user_notify->notify_user_units()->where('product_id', $unit->product->id)->get()->first();
                        if (!is_null($check_unit)) {
                            /*
                             * Add total price sum and unit price sum to the $price_total & $price_min
                             */
                            $product_info = $unit->product->infos()->wherePivot('store_id', '=', $order->store->id)->get()->first();

                            $price_total += $unit->receive_total * $price_of_total;
                            $price_min += $unit->receive_unit * $price_of_unit;
                        }
                    }
                    $return['notify'] = $user_notify;
                    if ($user_notify->notify->min_total <= $price_total) {
                        $return['min_total'] = true;
                    } else {
                        $return['min_total'] = false;
                    }
                    if ($user_notify->notify->min_unit <= $price_min) {
                        $return['min_unit'] = true;
                    } else {
                        $return['min_unit'] = false;
                    }
                    return $return;
                }

            }
        }
        /*-----------------------------------------------------------------------------------------------------------*/
        /*
         * Check If The User Have Notify On Global
         */
        $global_notify = Notify::where('store_id', 0)->get()->first();
        $user_notify = $global_notify;
        if (!is_null($user_notify)) {
            /*
             * Check first if the notify in date or not
             */
            $notify = $global_notify;
            if ($notify->from <= now() && $notify->to >= now()) {
                $user_notify = $notify->notify_users->where('user_id', $order->user_id)->first();;
                if (!empty($user_notify)) {
                    /*
                     * There Is A User Notify For The
                     * Check if the User Notify working for this order
                     */
                    // get the price of Min Total
                    $price_min = 0;
                    $price_total = 0;
                    foreach ($order->order_units as $index => $unit) {


                        // start calculating product price

                        $product = $unit->product;
                        $price_of_total = 0;
                        $price_of_unit = 0;

                        if ($product->discount_total != 0) {
                            $price_of_total = ($product->price_total - $product->discount_total);

                        } else {
                            $price_of_total = $product->price_total;

                        }
                        if ($product->discount_unit != 0) {
                            $price_of_unit = ($product->price_unit - $product->discount_unit);

                        } else {
                            $price_of_unit = $product->price_unit;

                        }

                        // end calculating product price


                        // Check if the unit is in the Offer Or not
                        $check_unit = $user_notify->notify_user_units()->where('product_id', $unit->product->id)->get()->first();
                        if (!is_null($check_unit)) {
                            /*
                             * Add total price sum and unit price sum to the $price_total & $price_min
                             */
                            $product_info = $unit->product->infos()->wherePivot('store_id', '=', $order->store->id)->get()->first();
//                    dd($product_info);
                            $price_total += $unit->receive_total * $price_of_total;
                            $price_min += $unit->receive_unit * $price_of_unit;
                        }
                    }
                    $return['notify'] = $user_notify;
                    if ($user_notify->notify->min_total <= $price_total) {
                        $return['min_total'] = true;
                    } else {
                        $return['min_total'] = false;
                    }
                    if ($user_notify->notify->min_unit <= $price_min) {
                        $return['min_unit'] = true;
                    } else {
                        $return['min_unit'] = false;
                    }
                    return $return;
                }

            }
        }
        /*-----------------------------------------------------------------------------------------------------------*/
        /*
         * Check If The Store Have Notify
         */
        $store = $order->store()->get()->first();
        $notify = $store->notify;
        if (!is_null($notify)) {
            /*
             * Check first if the notify in date or not
             */
            if ($notify->from <= now() && $notify->to >= now()) {
                /*
                 * There Is A User Notify For The
                 * Check if the User Notify working for this order
                 */
                // get the price of Min Total
                $price_min = 0;
                $price_total = 0;
                foreach ($order->order_units as $index => $unit) {

                    // start calculating product price

                    $product = $unit->product;
                    $price_of_total = 0;
                    $price_of_unit = 0;

                    if ($product->discount_total != 0) {
                        $price_of_total = ($product->price_total - $product->discount_total);

                    } else {
                        $price_of_total = $product->price_total;

                    }
                    if ($product->discount_unit != 0) {
                        $price_of_unit = ($product->price_unit - $product->discount_unit);

                    } else {
                        $price_of_unit = $product->price_unit;

                    }

                    // end calculating product price


                    // Check if the unit is in the Offer Or not
                    $check_unit = $notify->notify_units()->where('product_id', $unit->product->id)->get()->first();
                    if (!is_null($check_unit)) {
                        /*
                         * Add total price sum and unit price sum to the $price_total & $price_min
                         */
                        $product_info = $unit->product->infos()->wherePivot('store_id', '=', $order->store->id)->get()->first();
                        $price_total += $unit->receive_total * $price_of_total;
                        $price_min += $unit->receive_unit * $price_of_unit;
                    }
                }
                $return['notify'] = $notify;
                if ($notify->min_total <= $price_total) {
                    $return['min_total'] = true;
                } else {
                    $return['min_total'] = false;
                }
                if ($notify->min_unit <= $price_min) {
                    $return['min_unit'] = true;
                } else {
                    $return['min_unit'] = false;
                }
                return $return;
            }
        }
        /*-----------------------------------------------------------------------------------------------------------*/
        /*
         * Check If The Global Have Notify
         */
        $notify = Notify::where('store_id', 0)->get()->first();
        if (!is_null($notify)) {
            /*
             * Check first if the notify in date or not
             */
            if ($notify->from <= now() && $notify->to >= now()) {
                /*
                 * There Is A User Notify For The
                 * Check if the User Notify working for this order
                 */
                // get the price of Min Total
                $price_min = 0;
                $price_total = 0;
                foreach ($order->order_units as $index => $unit) {

                    // start calculating product price

                    $product = $unit->product;
                    $price_of_total = 0;
                    $price_of_unit = 0;

                    if ($product->discount_total != 0) {
                        $price_of_total = ($product->price_total - $product->discount_total);

                    } else {
                        $price_of_total = $product->price_total;

                    }
                    if ($product->discount_unit != 0) {
                        $price_of_unit = ($product->price_unit - $product->discount_unit);

                    } else {
                        $price_of_unit = $product->price_unit;

                    }

                    // end calculating product price

                    // Check if the unit is in the Offer Or not
                    $check_unit = $notify->notify_units()->where('product_id', $unit->product->id)->get()->first();
                    if (!is_null($check_unit)) {
                        /*
                         * Add total price sum and unit price sum to the $price_total & $price_min
                         */
                        $product_info = $unit->product->infos()->wherePivot('store_id', '=', $order->store->id)->get()->first();
                        $price_total += $unit->receive_total * $price_of_total;
                        $price_min += $unit->receive_unit * $price_of_unit;
                    }
                }
                $return['notify'] = $notify;
                if ($notify->min_total <= $price_total) {
                    $return['min_total'] = true;
                } else {
                    $return['min_total'] = false;
                }
                if ($notify->min_unit <= $price_min) {
                    $return['min_unit'] = true;
                } else {
                    $return['min_unit'] = false;
                }
                return $return;
            }
        }
        /*-----------------------------------------------------------------------------------------------------------*/
        /*
         * No Notify For User
         */
        $return['notify'] = false;
        return $return;
    }

    /*
     * This function Calculate the total
     */
    public function getTotalDiscount($notify, $order)
    {
        /*
         * Get The Sell price percentage for Total & Unit for Order Units
         */
        $revenue = array();
        foreach ($order->order_units as $index => $unit) {
            $product_info = $unit->product->infos()->wherePivot('store_id', '=', $order->store->id)->get()->first();
            $product_id = $product_info->products()->get()->first()->id;
            $revenue[$product_id]['sp_unit_percentage'] = $product_info->sp_unit_percentage;
            $revenue[$product_id]['sp_total_percentage'] = $product_info->sp_total_percentage;
            $revenue[$product_id]['total_discount_now'] = 0;
            $revenue[$product_id]['total_discount_later'] = 0;
            $revenue[$product_id]['unit_discount_now'] = 0;
            $revenue[$product_id]['unit_discount_later'] = 0;
        }
        /*
         * Apply The Store Notify
         */
        if (is_a($notify['notify'], 'App\Notify')) {
            if ($notify['notify']) {
                /*
                 *
                 */
                if ($notify['min_total']) {
                    foreach ($notify['notify']->notify_units as $unit) {
                        if (array_key_exists($unit->product->id, $revenue)) {
                            $revenue[$unit->product->id]['total_discount_now'] += $unit->now_total;
                            $revenue[$product_id]['total_discount_later'] += $unit->later_total;
                        }
                    }
                }
                if ($notify['min_unit']) {
                    foreach ($notify['notify']->notify_units as $unit) {
                        if (array_key_exists($unit->product->id, $revenue)) {
                            $revenue[$product_id]['unit_discount_now'] += $unit->now_unit;
                            $revenue[$unit->product->id]['unit_discount_later'] += $unit->later_unit;
                        }
                    }
                }
            }
        } else {
            /*
             * Apply User Norify
             */
            if ($notify['notify']) {
                /*
                 *
                 */
                if ($notify['min_total']) {
                    foreach ($notify['notify']->notify_user_units as $unit) {
                        if (array_key_exists($unit->product->id, $revenue)) {
                            $revenue[$unit->product->id]['total_discount_now'] += $unit->now_total;
                            $revenue[$product_id]['total_discount_later'] += $unit->later_total;
                        }
                    }
                }
                if ($notify['min_unit']) {
                    foreach ($notify['notify']->notify_user_units as $unit) {
                        if (array_key_exists($unit->product->id, $revenue)) {
                            $revenue[$product_id]['unit_discount_now'] += $unit->now_unit;
                            $revenue[$unit->product->id]['unit_discount_later'] += $unit->later_unit;
                        }
                    }
                }
            }
        }
        return $revenue;
    }

    /*
     * Calculate Total Discount
     */
    public function calculateTotal($order_id, $revenue, $notify)
    {
        $order = Order::find($order_id);
        // get the price of Min Total
        $total_discount_now = 0;
        $total_discount_later = 0;
        $unit_discount_now = 0;
        $unit_discount_later = 0;
        foreach ($order->order_units as $index => $unit) {

            // start calculating product price

            $product = $unit->product;
            $price_of_total = 0;
            $price_of_unit = 0;

            if ($product->discount_total != 0) {
                $price_of_total = ($product->price_total - $product->discount_total);

            } else {
                $price_of_total = $product->price_total;

            }
            if ($product->discount_unit != 0) {
                $price_of_unit = ($product->price_unit - $product->discount_unit);

            } else {
                $price_of_unit = $product->price_unit;

            }

            // end calculating product price

            $product_info = $unit->product->infos()->wherePivot('store_id', '=', $order->store->id)->get()->first();
            if (!empty($revenue[$product_info->products->first()->id])) {
                $per = $revenue[$product_info->products->first()->id];
                if ($per['total_discount_now'] != 0) {
                    // $total_discount_now+= $unit->receive_total * ($product_info->buy_price * ($per['total_discount_now']/100));
                    $total_discount_now += ($unit->receive_total * $price_of_total) * ($notify['min_total'] * ($per['total_discount_now'] / 100));
                }
                if ($per['total_discount_later'] != 0) {
                    // $total_discount_later+= $unit->receive_total * ($product_info->buy_price * ($per['total_discount_later']/100));
                    $total_discount_later += ($unit->receive_total * $price_of_total) * ($notify['min_total'] * ($per['total_discount_later'] / 100));
                }
                if ($per['unit_discount_now'] != 0) {
                    // $unit_discount_now+= $unit->receive_unit * $price_of_total;
                    $unit_discount_now += ($unit->receive_unit * $price_of_unit) * ($notify['min_unit'] * ($per['unit_discount_now'] / 100));
                }
                if ($per['unit_discount_later'] != 0) {
                    // $unit_discount_later+= $unit->receive_unit * $price_of_unit;
                    $unit_discount_later += ($unit->receive_unit * $price_of_unit) * ($notify['min_unit'] * ($per['unit_discount_later'] / 100));
                }
            }
        }
        $discount['total_discount_now'] = $total_discount_now;
        $discount['total_discount_later'] = $total_discount_later;
        $discount['unit_discount_now'] = $unit_discount_now;
        $discount['unit_discount_later'] = $unit_discount_later;
        return $discount;
    }


    /*
     * Same Functions But While The User Do Orders
     * ----------------------------------------------------------------------------------------------------------------
     */
    public function preCheckNotify($order)
    {

        $order = Order::findOrFail($order);
        $store = $order->store;

        /*
         * Check First If The User Have Notify On Store
         */
        $user_notify = $store->notify;
        if (!is_null($user_notify)) {
            /*
             * Check first if the notify in date or not
             */
            $notify = $store->notify;
            if ($notify->from <= now() && $notify->to >= now()) {
                $user_notify = $notify->notify_users->where('user_id', $order->user_id)->first();;
                if (!empty($user_notify)) {
                    /*
                     * There Is A User Notify For The
                     * Check if the User Notify working for this order
                     */
                    // get the price of Min Total
                    $price_min = 0;
                    $price_total = 0;
                    foreach ($order->order_units as $index => $unit) {

                        // start calculating product price

                        $product = $unit->product;
                        $price_of_total = 0;
                        $price_of_unit = 0;

                        if ($product->discount_total != 0) {
                            $price_of_total = ($product->price_total - $product->discount_total);

                        } else {
                            $price_of_total = $product->price_total;

                        }
                        if ($product->discount_unit != 0) {
                            $price_of_unit = ($product->price_unit - $product->discount_unit);

                        } else {
                            $price_of_unit = $product->price_unit;

                        }

                        // end calculating product price

                        // Check if the unit is in the Offer Or not
                        $check_unit = $user_notify->notify_user_units()->where('product_id', $unit->product->id)->get()->first();
                        if (!is_null($check_unit)) {
                            /*
                             * Add total price sum and unit price sum to the $price_total & $price_min
                             */
                            $product_info = $unit->product->infos()->wherePivot('store_id', '=', $order->store->id)->get()->first();
                            $price_total += $unit->quantity_total * $price_of_total;
                            $price_min += $unit->quantity_unit * $price_of_unit;
                        }
                    }
                    $return['notify'] = $user_notify;
                    if ($user_notify->notify->min_total <= $price_total) {
                        $return['min_total'] = true;
                    } else {
                        $return['min_total'] = false;
                    }
                    if ($user_notify->notify->min_unit <= $price_min) {
                        $return['min_unit'] = true;
                    } else {
                        $return['min_unit'] = false;
                    }
                    return $return;
                }

            }
        }
        /*-----------------------------------------------------------------------------------------------------------*/
        /*
         * Check If The User Have Notify On Global
         */
        $global_notify = Notify::where('store_id', 0)->get()->first();
        $user_notify = $global_notify;
        if (!is_null($user_notify)) {
            /*
             * Check first if the notify in date or not
             */
            $notify = $global_notify;
            if ($notify->from <= now() && $notify->to >= now()) {
                $user_notify = $notify->notify_users->where('user_id', $order->user_id)->first();;
                if (!empty($user_notify)) {
                    /*
                     * There Is A User Notify For The
                     * Check if the User Notify working for this order
                     */
                    // get the price of Min Total
                    $price_min = 0;
                    $price_total = 0;
                    foreach ($order->order_units as $index => $unit) {

                        // start calculating product price

                        $product = $unit->product;
                        $price_of_total = 0;
                        $price_of_unit = 0;

                        if ($product->discount_total != 0) {
                            $price_of_total = ($product->price_total - $product->discount_total);

                        } else {
                            $price_of_total = $product->price_total;

                        }
                        if ($product->discount_unit != 0) {
                            $price_of_unit = ($product->price_unit - $product->discount_unit);

                        } else {
                            $price_of_unit = $product->price_unit;

                        }

                        // end calculating product price

                        // Check if the unit is in the Offer Or not
                        $check_unit = $user_notify->notify_user_units()->where('product_id', $unit->product->id)->get()->first();
                        if (!is_null($check_unit)) {
                            /*
                             * Add total price sum and unit price sum to the $price_total & $price_min
                             */
                            $product_info = $unit->product->infos()->wherePivot('store_id', '=', $order->store->id)->get()->first();
//                    dd($product_info);
                            $price_total += $unit->quantity_total * $price_of_total;
                            $price_min += $unit->quantity_unit * $price_of_unit;
                        }
                    }
                    $return['notify'] = $user_notify;
                    if ($user_notify->notify->min_total <= $price_total) {
                        $return['min_total'] = true;
                    } else {
                        $return['min_total'] = false;
                    }
                    if ($user_notify->notify->min_unit <= $price_min) {
                        $return['min_unit'] = true;
                    } else {
                        $return['min_unit'] = false;
                    }
                    return $return;
                }

            }
        }
        /*-----------------------------------------------------------------------------------------------------------*/
        /*
         * Check If The Store Have Notify
         */
        $store = $order->store;
        $notify = $store->notify;
        if (!is_null($notify)) {
            /*
             * Check first if the notify in date or not
             */
            if ($notify->from <= now() && $notify->to >= now()) {
                /*
                 * There Is A User Notify For The
                 * Check if the User Notify working for this order
                 */
                // get the price of Min Total
                $price_min = 0;
                $price_total = 0;
                foreach ($order->order_units as $index => $unit) {

                    // start calculating product price

                    $product = $unit->product;
                    $price_of_total = 0;
                    $price_of_unit = 0;

                    if ($product->discount_total != 0) {
                        $price_of_total = ($product->price_total - $product->discount_total);

                    } else {
                        $price_of_total = $product->price_total;

                    }
                    if ($product->discount_unit != 0) {
                        $price_of_unit = ($product->price_unit - $product->discount_unit);

                    } else {
                        $price_of_unit = $product->price_unit;

                    }

                    // end calculating product price

                    // Check if the unit is in the Offer Or not
                    $check_unit = $notify->notify_units()->where('product_id', $unit->product->id)->get()->first();
                    if (!is_null($check_unit)) {
                        /*
                         * Add total price sum and unit price sum to the $price_total & $price_min
                         */
                        $product_info = $unit->product->infos()->wherePivot('store_id', '=', $order->store->id)->get()->first();
                        $price_total += $unit->quantity_total * $price_of_total;
                        $price_min += $unit->quantity_unit * $price_of_unit;
                    }
                }
                $return['notify'] = $notify;
                if ($notify->min_total <= $price_total) {
                    $return['min_total'] = true;
                } else {
                    $return['min_total'] = false;
                }
                if ($notify->min_unit <= $price_min) {
                    $return['min_unit'] = true;
                } else {
                    $return['min_unit'] = false;
                }
                return $return;
            }
        }
        /*-----------------------------------------------------------------------------------------------------------*/
        /*
         * Check If The Global Have Notify
         */
        $notify = Notify::where('store_id', 0)->get()->first();
        if (!is_null($notify)) {
            /*
             * Check first if the notify in date or not
             */
            if ($notify->from <= now() && $notify->to >= now()) {
                /*
                 * There Is A User Notify For The
                 * Check if the User Notify working for this order
                 */
                // get the price of Min Total
                $price_min = 0;
                $price_total = 0;
                foreach ($order->order_units as $index => $unit) {

                    // start calculating product price

                    $product = $unit->product;
                    $price_of_total = 0;
                    $price_of_unit = 0;

                    if ($product->discount_total != 0) {
                        $price_of_total = ($product->price_total - $product->discount_total);

                    } else {
                        $price_of_total = $product->price_total;

                    }
                    if ($product->discount_unit != 0) {
                        $price_of_unit = ($product->price_unit - $product->discount_unit);

                    } else {
                        $price_of_unit = $product->price_unit;

                    }

                    // end calculating product price

                    // Check if the unit is in the Offer Or not
                    $check_unit = $notify->notify_units()->where('product_id', $unit->product->id)->get()->first();
                    if (!is_null($check_unit)) {
                        /*
                         * Add total price sum and unit price sum to the $price_total & $price_min
                         */
                        $product_info = $unit->product->infos()->wherePivot('store_id', '=', $order->store->id)->get()->first();
                        $price_total += $unit->quantity_total * $price_of_total;
                        $price_min += $unit->quantity_unit * $price_of_unit;
                    }
                }
                $return['notify'] = $notify;
                if ($notify->min_total <= $price_total) {
                    $return['min_total'] = true;
                } else {
                    $return['min_total'] = false;
                }
                if ($notify->min_unit <= $price_min) {
                    $return['min_unit'] = true;
                } else {
                    $return['min_unit'] = false;
                }
                return $return;
            }
        }
        /*-----------------------------------------------------------------------------------------------------------*/
        /*
         * No Notify For User
         */
        $return['notify'] = false;
        return $return;
    }

    /*
     * This function Calculate the total
     */
    public function preGetTotalDiscount($notify, $order)
    {
        /*
         * Get The Sell price percentage for Total & Unit for Order Units
         */
        $revenue = array();
        foreach ($order->order_units as $index => $unit) {
            $product_info = $unit->product->infos()->wherePivot('store_id', '=', $order->store->id)->get()->first();
            $product_id = $product_info->products()->get()->first()->id;
            $revenue[$product_id]['sp_unit_percentage'] = $product_info->sp_unit_percentage;
            $revenue[$product_id]['sp_total_percentage'] = $product_info->sp_total_percentage;
            $revenue[$product_id]['total_discount_now'] = 0;
            $revenue[$product_id]['total_discount_later'] = 0;
            $revenue[$product_id]['unit_discount_now'] = 0;
            $revenue[$product_id]['unit_discount_later'] = 0;
        }
        /*
         * Apply The Store Notify
         */
        if (is_a($notify['notify'], 'App\Notify')) {
            if ($notify['notify']) {
                /*
                 *
                 */
                if ($notify['min_total']) {
                    foreach ($notify['notify']->notify_units as $unit) {
                        if (array_key_exists($unit->product->id, $revenue)) {
                            $revenue[$unit->product->id]['total_discount_now'] += $unit->now_total;
                            $revenue[$product_id]['total_discount_later'] += $unit->later_total;
                        }
                    }
                }
                if ($notify['min_unit']) {
                    foreach ($notify['notify']->notify_units as $unit) {
                        if (array_key_exists($unit->product->id, $revenue)) {
                            $revenue[$product_id]['unit_discount_now'] += $unit->now_unit;
                            $revenue[$unit->product->id]['unit_discount_later'] += $unit->later_unit;
                        }
                    }
                }
            }
        } else {
            /*
             * Apply User Norify
             */
            if ($notify['notify']) {
                /*
                 *
                 */
                if ($notify['min_total']) {
                    foreach ($notify['notify']->notify_user_units as $unit) {
                        if (array_key_exists($unit->product->id, $revenue)) {
                            $revenue[$unit->product->id]['total_discount_now'] += $unit->now_total;
                            $revenue[$product_id]['total_discount_later'] += $unit->later_total;
                        }
                    }
                }
                if ($notify['min_unit']) {
                    foreach ($notify['notify']->notify_user_units as $unit) {
                        if (array_key_exists($unit->product->id, $revenue)) {
                            $revenue[$product_id]['unit_discount_now'] += $unit->now_unit;
                            $revenue[$unit->product->id]['unit_discount_later'] += $unit->later_unit;
                        }
                    }
                }
            }
        }
        return $revenue;
    }

    /*
     * Calculate Total Discount
     */
    public function preCalculateTotal($order_id, $revenue)
    {
        $order = Order::find($order_id);
        // get the price of Min Total
        $total_discount_now = 0;
        $total_discount_later = 0;
        $unit_discount_now = 0;
        $unit_discount_later = 0;
        foreach ($order->order_units as $index => $unit) {

            // start calculating product price

            $product = $unit->product;
            $price_of_total = 0;
            $price_of_unit = 0;

            if ($product->discount_total != 0) {
                $price_of_total = ($product->price_total - $product->discount_total);

            } else {
                $price_of_total = $product->price_total;

            }
            if ($product->discount_unit != 0) {
                $price_of_unit = ($product->price_unit - $product->discount_unit);

            } else {
                $price_of_unit = $product->price_unit;

            }

            // end calculating product price


            $product_info = $unit->product->infos()->wherePivot('store_id', '=', $order->store->id)->get()->first();

            $per = $revenue[$product_info->products->first()->id];
            $total_discount_now += $unit->quantity_total * ($product_info->buy_price * ($per['total_discount_now'] / 100));

            $total_discount_later += $unit->quantity_total * ($product_info->buy_price * ($per['total_discount_later'] / 100));

            $unit_discount_now += $unit->quantity_unit * $price_of_total;

            $unit_discount_later += $unit->quantity_unit * $price_of_unit;
        }
        $discount['total_discount_now'] = $total_discount_now;
        $discount['total_discount_later'] = $total_discount_later;
        $discount['unit_discount_now'] = $unit_discount_now;
        $discount['unit_discount_later'] = $unit_discount_later;
        return $discount;
    }

    /*
     * Get Cash Back
     */
    public function getCashBack($user_id)
    {
        if (Option::find(4)->is_active) {
            $user = User::findOrFail($user_id);
            $depts = $user->depts()->where('status', '=', 0)->whereColumn('depts.total', '>', 'depts.paid')->sum(DB::raw('total-paid'));
            return $depts;
        } else {
            return false;
        }
    }

    // cash back of current order
    public function getCashBackOfCurrentOrderId($user_id, $order_id)
    {
        if (Option::find(4)->is_active) {
            $user = User::findOrFail($user_id);
            $depts = $user->depts()->where('order_id', '=', $order_id)->where('status', '=', 0)->whereColumn('depts.total', '>', 'depts.paid')->sum(DB::raw('total-paid'));
            return $depts;
        } else {
            return false;
        }
    }

    // cash back of all user orders except current order
    public function getCashBackOfAllExceptWithOrderId($user_id, $order_id)
    {
        if (Option::find(4)->is_active) {
            $user = User::findOrFail($user_id);
            $depts = $user->depts()->where('order_id', '!=', $order_id)->where('status', '=', 0)->whereColumn('depts.total', '>', 'depts.paid')->sum(DB::raw('total-paid'));
            return $depts;
        } else {
            return false;
        }
    }

    /*
     * Confirm offer points
     */
    public function confirmOfferPoints(Order $order)
    {
        $user = $order->user;
        $offer_point = Offer_point::where('total', '<=', $order->paid_value)->orderBy('total', 'DESC')->LIMIT(1)->get();
        if (!$offer_point->isEmpty()) {
            $user->update([
                'points' => $user->points + $offer_point->points
            ]);
            return $offer_point;
        }
        return false;
    }

    /*
     * Check Offer Total While User Make Order
     */
    public function checkOfferTotal(Order $order)
    {
        $notify = $order->store->notify_total;
        if (!$notify == null) {
            /*
             * Check first if the notify in date or not
             */
            if ($notify->from <= now() && $notify->to >= now()) {
                // get the price of Min Total & Min Unit
                $price_min = 0;
                $price_total = 0;
                foreach ($order->order_units as $index => $unit) {


                    // start calculating product price

                    $product = $unit->product;
                    $price_of_total = 0;
                    $price_of_unit = 0;

                    if ($product->discount_total != 0) {
                        $price_of_total = ($product->price_total - $product->discount_total);

                    } else {
                        $price_of_total = $product->price_total;

                    }
                    if ($product->discount_unit != 0) {
                        $price_of_unit = ($product->price_unit - $product->discount_unit);

                    } else {
                        $price_of_unit = $product->price_unit;

                    }

                    // end calculating product price

                    // Check if the unit is in the Offer Or not
                    if (!$notify->products->contains($unit->product->id)) {
                        /*
                         * Add total price sum and unit price sum to the $price_total & $price_min
                         */
                        $product_info = $unit->product->infos()->wherePivot('store_id', '=', $order->store->id)->get()->first();

                        $price_total += $unit->quantity_total * $price_of_total;
                        $price_min += $unit->quantity_unit * $price_of_unit;
                    }
                }
                $return['notify'] = $notify;
                if ($notify->min_total <= $price_total) {
                    $return['min_total'] = true;
                    $return['percentage_total'] = $notify->percentage_total;
                } else {
                    $return['min_total'] = false;
                }
                if ($notify->min_unit <= $price_min) {
                    $return['min_unit'] = true;
                    $return['percentage_unit'] = $notify->percentage_unit;
                } else {
                    $return['min_unit'] = false;
                }
                return $return;
            }
        }
        $return = [];
        return $return;

    }

    /*
     * Check Offer Total
     */
    public function checkOfferTotalFinal(Order $order)
    {
        $notify = $order->store->notify_total;
        /*
         * Check first if the notify in date or not
         */
        if (!$notify == null) {
            if ($notify->from <= now() && $notify->to >= now()) {

                // get the price of Min Total & Min Unit
                $price_min = 0;
                $price_total = 0;
                foreach ($order->order_units as $index => $unit) {

                    // start calculating product price

                    $product = $unit->product;
                    $price_of_total = 0;
                    $price_of_unit = 0;

                    if ($product->discount_total != 0) {
                        $price_of_total = ($product->price_total - $product->discount_total);

                    } else {
                        $price_of_total = $product->price_total;

                    }
                    if ($product->discount_unit != 0) {
                        $price_of_unit = ($product->price_unit - $product->discount_unit);

                    } else {
                        $price_of_unit = $product->price_unit;

                    }

                    // end calculating product price

                    // Check if the unit is in the Offer Or not
                    if (!$notify->products->contains($unit->product->id)) {
                        /*
                         * Add total price sum and unit price sum to the $price_total & $price_min
                         */
                        $product_info = $unit->product->infos()->wherePivot('store_id', '=', $order->store->id)->get()->first();

                        $price_total += $unit->receive_total * $price_of_total;
                        $price_min += $unit->receive_unit * $price_of_unit;
                    }
                }
                $return['notify'] = $notify;
                if ($notify->min_total <= $price_total) {
                    $return['min_total'] = true;
                    $return['total_minus'] = $price_total - ($price_total * $notify->percentage_total / 100);
                    $return['percentage_total'] = $notify->percentage_total;

                } else {
                    $return['min_total'] = false;
                }
                if ($notify->min_unit <= $price_min) {
                    $return['min_unit'] = true;
                    $return['unit_minus'] = $price_min - ($price_min * $notify->percentage_unit / 100);
                    $return['percentage_unit'] = $notify->percentage_unit;
                } else {
                    $return['min_unit'] = false;
                }
                return $return;
            } else {
                $return['min_unit'] = false;
                $return['min_total'] = false;
                return $return;
            }
        } else {
            $return['min_unit'] = false;
            $return['min_total'] = false;
            return $return;
        }
        $return = [];
        return $return;
    }
}
