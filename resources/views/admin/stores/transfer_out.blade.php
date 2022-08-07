@extends('layouts.main')
@section('content')


    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">

                <h2>
                    إذن صرف مخزن
                    <span>#{{$out->id}}</span>
                </h2>
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
                    <div class="col-md-3 col-md-offset-6">
                        <table class="table table-condensed table-bordered">
                            <thead class="thead-light">
                            <tr>
                                <th colspan="2" style="text-align: center">المخزن المرسل</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{$order->transfer->from_store->name}}</td>
                                <td>الإسم</td>
                            </tr>
                            <tr>
                                <td>{{$order->transfer->from_store->address}}</td>
                                <td>العنوان</td>
                            </tr>
                            <tr>
                                <td>{{$order->transfer->from_store->place->place}}</td>
                                <td>المنطقة</td>
                            </tr>
                            <tr>
                                <td>{{$order->transfer->from_store->store_keeper->name}}</td>
                                <td>امين المخزن</td>
                            </tr>
                            <tr>
                                <td>{{$order->mandob->name}}</td>
                                <td>المندوب</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-3 ">
                        <table class="table table-condensed table-bordered">
                            <thead class="thead-light">
                            <tr>
                                <th colspan="2" style="text-align: center">المخزن المستلم</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{$order->transfer->to_store->name}}</td>
                                <td>الإسم</td>
                            </tr>
                            <tr>
                                <td>{{$order->transfer->to_store->address}}</td>
                                <td>العنوان</td>
                            </tr>
                            <tr>
                                <td>{{$order->transfer->to_store->place->place}}</td>
                                <td>المنطقة</td>
                            </tr>
                            <tr>
                                <td>{{$order->transfer->to_store->store_keeper->name}}</td>
                                <td>امين المخزن</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="x_content">

                    <table class="table table-striped">
                        <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>اسم المنتج</th>
                            <th> كميه الجملة المطلوبه</th>
                            <th> كميه القطاعي المطلوبه</th>
                            {{--                                <th>المستلم من الجملة</th>--}}
                            {{--                                <th>المستلم من القطاعي</th>--}}
                            {{--                                <th>المرتجع من الجملة</th>--}}
                            {{--                                <th>المرتجع من القطاعي</th>--}}

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
                                <td>
                                    ({{$order_unit->quantity_unit?$order_unit->product->subunit_type:''}})
                                    {{ $order_unit->quantity_unit?$order_unit->quantity_unit:"----" }}
                                </td>
                                {{--                                  <td>{{ $order_unit->receive_total?$order_unit->receive_total:"----" }}</td>--}}
                                {{--                                  <td>{{ $order_unit->receive_unit?$order_unit->receive_unit:"----" }}</td>--}}
                                {{--                                  <td>{{ $order_unit->recall_total?$order_unit->recall_total:"----" }}</td>--}}
                                {{--                                  <td>{{ $order_unit->recall_unit?$order_unit->recall_unit:"----" }}</td>--}}


                                {{-- <td>
                                    <form method="POST" onclick="return confirm('هل انت متأكد؟')"
                                        action="{{ url('admin/orders/' . $order['id']) }}" style="display:inline">

                                        <button name="_method" type="hidden" value="DELETE" class="btn btn-default btn-sm">
                                            <span class="glyphicon glyphicon-remove"></span>
                                        </button>
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    </form>
                                </td> --}}
                            </tr>
                        @endforeach
                        <tr>
                            <td><b>الاجمالى</b></td>
                            <td></td>
                            <td><b>{{$total}}</b></td>
                            <td><b>{{$unit}}</b></td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


@endsection
