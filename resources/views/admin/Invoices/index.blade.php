@extends('layouts.main')
@section('content')


    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <div class="portlet-body">
                    <h2> الفواتير </h2>
                    <div style="margin: 20px 0 10px 30px">
                        <div class="row">
                            <div class="col-md-3 col-sm-3 col-xs-6 text-stat">
                                <span class="label label-sm label-success"> اجمالى عدد الفواتير: </span>
                                <h3>{{$orders->count()}}</h3>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-6 text-stat">
                                <span class="label label-sm label-info"> أجمالي عدد الفواتير الضريبية: </span>
                                <h3>{{$drepy}}</h3>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-6 text-stat">
                                <span class="label label-sm label-danger"> أجمالي عدد الفواتير غير الضريبية: </span>
                                <h3>{{$not_drepy}}</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="nav navbar-nav navbar-right">
                    <li class="">
                        <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown"
                           aria-expanded="false">
                            <i class="fa fa-plus"></i>اضافه
                        </a>
                        <ul class="dropdown-menu dropdown-usermenu pull-right">
                            <?php
                            use App\Store;
                            $stores = Store::all();
                            ?>
                            @foreach($stores as $store)
                                <li>
                                    <a href="{{ url('admin/orders/create/invoices/'.$store->id) }}">{{$store->name}} </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <table id="table_id" class="table table-striped">
                    <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th> سيريال</th>
                        <th> حالة الطلب</th>
                        <th>تاريخ الطلب</th>
                        <!--<th>تاريخ التسليم</th>-->
                        <th>اسم العميل</th>
                        <th>اجمالى السعر</th>
                        <th> التوصيل</th>
                        <th> نسبة الفيزا</th>
                        <th>المدفوع</th>
                        <th>متبقى</th>
                        <th>نوع الفاتورة</th>
                        <!--<th>المبلغ المستلم من قبل المسئول</th>-->
                        <th width="15%">التحكم</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($orders as $i => $order)
                        @if($order->received_direct_sell_money_from_f_m==0)
                            @if(Auth::user()->keeper_id!=null && Auth::user()->id!=1)

                            @else
                                <tr>
                                    <th scope="row">{{ ++$i }}</th>
                                    <td> # {{$order->id}} </td>
                                    <td>
                                        @if($order->invoice_type==1)
                                            بيان اسعار
                                        @elseif($order->invoice_type==2)
                                            فواتير مبيعات
                                        @elseif($order->invoice_type==0)
                                            بيان اسعار
                                        @else
                                            مرتجع مبيعات
                                        @endif

                                    </td>
                                    <td>{{$order->date_of_order}}</td>
                                <!--<td>{{isset($order->date_of_receipt)?$order->date_of_receipt:"----"}}</td>-->
                                    @if(isset($order->user))
                                        <td>{{ $order->user->name }}</td>
                                    @else
                                        <td>----</td>
                                    @endif

                                    <td>{{ $order->total_price}}</td>
                                    <td>{{ isset($order->delivery_amount)?$order->delivery_amount:'----' }}</td>
                                    <td>{{ isset($order->visa_amount)?$order->visa_amount:'----' }}</td>
                                    <td>{{ $order->paid_value?$order->paid_value:'----'}}</td>
                                    <?php
                                    if ($order->visa_amount != 0) {
                                        $visa_amount = ($order->total_price * ($order->visa_amount / 100));
                                    } else {
                                        $visa_amount = 0;
                                    }
                                    ?>
                                    <td>{{ ( $order->total_price + $order->delivery_amount + ($visa_amount ) ) - $order->paid_value  }}</td>
                                    @if($order->fatora_dripa == 1)
                                        <td>ضريبية</td>
                                    @else
                                        <td>غير ضريبية</td>
                                    @endif
                                    <td>
                                        <a href="{{ url('admin/orders/show/'. $order->id ) }}" class="btn btn-success">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{url('admin/orders/'.$order['id'].'/bill')}}" class="btn btn-info">
                                            <span class="glyphicon glyphicon-print">  </span>
                                        </a>

                                        <a href="{{url('admin/orders/'.$order['id'].'/fatora')}}"
                                           class="btn btn-warning">
                                            <span class="fa fa-print">  </span>
                                        </a>

                                        {{-- <a href="{{ url('admin/orders/' . $order->id . '/track') }}" class="btn btn-success">
                                            <i class="fa fa-motorcycle"></i>
                                        </a> --}}


                                    </td>
                                </tr>
                            @endif

                        @else
                            <tr>
                                <th scope="row">{{ ++$i }}</th>
                                <td> # {{$order->id}} </td>
                            <!--<td>{{$order->direct_selle_confirm_delivery_receipt==1?"تم البيع":"لم يكتمل بعد"}}</td>-->
                                <td>
                                    @if($order->invoice_type==1)
                                        بيان اسعار
                                    @elseif($order->invoice_type==2)
                                        فواتير مبيعات
                                    @elseif($order->invoice_type==0)
                                        بيان اسعار
                                    @else
                                        مرتجع مبيعات
                                    @endif
                                </td>
                                <td>{{$order->date_of_order}}</td>
                            <!--<td>{{isset($order->date_of_receipt)?$order->date_of_receipt:"----"}}</td>-->
                                @if(isset($order->user))
                                    <td>{{ $order->user->name }}</td>
                                @else
                                    <td>----</td>
                                @endif

                                <td>{{ $order->total_price}}</td>

                                <?php
                                if ($order->visa_amount != 0) {
                                    $visa_amount = ($order->total_price * ($order->visa_amount / 100));
                                } else {
                                    $visa_amount = 0;
                                }
                                ?>

                                <td>{{ isset($order->delivery_amount)?$order->delivery_amount:'----' }}</td>
                                <td>{{ isset($order->visa_amount)?$order->visa_amount:'----' }}</td>
                                <td>{{ $order->paid_value?$order->paid_value:'----'}}</td>
                                <td>{{ ( $order->total_price + $order->delivery_amount + $visa_amount ) - $order->paid_value }}</td>
                            <!--<td>{{ $order->received_direct_sell_money_from_f_m?$order->received_direct_sell_money_from_f_m:'----'}}</td>-->
                                <td>
                                    <a href="{{ url('admin/orders/show/'. $order->id ) }}" class="btn btn-success">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="{{url('admin/orders/'.$order['id'].'/bill')}}" class="btn btn-info">
                                        <span class="glyphicon glyphicon-print">  </span>
                                    </a>
                                    <a href="{{url('admin/orders/'.$order['id'].'/fatora')}}" class="btn btn-warning">
                                        <span class="fa fa-print">  </span>
                                    </a>
                                    {{-- <a href="{{ url('admin/orders/' . $order->id . '/track') }}" class="btn btn-success">
                                        <i class="fa fa-motorcycle"></i>
                                    </a> --}}


                                </td>
                            </tr>

                        @endif

                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
