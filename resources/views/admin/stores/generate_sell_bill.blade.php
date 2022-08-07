@extends('layouts.main')
@section('content')


    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <!--<h2>-->
        <!--    <span>#{{$order->id}}</span>-->
            <!--</h2>-->
            <div class="x_title">
                <ul class="nav navbar-right panel_toolbox">
                    <li>
                        <button onclick="window.print();" class="noPrint btn btn-success">
                            <i class="fa fa-print"></i>
                            إطبع
                        </button>
                    </li>
                    {{-- <li> <a href="{{ url('admin/orders/create') }}"> <i class="fa fa-plus"></i>اضافه</a></li>
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li> --}}
                </ul>
                <div class="clearfix"></div>

            </div>
            <div class="x_content">
                <div class="row">
                    @if($dept)
                        <div class="col-md-3 col-md-offset-3">
                            <table class="table table-condensed table-bordered">
                                <thead class="thead-light">
                                <tr>
                                    <th colspan="2" style="text-align: center">تفاصيل المكافأه الأجل</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{$dept->total}}</td>
                                    <td>القيمة</td>
                                </tr>
                                <tr>
                                    <td>{{$dept->date}}</td>
                                    <td>تاريخ التحصيل</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    @endif
                    <div class="col-md-3 {{!$dept?'col-md-offset-6':''}} ">
                        <table class="table table-condensed table-bordered">
                            <thead class="thead-light">
                            <th colspan="4" style="text-align: center">معلومات العميل</th>

                            </thead>
                            <thead>
                            <th style="text-align: center"> رقم التليفون</th>
                            <th style="text-align: center"> اسم المحل</th>
                            <th style="text-align: center"> العنوان</th>
                            <th style="text-align: center">الاسم</th>
                            </thead>

                            <tbody>

                            <td>{{$order->user->phone}}</td>
                            <td>{{$order->user->shop_name}}</td>
                            <td>{{$order->user->address}}</td>
                            <td>{{$order->user->name}}</td>

                            </tbody>
                        </table>

                        <table class="table table-condensed table-bordered">
                            <thead class="thead-light">
                            <th colspan="4" style="text-align: center">البياع</th>

                            </thead>
                            <tbody>
                            <td colspan="4" style="text-align: center">
                                {{ $order->seller?$order->seller->name:"----" }}
                            </td>
                            </tbody>

                        </table>
                    </div>
                    {{--                    <div class="col-md-3 ">--}}
                    {{--                        <table class="table table-condensed table-bordered">--}}
                    {{--                            <thead class="thead-light">--}}
                    {{--                            <tr>--}}
                    {{--                                <th colspan="2" style="text-align: center">معلومات المخزن</th>--}}
                    {{--                            </tr>--}}
                    {{--                            </thead>--}}
                    {{--                            <tbody>--}}
                    {{--                            <tr>--}}
                    {{--                                <td>{{$store->name}}</td>--}}
                    {{--                                <td>المخزن</td>--}}
                    {{--                            </tr>--}}
                    {{--                            <tr>--}}
                    {{--                                <td>{{$store->place->place}}</td>--}}
                    {{--                                <td>المنطقة</td>--}}
                    {{--                            </tr>--}}
                    {{--                            <tr>--}}
                    {{--                                <td>{{$order->store->store_keeper->name}}</td>--}}
                    {{--                                <td>امين المخزن</td>--}}
                    {{--                            </tr>--}}
                    {{--                            <tr>--}}
                    {{--                                <td>{{$store->address}}</td>--}}
                    {{--                                <td>عنوان المخزن</td>--}}
                    {{--                            </tr>--}}
                    {{--                            </tbody>--}}
                    {{--                        </table>--}}
                    {{--                    </div>--}}


                </div>
                <div class="x_content">

                    <table class="table table-striped">
                        <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>اسم المنتج</th>
                            <th> كميه الجملة المطلوبه</th>
{{--                            <th>المكافأه الجملة الفوري</th>--}}
{{--                            <th>المكافأه الجملة الاجل</th>--}}
{{--                            <th> كميه القطاعي المطلوبه</th>--}}
{{--                            <th>المكافأه القطاعي الفوري</th>--}}
{{--                            <th>المكافأه القطاعي الاجل</th>--}}
                            <th>سعر الوحده</th>
                            <th> الاجمالى</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php
                        $total = 0;
                        $unit = 0;
                        ?>
                        @foreach ($order_units as $i => $order_unit)
                            <?php
                            $total += $order_unit->quantity_total;
                            $unit += $order_unit->quantity_unit;
                            ?>
                            <tr>
                                <th scope="row">{{ ++$i }}</th>
                                <td>{{ $order_unit->product->name }}</td>
                                <td>
                                    ({{$order_unit->quantity_total?$order_unit->product->unit_type:''}})
                                    {{ $order_unit->quantity_total?$order_unit->quantity_total:"----" }}
                                </td>
{{--                                <td>--}}
{{--                                    @if($revenue)--}}
{{--                                        {{$revenue[$order_unit->product->id]['total_discount_now']}}%--}}
{{--                                    @endif--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    @if($revenue)--}}
{{--                                        {{$revenue[$order_unit->product->id]['total_discount_later']}}%--}}
{{--                                    @endif--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    ({{$order_unit->quantity_unit?$order_unit->product->subunit_type:''}})--}}
{{--                                    {{ $order_unit->quantity_unit?$order_unit->quantity_unit:"----" }}--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    @if($revenue)--}}
{{--                                        {{$revenue[$order_unit->product->id]['unit_discount_now']}}%--}}
{{--                                    @endif--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    @if($revenue)--}}
{{--                                        {{$revenue[$order_unit->product->id]['unit_discount_later']}}%--}}
{{--                                    @endif--}}
{{--                                </td>--}}


                                <!-- start new -->


                                <?php

                                $product_info = $order_unit->product->infos()->wherePivot('store_id', '=', $order->store_id)->get()->first();
                                $price_total = $product_info->sell_total;
                                $price_total_sum = $order_unit->quantity_total * ($product_info->sell_total);
                                $price_unit = $product_info->sell_unit_original / $order_unit->product->quantity_unit;
                                $price_unit_sum = $order_unit->quantity_unit * ($product_info->sell_unit_original / $order_unit->product->quantity_unit);
                                $total_price_for_item = $price_total_sum + $price_unit_sum;

                                ?>

                                <td>
                                    @if($order_unit->quantity_total!=0)
                                        ({{ $price_total?$price_total:"----" }})
                                    @endif
                                    @if($order_unit->quantity_unit!=0)
                                        {{ $price_unit?number_format($price_unit,2):"----" }}
                                    @endif
                                </td>

                            <!--<td>({{ $order_unit->receive_total?$order_unit->receive_total:"----" }}) {{ $order_unit->receive_unit?$order_unit->receive_unit:"----" }}</td>-->

                            <!--<td>({{ $order_unit->recall_total?$order_unit->recall_total:"----" }}) {{ $order_unit->recall_unit?$order_unit->recall_unit:"----" }}</td>-->
                                <td>
                                <!--({{ $price_total_sum?$price_total_sum:"----" }})+{{ $price_unit_sum?number_format($price_unit_sum,2):"----" }} =-->
                                    {{number_format($price_unit_sum,2)+ $price_total_sum }}
                                </td>


                                <!-- end new -->


                            </tr>
                        @endforeach
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                @if($revenue)
                                    {{array_sum(array_column($revenue,'total_discount_now'))}}%
                                @endif
                            </td>
                            <td>
                                @if($revenue)
                                    {{array_sum(array_column($revenue,'total_discount_later'))}}%
                                @endif
                            </td>
                            <td></td>
                            <td>
                                @if($revenue)
                                    {{array_sum(array_column($revenue,'unit_discount_now'))}}%
                                @endif
                            </td>
                            <td>
                                @if($revenue)
                                    {{array_sum(array_column($revenue,'unit_discount_later'))}}%
                                @endif
                            </td>
                        </tr>
                        <td colspan="2" class="text-center">المجموع</td>

                        <td><b>{{$total}}</b></td>
                        @if($discounts)
                            <td><b>{{$discounts['total_discount_now']}}</b></td>
                        @endif

                        @if($discounts)
                            <td><b>{{$discounts['total_discount_later']}}</b></td>
                        @endif

                        <td><b>{{$unit}}</b></td>
                        @if($discounts)
                            <td><b>{{$discounts['unit_discount_now']}}</b></td>
                        @endif

                        @if($discounts)
                            <td><b>{{$discounts['unit_discount_later']}}</b>
                                @endif

                                <?php
                                if ($discounts) {
                                    $total_dis_now = $discounts['total_discount_now']
                                        + $discounts['unit_discount_now'];
                                    $total_dis_later = $discounts['total_discount_later']
                                        + $discounts['unit_discount_later'];
                                    $total_after_dis = ($order->price_total_sum + $order->price_unit_sum) - $total_dis_now - $cashback;
                                }
                                ?>
                                {{--                                @if($discounts)--}}
                                {{--                                    <tr style="font-size: 15px">--}}
                                {{--                                        <td class="text-right">{{number_format($total_dis_later,'0','.',',')}}</td>--}}
                                {{--                                        <td colspan="8">المكافأه الأجل</td>--}}
                                {{--                                    </tr>--}}
                                {{--                                @endif--}}
                                <tr style="font-size: 15px;border-top: 2px solid #999 !important;">
                                    <td class="text-right">{{$order->total_price}}</td>
                                    <td colspan="8">الاجمالى</td>
                                </tr>
                                @if($cashback)
                                    <tr style="font-size: 15px">
                                        <td class="text-right">{{number_format($cashback,'0','.',',')}}</td>
                                        <td colspan="8">كاش باك</td>
                                    </tr>
                                @endif
                                @if($discounts)
                                    <tr style="font-size: 15px">
                                        <td class="text-right">{{number_format($total_after_dis,'0','.',',')}}</td>
                                        <td colspan="8">السعر بعد المكافأه</td>
                                    </tr>
                                @endif
                                <tr style="font-size: 15px">
                                    <td class="text-right">
                                        {{number_format($order->paid_value,'0','.',',')}}
                                    </td>
                                    <td colspan="8">المبلغ المدفوع</td>
                                </tr>
                                <!--<tr style="font-size: 15px">-->
                                <!--    <td class="text-right">-->
                            <!--        {{number_format($order->rest_value,'0','.',',')}}-->
                                <!--    </td>-->
                                <!--    <td colspan="4">المبلغ المتبقى</td>-->
                                <!--</tr>-->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
