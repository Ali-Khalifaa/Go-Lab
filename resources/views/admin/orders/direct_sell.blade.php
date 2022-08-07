@extends('layouts.main')
@section('content')


    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2> طلبات البيع المباشر </h2>
                <button class="btn btn-primary" type="button"><a href="{{ url()->previous() }}" style="color:white">إلغاء</a>
                </button>

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
                        <th> حالة الطلب</th>
                        <th>تاريخ الطلب</th>
                        <th>تاريخ التسليم</th>
                        <th>اسم العميل</th>
                        {{--                            <th>اجمالى سعر الجملة</th>--}}
                        {{--                            <th>اجمالى سعر القطاعي</th>--}}
                        <th>اجمالى السعر</th>
                        <th> الاجمالى بعد الخصم</th>
                        <th>المدفوع</th>
                        <th>متبقى</th>
                        <th>المبلغ المستلم من قبل المسئول</th>

                        {{-- <th>اجمالي المكافأه </th> --}}
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
                                    <td>{{$order->direct_selle_confirm_delivery_receipt==1?"تم البيع":"لم يكتمل بعد"}}</td>
                                    <td>{{$order->date_of_order}}</td>
                                    <td>{{isset($order->date_of_receipt)?$order->date_of_receipt:"----"}}</td>
                                    @if(isset($order->user))
                                        <td>{{ $order->user->name }}</td>
                                    @else
                                        <td>----</td>
                                    @endif
                                    {{--                               <td>{{ $order->price_total_sum }}</td>--}}
                                    {{--                               <td>{{ $order->price_unit_sum }}</td>--}}
                                    <td>{{ $order->total_price}}</td>
                                    <td>{{ isset($order->total_minus_paid)?($order->total_price-$order->total_minus_paid):'----' }}</td>
                                    <td>{{ $order->paid_value?$order->paid_value:'----'}}</td>
                                    <td>{{ $order->rest_value?$order->rest_value:'----'}}</td>
                                    <td>{{ $order->received_direct_sell_money_from_f_m?$order->received_direct_sell_money_from_f_m:'----'}}</td>
                                    <td>
                                        <a href="{{ url('admin/orders/show/'. $order->id ) }}" class="btn btn-success">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        {{-- <a href="{{ url('admin/orders/' . $order->id . '/track') }}" class="btn btn-success">
                                            <i class="fa fa-motorcycle"></i>
                                        </a> --}}
                                        @if(!$order->is_complete)
                                            <button class="btn btn-danger" onclick="return confirm('هل انت متأكد؟')"
                                                    type="button">
                                                <a href="{{route('cancelSell',$order->id)}}" style="color:white">
                                                    <span class="glyphicon glyphicon-remove"></span>
                                                </a>
                                            </button>


                                        @endif
                                        @if($order->is_complete)
                                            @if($order->received_direct_sell_money_from_f_m==0)
                                                @if(Auth::user()->finance_manager==$order->store_id)
                                                    <a href="{{url('/admin/confirm_direct_sell_received_money/'.$order['id'])}}"
                                                       class="btn btn-success">
                                                        تأكيد استلام المبلغ
                                                    </a>
                                                @endif

                                            @elseif($order->received_direct_sell_money_from_f_m!=0)
                                                <p>تم تاكيد المبلغ من جانب مسئول الماليه</p>
                                            @endif
                                        @endif


                                        @if($order->direct_selle_confirm_delivery_receipt==0)
                                            @if(Auth::user()->keeper_id!=null)
                                                <a href="{{url('/admin/direct_selle_confirm_delivery_receipt/'.$order['id'])}}"
                                                   class="btn btn-success">
                                                    تأكيد تسليم الفاتوره
                                                </a>
                                            @endif

                                        @elseif($order->direct_selle_confirm_delivery_receipt==1)
                                            <p>تم تأكيد تسليم الفاتوره </p>
                                        @endif

                                    </td>
                                </tr>
                            @endif

                        @else
                            <tr>
                                <th scope="row">{{ ++$i }}</th>
                                <td>{{$order->direct_selle_confirm_delivery_receipt==1?"تم البيع":"لم يكتمل بعد"}}</td>
                                <td>{{$order->date_of_order}}</td>
                                <td>{{isset($order->date_of_receipt)?$order->date_of_receipt:"----"}}</td>
                                @if(isset($order->user))
                                    <td>{{ $order->user->name }}</td>
                                @else
                                    <td>----</td>
                                @endif
                                {{--                               <td>{{ $order->price_total_sum }}</td>--}}
                                {{--                               <td>{{ $order->price_unit_sum }}</td>--}}
                                <td>{{ $order->total_price}}</td>
                                <td>{{ isset($order->total_minus_paid)?($order->total_price-$order->total_minus_paid):'----' }}</td>
                                <td>{{ $order->paid_value?$order->paid_value:'----'}}</td>
                                <td>{{ $order->rest_value?$order->rest_value:'----'}}</td>
                                <td>{{ $order->received_direct_sell_money_from_f_m?$order->received_direct_sell_money_from_f_m:'----'}}</td>
                                <td>
                                    <a href="{{ url('admin/orders/show/'. $order->id ) }}" class="btn btn-success">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    {{-- <a href="{{ url('admin/orders/' . $order->id . '/track') }}" class="btn btn-success">
                                        <i class="fa fa-motorcycle"></i>
                                    </a> --}}
                                    @if(!$order->is_complete)
                                        <button class="btn btn-danger" onclick="return confirm('هل انت متأكد؟')"
                                                type="button">
                                            <a href="{{route('cancelSell',$order->id)}}" style="color:white">
                                                <span class="glyphicon glyphicon-remove"></span>
                                            </a>
                                        </button>


                                    @endif
                                    @if($order->is_complete)
                                        @if($order->received_direct_sell_money_from_f_m==0)
                                            @if(Auth::user()->finance_manager==$order->store_id)
                                                <a href="{{url('/admin/confirm_direct_sell_received_money/'.$order['id'])}}"
                                                   class="btn btn-success">
                                                    تأكيد استلام المبلغ
                                                </a>
                                            @endif

                                        @else
                                            <p>تم تاكيد المبلغ من جانب مسئول الماليه</p>
                                        @endif
                                    @endif

                                    @if($order->direct_selle_confirm_delivery_receipt==0)
                                        @if(Auth::user()->keeper_id!=null)
                                            <a href="{{url('/admin/direct_selle_confirm_delivery_receipt/'.$order['id'])}}"
                                               class="btn btn-success">
                                                تأكيد تسليم الفاتوره
                                            </a>
                                        @endif

                                    @elseif($order->direct_selle_confirm_delivery_receipt==1)
                                        <p>تم تأكيد تسليم الفاتوره </p>
                                    @endif

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
