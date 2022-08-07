@extends('layouts.main')
@section('content')

    <style>

    </style>

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">

                <ul class="nav navbar-right panel_toolbox">
                    <li>
                        <button id="prinbtThis" class="noPrint btn btn-success">
                            <i class="fa fa-print"></i>
                            إطبع
                        </button>
                    </li>
                </ul>
                <div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content" id="tablePrint" id="print_content" style="direction: rtl;">
                <!-- <div class="watermark">-->
                <!--رينجو-->
                <!-- </div>-->
            <!--<img src="{{asset('images/logo.png')}}" >-->
                <h5>
                    # {{$order->id}}
                </h5>
                <h2 style="text-align: center;">GOLAB</h2>
                <table style="margin: auto;">
                    <thead class="thead-light">
                    <tr>

                    <!--<th colspan="4" class="text-center">اسم العميل </th>
                    <td colspan="4" class="text-center" >{{$order->supplier->name}}</td>-->
                        <!--<th colspan="4" class="text-center"> الموبايل </th>-->
                    </tr>
                    </thead>
                    <tbody>
                    <!--<tr>
                    <th colspan="10" class="text-center" > {{$order->type=='total' ? "جمله ": "قطاعى" }}</th>
                    </tr>-->
                    <tr>
                        <th colspan="10" class="text-center">
                            فاتورة الشراء
                        </th>
                    </tr>
                    <tr>
                        <th colspan="6" class="text-center">اسم العميل</th>
                        <td colspan="4" class="text-center">{{$order->supplier->name}}</td>
                    </tr>
                    <tr>
                        <th colspan="6" class="text-center"> العنوان</th>
                        <td colspan="4" class="text-center">{{$order->supplier->address}}</td>
                    </tr>
                    <tr>
                        <th colspan="6" class="text-center"> الموبايل</th>
                        <td colspan="4" class="text-center">{{$order->supplier->phone}}</td>
                    </tr>
                    <tr>
                        <th colspan="6" class="text-center"> التاريخ</th>
                        <td colspan="4" class="text-center">{{$order->created_at}}</td>
                    </tr>

                    <tr>
                        <th colspan="6" class="text-center"> وقت الطلب</th>
                        @php
                            $date = $order->created_at;
                            $date->setTimezone(new DateTimeZone('Africa/Cairo'));
                            $date=$date->format('h:i:s a') ;
                        @endphp

                        <td colspan="4" class="text-center">{{$date}}</td>
                    </tr>
                    </tbody>
                </table>


                <div style="display : flex ;  justify-content : center ; text-align : center " class="row">
                    <div class="col-md-4 m-auto ">
                        <p>تفاصيل فاتورة الشراء</p>
                    </div>
                </div>

                <table class="table table-striped my-5">
                    <?php
                    $total_receipt = 0;
                    $total_recall = 0;
                    ?>
                    </br>
                    <thead class="thead-light">
                    <tr>
                        <th> #</th>
                        <th> اسم المنتج</th>
                        <th> الكميه المطلوبه</th>
                        <th> سعر الوحده</th>
                        <th> السعر الاجمالى</th>
                    </tr>
                    </thead>
                    <tbody class="mb-3">
                    <tr>
                    @foreach($order_units as $i => $examination_unit)
                        <tr>
                            <?php
                            $product_info = $examination_unit->product->infos()->wherePivot('store_id', '=', $order->store_id)->get()->first();
                            $price_total_sum = $examination_unit->quantity_total * ($product_info->sell_total);
                            $price_unit_sum = $examination_unit->quantity_unit * ($product_info->sell_unit_original / $examination_unit->product->quantity_unit);
                            $total_price_for_item = $price_total_sum + $price_unit_sum;
                            ?>
                            <td>{{++$i}}</td>
                            <td>{{ $examination_unit->product->name}}</td>
                            <!-- start new -->
                            <td>
                                {{$examination_unit->receive}}
                            </td>
                            <?php
                            $product_info = $examination_unit->product->infos()->wherePivot('store_id', '=', $order->store_id)->get()->first();
                            $price_total = $product_info->sell_total;
                            $price_total_sum = $examination_unit->quantity_total * ($product_info->sell_total);
                            $price_unit = $product_info->sell_unit_original / $examination_unit->product->quantity_unit;
                            $price_unit_sum = $examination_unit->quantity_unit * ($product_info->sell_unit_original / $examination_unit->product->quantity_unit);
                            $total_price_for_item = $price_total_sum + $price_unit_sum;
                            ?>
                            <td>
                                {{ $examination_unit->total_price / $examination_unit->receive }}
                            </td>
                            <td>
                                {{ $examination_unit->total_price?number_format($examination_unit->total_price,2):"----" }}
                            </td>
                            <?php
                            $total_receipt = $total_receipt + $examination_unit->receive
                            ?>

                            <?php
                            $total_recall = $total_recall + $examination_unit->recall
                            ?>
                        </tr>
                        @endforeach
                        </tr>
                        <tr>
                            <?php
                            $total_sum = $order->price_total_sum + $order->price_unit_sum;
                            ?>
                            <th id="total" colspan="3" class="text-center"> المجموع :</th>
                            <td colspan="2">{{$order->total }}</td>
                        </tr>
                        <tr>
                            <th colspan="3" class="text-center">التوصيل :</th>
                            <td colspan="2">
                                {{$order->delivery_price ?$order->delivery_price : 0 }}
                            </td>

                        </tr>
                        <tr>
                            <th colspan="3" class="text-center">مبالغ اضافيه :</th>
                            <td colspan="2">
                                {{$order->additional_price ?$order->additional_price : 0 }}
                            </td>

                        </tr>
                        <tr>
                            <th colspan="3" class="text-center">المدفوع :</th>
                            <td colspan="2">
                                {{$order->paid }}
                            </td>

                        </tr>
                        <tr>

                            <th colspan="3" class="text-center">الباقى :</th>
                            <td colspan="2">
                                {{($order->total + $order->delivery_amount )- $order->paid}}
                            </td>
                        </tr>

                    </tbody>
                </table>

            </div>
        </div>
    </div>


@endsection

@section('javascript1')
    <script src="{{asset('js/printThis.js')}}"></script>
    <script>
        $('#prinbtThis').on('click', function () {
            console.log('hi mr mohamed ')
            $('#tablePrint').printThis({
                importCSS: true,
                importStyle: true,
                loadCSS: "../../css/custom.css",

            })
        })

    </script>
@endsection
