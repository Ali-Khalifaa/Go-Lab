@extends('layouts.main')
@section('content')


    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <!--<h2 >-->
            <!--    <span>#{{$order->id}}</span>-->
                <!--</h2>-->
                <ul class="nav navbar-right panel_toolbox">
                    <a href="{{url('admin/orders/show/'. $order->id)}}"
                       class="btn btn-primary" style="float: right;">
                        تفاصيل الطلب
                    </a>
                    {{-- <li> <a href="{{ url('admin/orders/create') }}"> <i class="fa fa-plus"></i>اضافه</a></li>
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li> --}}
                </ul>
                <div class="clearfix"></div>

            </div>
            <div class="x_content">
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

                            {{--<th>المستلم من الجملة</th>--}}
                            {{--<th>المستلم من القطاعي</th>--}}
                            {{--<th>المرتجع من الجملة</th>--}}
                            {{--<th>المرتجع من القطاعي</th>--}}

                            {{-- <th width="15%">التحكم</th> --}}
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


                                {{--                                  <td>{{ $order_unit->receive_total?$order_unit->receive_total:"----" }}</td>--}}
                                {{--                                  <td>{{ $order_unit->receive_unit?$order_unit->receive_unit:"----" }}</td>--}}
                                {{--                                  <td>{{ $order_unit->recall_total?$order_unit->recall_total:"----" }}</td>--}}
                                {{--                                  <td>{{ $order_unit->recall_unit?$order_unit->recall_unit:"----" }}</td>--}}
                            </tr>
                        @endforeach
                        <tr>
                            <td></td>
                            <td></td>
                            <td><b>{{$total}}</b></td>
                            <td>
                                @if($revenue)
                                    {{array_sum(array_column($revenue,'total_discount_now'))}}
                                @endif
                            </td>
                            <td>
                                @if($revenue)
                                    {{array_sum(array_column($revenue,'total_discount_later'))}}
                                @endif
                            </td>
                            <td><b>{{$unit}}</b></td>
                            <td>
                                @if($revenue)
                                    {{array_sum(array_column($revenue,'unit_discount_now'))}}
                                @endif
                            </td>
                            <td>
                                @if($revenue)
                                    {{array_sum(array_column($revenue,'unit_discount_later'))}}
                                @endif
                            </td>
                        </tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        @if($discounts)
                            <td><b>{{$discounts['total_discount_now']}}</b></td>
                        @endif

                        @if($discounts)
                            <td><b>{{$discounts['total_discount_later']}}</b></td>
                        @endif

                        <td></td>
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
                                @if($discounts)
                                    <tr style="font-size: 20px">
                                        <td class="text-right" colspan="4">
                                            <b>{{number_format($total_dis_later,'0','.',',')}}</b></td>
                                        <td colspan="4"><b>المكافأه الأجل</b></td>
                                    </tr>
                                @endif
                                @if($cashback)
                                    <tr style="font-size: 20px">
                                        <td class="text-right" colspan="4">
                                            <b>{{number_format($cashback,'0','.',',')}}</b></td>
                                        <td colspan="4"><b>كاش باك</b></td>
                                    </tr>
                                @endif
                                <tr style="font-size: 20px">
                                    <td class="text-right" colspan="4"><b>{{$order->total_price}}</b></td>
                                    <td colspan="4"><b>الاجمالى</b></td>
                                </tr>
                                @if($discounts)
                                    <tr style="font-size: 20px">
                                        <td class="text-right" colspan="4">
                                            <b>{{number_format($total_after_dis,'0','.',',')}}</b></td>
                                        <td colspan="4"><b>السعر بعد المكافأه</b></td>
                                    </tr>
                                @endif
                                <form method="POST" action="{{route('finalSell',$order->id)}}" style="display:inline">
                                    <tr style="font-size: 20px">
                                        <td colspan="4" class="text-right">
                                            <input type="hidden"
                                                   value="{{$discounts?$total_after_dis:$order->total_price}}"
                                                   name="paid_value" min="0" required>
                                        </td>
                                        {{--                                        <td colspan="4">المبلغ المدفوع</td>--}}
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    </tr>
                                    <tr>
                                        <td class="text-right" colspan="4">
                                            <button class="btn btn-danger" onclick="return confirm('هل انت متأكد؟')"
                                                    type="button"><a href="{{route('cancelSell',$order->id)}}"
                                                                     style="color:white">إلغاء الطلب</a></button>
                                        </td>
                                        <td colspan="4">
                                            <button type="submit" class="btn btn-success">اتمام عملية البيع</button>
                                        </td>
                                    </tr>
                                </form>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>


@endsection
