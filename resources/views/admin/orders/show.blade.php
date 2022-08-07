@extends('layouts.main')

@section('content')


    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <button class="btn btn-primary" type="button"><a href="{{ url()->previous() }}" style="color:white">إلغاء</a></button>

            <div class="x_title">
                <h2>
                    @if($order->transfer_id == null)
                        تفاصيل الطلب
                    @else
                        تفاصيل النقل الى مخزن
                        {{$order->transfer->to_store->name}}
                    @endif

                    <small>({{isset($order->order_stage->stage)?$order->order_stage->stage:'معلق'}})</small>
                </h2>


                <ul class="nav navbar-right panel_toolbox">

                    {{-- <li> <a href="{{ url('admin/orders/create') }}"> <i class="fa fa-plus"></i>اضافه</a></li>
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li> --}}

                </ul>
                <div class="clearfix"></div>
            </div>

            <!-- cashier bill -->

            <!-- cashier bill -->
            <div class="x_content">

                <table class="table table-striped">
                    <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>اسم المنتج</th>
                        <th> كميه الجملة المطلوبه</th>
{{--                        <th> كميه القطاعي المطلوبه</th>--}}
                        <th>سعر الوحده جمله</th>
{{--                        <th>سعر الوحده قطاعى</th>--}}
                        @if($order->transfer_id == null)
                            <th>المستلم من الجملة</th>
{{--                            <th>المستلم من القطاعي</th>--}}
                            <th>المرتجع من الجملة</th>
{{--                            <th>المرتجع من القطاعي</th>--}}
                            @permission('update-orders')
                            <th> التحكم</th>
                            @endpermission
                        @endif
                    </tr>
                    </thead>
                    @if(count($order_units) > 0)
                    @foreach ($order_units as $i => $order_unit)


                        <tbody>
                        <tr>
                            <th scope="row">{{ ++$i }}</th>
                            <td>{{ $order_unit->product->name }}</td>
                            <td>
                                ({{$order_unit->quantity_total?$order_unit->product->unit_type:''}})
                                {{ $order_unit->quantity_total?$order_unit->quantity_total:"----" }}
                            </td>
{{--                            <td>--}}
{{--                                ({{$order_unit->quantity_unit?$order_unit->product->subunit_type:''}})--}}
{{--                                {{ $order_unit->quantity_unit?$order_unit->quantity_unit:"----" }}--}}
{{--                            </td>--}}
                            <td>{{$order_unit->price}}</td>
{{--                            <td>{{$order_unit->price_unit}}</td>--}}
                            @if($order->transfer_id == null)
                                <td>{{ $order_unit->receive_total?$order_unit->receive_total:"----" }}</td>
{{--                                <td>{{ $order_unit->receive_unit?$order_unit->receive_unit:"----" }}</td>--}}
                                <td>{{ $order_unit->recall_total?$order_unit->recall_total:"----" }}</td>
{{--                                <td>{{ $order_unit->recall_unit?$order_unit->recall_unit:"----" }}</td>--}}
                            @endif
                            @permission('update-orders')
                            <td>
                                @if($order->is_direct_sell==0)
                                    @if($order->order_stage_id<=2)
                                        <a href="{{ url('admin/store/edit_sell/'.$order_unit->id ) }}"
                                           class="btn btn-success">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form method="POST"
                                              action="{{ url('admin/store/delete_sell/'.$order_unit->id ) }}"
                                              ata-parsley-validate="" class="form-horizontal form-label-left"
                                              novalidate="">
                                            {{ csrf_field() }}
                                            <button class="btn btn-danger" onclick="return confirm('هل انت متأكد؟')"
                                                    type="submit">
                                                <a style="color:white">
                                                    <span class="glyphicon glyphicon-remove"></span>
                                                </a>
                                            </button>
                                        </form>
                                    @endif
                                @elseif($order->is_direct_sell==1)
                                    @if($order->received_direct_sell_money_from_f_m==0)
                                        <a href="{{ url('admin/store/edit_sell/'.$order_unit->id ) }}"
                                           class="btn btn-success">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form method="POST"
                                              action="{{ url('admin/store/delete_sell/'.$order_unit->id ) }}"
                                              ata-parsley-validate="" class="form-horizontal form-label-left"
                                              novalidate="">
                                            {{ csrf_field() }}
                                            <button class="btn btn-danger" onclick="return confirm('هل انت متأكد؟')"
                                                    type="submit">
                                                <a style="color:white">
                                                    <span class="glyphicon glyphicon-remove"></span>
                                                </a>
                                            </button>
                                        </form>
                                    @endif
                                @endif
                            </td>
                            @endpermission
                        </tr>
                        </tbody>
                    @endforeach
                    @endif
                    @permission('update-orders')
                    @if((!$order->is_direct_sell) && $order->transfer_id == null)
                        @if (!empty(Auth::user()->seller_store()->get()->first()))

                            {{--                        <a href="{{ url('admin/orders/' . $order_unit->order->id . '/track') }}" class="btn btn-success" style="float: right">--}}
                            {{--                            <i class="fa fa-motorcycle"></i>--}}
                            {{--                        </a>--}}

                            @if(!$order->is_canceled==1)
                                <a href="{{ url('admin/orders/cancel/' . $order->id) }}"
                                   class="btn btn-danger  {{$order->order_stage_id >= 1?"disabled":""}}  "
                                   style="float: right">
                                    الغاء الطلب
                                </a>
                            @else
                                <strong style="background-color:moccasin;float: right">تم الغاء الطلب </strong>
                            @endif
                            @if(!$order->is_canceled==1)
                            <!--is_canceled-->
                                <a href="{{ url('admin/orders/' . $order->id . '/stage/1') }}"
                                   class="btn btn-default  {{$order->order_stage_id >= 1?"disabled":""}}"
                                   style="float: right">
                                    معالجة الطلب
                                </a>
                                <a href="{{ url('admin/orders/' . $order->id . '/stage/2') }}"
                                   class="btn btn-info {{$order->order_stage_id >= 2?"disabled":""}}"
                                   style="float: right">
                                    تأكيد الطلب
                                </a>

                                <a href="{{ url('admin/orders/' . $order->id . '/bill') }}"
                                   class="btn btn-success " style="float: right">
                                    <i class="fa fa-file"></i>
                                    {{empty($order->out()->get()->first())?"عمل إذن صرف":"عرض إذن الصرف"}}
                                </a>

                            @endif

                        @endif
                        @if(!$order->is_canceled==1)
                            @if($order->mondob_stage_id < 1)
                                @if (!empty(Auth::user()->seller_store()->get()->first()))
                                    <a href="{{ url('admin/orders/' . $order->id . '/mandobs') }}"
                                       class="btn btn-success" style="float: right">
                                        <i class="fa fa-user"></i> تعيين مندوب
                                    </a>
                                @endif
                            @endif
                        @endif
                        @if (!empty(Auth::user()->store()->get()->first()))

                        @endif

                        @if( !empty(Auth::user()->keeper_store()->get()->first()) || Auth::user()->keeper_id!=null )
                            <a href="{{ url('admin/orders/' . $order->id . '/stage/3') }}"
                               class="btn btn-primary {{$order->order_stage_id >= 3?"disabled":""}}"
                               style="float: right">
                                تحضير الطلب
                            </a>
                        @endif
                    @elseif(!$order->is_complete && $order->transfer_id == null)
                        @if(!is_null(auth()->user()->store_finance_manager))
                            @if(auth()->user()->store_finance_manager->id == $order->store->id)
                                <a href="{{route('completeSell',$order->id)}}"
                                   class="btn btn-primary {{$order->order_stage_id >= 3?"disabled":""}}"
                                   style="float: right">
                                    اكمال الطلب
                                </a>
                            @endif
                        @endif
                    @elseif($order->transfer_id != null)
                        @if($order->mondob_stage_id == null)
                            <a href="{{route('completeSell',$order->id)}}"
                               class="btn btn-primary disabled" style="float: right">
                                بانتظار موافقة المندوب
                            </a>
                        @elseif($order->mondob_stage_id == 1 && !empty($order->mandob))
                            <a href="{{route('out_transfer',$order->id)}}"
                               class="btn btn-primary" style="float: right">
                                {{$order->order_stage_id >= 4? 'رؤية اذن الصرف' : ' تسليم المندوب'}}
                            </a>
                        @endif
                        @if(auth()->user()->hasRole('store_keeper') && $order->transfer->to_store->store_keeper->id == auth()->user()->id)
                            @if($order->mondob_stage_id >= 2 )
                                <a href="{{route('in_transfer',$order->id)}}"
                                   class="btn btn-primary" style="float: right">
                                    {{$order->order_stage_id==5?"الفاتورة":" استلام البضاعة"}}
                                </a>
                            @endif
                        @endif
                    @endif
                    @endpermission
                    <a href="{{ url('admin/orders/' . $order->id . '/stage/1') }}"
                       class="btn btn-default  {{$order->order_stage_id >= 1?"disabled":""}}"
                       style="float: right">
                        معالجة الطلب
                    </a>
                    <a href="{{ url('admin/orders/' . $order->id . '/stage/2') }}"
                       class="btn btn-info {{$order->order_stage_id >= 2?"disabled":""}}" style="float: right">
                        تأكيد الطلب
                    </a>

                    <a href="{{ url('admin/orders/' . $order->id . '/bill') }}"
                       class="btn btn-success " style="float: right">
                        <i class="fa fa-file"></i>
                        {{empty($order->out()->get()->first())?"عمل إذن صرف":"عرض إذن الصرف"}}
                    </a>

                </table>
            </div>
        </div>
    </div>


@endsection
