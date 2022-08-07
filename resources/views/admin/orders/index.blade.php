@extends('layouts.main')
@section('content')

    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{url('/admin')}}">لوحة التحكم</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>الطلبات</span>
            </li>
        </ul>

    </div>
    <h1 class="page-title">الطلبات</h1>
    <a href="{{ url()->previous() }}" class="btn green"> إلغاء
    </a>
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">جدول عرض تفاصيل الطلبات</span>
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th> حالة الطلب</th>
                            <th>تاريخ الطلب</th>
                            <th>تاريخ التسليم</th>
                            <th> المخزن</th>
                            <th>اسم العميل</th>
                            <th>خدمة المنجز</th>
                            <th>اجمالى السعر</th>
                            <th> الاجمالى بعد المرتجع</th>
                            <th> الاجمالى بعد الخصم</th>
                            <th>المدفوع</th>
                            <!--<th>متبقى</th>-->
                            <th> المتحصل من المندوب</th>
                            <th> المتحصل من مسئول الماليه</th>
                            <th>المندوب</th>
                            <th>حالة المندوب</th>

                            @if($option)
                                <th>حالة المخزن</th>
                            @endif
                            <th>التحكم</th>

                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($orders as $i => $order)
                            <?php

                            $discount = 0;

                            if (count($order->discount) > 0) {
                                $discount += $order->discount->sum('discount');
                            }

                            if ($order->promoCode != null) {
                                $discount += $order->promoCode->discount;
                            }

                            ?>
                            @if($order->order_stage_id < 2)
                                @if(Auth::user()->keeper_id!=null)

                                @elseif(Auth::user()->finance_manager!=null)

                                @else
                                    <tr style="{{$order->mongez != null ? "color: red;" : ""}}">
                                        <th scope="row">{{ ++$i }}</th>
                                        <td>
                                            @if(!$order->is_canceled==1)
                                                {{isset($order->order_stage_id)?$order->order_stage->stage:"معلق"}}
                                            @else
                                                تم الغاء الطلب
                                            @endif
                                        </td>
                                        <td>{{$order->date_of_order}}</td>
                                        <td>{{isset($order->date_of_receipt)?$order->date_of_receipt:"----"}}</td>
                                        <td>{{$order->store->name}}</td>
                                        <td>{{ $order->user->name }}</td>
                                        @if($order->mongez != null)
                                            <td>{{ $order->mongez->price}}</td>
                                        @else
                                            <td>----</td>
                                        @endif

                                        <td>{{ $order->total_price + $discount}}</td>
                                        <td>{{ $order->total_price - $order->recall_price }}</td>
                                        <td>{{ isset($order->total_minus_paid)?($order->total_price-$order->total_minus_paid-$order->cash_back):'----' }}</td>
                                        <td>{{ $order->paid_value?$order->paid_value:'----'}}</td>
                                        <td>{{ $order->received_money?$order->received_money:'----'}}</td>
                                        <td>{{ $order->received_money_from_f_m?$order->received_money_from_f_m:'----'}}</td>
                                        <td>{{isset($order->mandob_id)?$order->mandob->name:"----"}}</td>
                                        <td>{{isset($order->mondob_stage_id)?$order->mandob_stage->stage:"----"}}</td>
                                        @if($option)
                                            <td>{{is_null($order->store_id)?"لم يتم تعيين مخزن":$order->store->name}}</td>
                                        @endif

                                        <td>
                                            <a href="{{ url('admin/orders/show/'. $order->id ) }}"
                                               class="btn btn-success">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            @if($option)
                                                @if(is_null($order->store_id))
                                                    <a href="{{ url('admin/orders/store/select/'. $order->id ) }}"
                                                       class="btn btn-success">
                                                        تعيين مخزن
                                                    </a>
                                                @endif

                                            @endif
                                            @if($order->order_stage_id>=3)
                                                @if($order->confirm_received_money==null)
                                                    @if(Auth::user()->finance_manager==$order->store_id)
                                                        <a href="{{url('/admin/confirm_received_money/'.$order['id'])}}"
                                                           class="btn btn-success">
                                                            تأكيد استلام المبلغ
                                                        </a>
                                                    @endif

                                                @else
                                                    <p>تم تاكيد المبلغ من جانب مسئول الماليه</p>
                                                @endif


                                                @if($order->confirm_delivery_receipt==0)
                                                    @if(Auth::user()->keeper_id!=null)
                                                        <a href="{{url('/admin/confirm_delivery_receipt/'.$order['id'])}}"
                                                           class="btn btn-success">
                                                            تأكيد تسليم الفاتوره
                                                        </a>
                                                    @endif

                                                @elseif($order->confirm_delivery_receipt==1)
                                                    <p>تم تأكيد تسليم الفاتوره </p>
                                                @endif
                                            @endif
{{--                                            <a href="{{ url('admin/orders/' . $order->id . '/track') }}"--}}
{{--                                               class="btn btn-outline btn-circle btn-sm blue">--}}
{{--                                                <i class="fa fa-motorcycle"></i>--}}
{{--                                            </a>--}}
{{--                                            @role('super_administrator')--}}
{{--                                            <form method="POST" onclick="return confirm('هل انت متأكد؟')"--}}
{{--                                                  action="{{ url('admin/orders/' . $order['id']) }}"--}}
{{--                                                  style="display:inline">--}}

{{--                                                <button name="_method" type="hidden" value="DELETE"--}}
{{--                                                        class="btn btn-default btn-sm">--}}
{{--                                                    <span class="glyphicon glyphicon-remove"></span>--}}
{{--                                                </button>--}}
{{--                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
{{--                                            </form>--}}
{{--                                            @endrole--}}
                                        </td>


                                    </tr>
                                @endif
                            @else

                                <tr style="{{$order->mongez != null ? "color: red;" : ""}}">
                                    <th scope="row">{{ ++$i }}</th>
                                    <td>{{isset($order->order_stage_id)?$order->order_stage->stage:"معلق"}}</td>
                                    <td>{{$order->date_of_order}}</td>
                                    <td>{{isset($order->date_of_receipt)?$order->date_of_receipt:"----"}}</td>
                                    <td>{{$order->store->name}}</td>
                                    <td>{{ $order->user->name }}</td>
                                    @if($order->mongez != null)
                                        <td>{{ $order->mongez->price}}</td>
                                    @else
                                        <td>----</td>
                                    @endif

                                    <td>{{ $order->total_price + $discount}}</td>
                                    <td>{{ $order->total_price - $order->recall_price }}</td>
                                    <td>{{ isset($order->total_minus_paid)?($order->total_price-$order->total_minus_paid-$order->cash_back):'----' }}</td>
                                    <td>{{ $order->paid_value?$order->paid_value:'----'}}</td>
                                    <td>{{ $order->received_money?$order->received_money:'----'}}</td>
                                    <td>{{ $order->received_money_from_f_m?$order->received_money_from_f_m:'----'}}</td>
                                    <td>{{isset($order->mandob_id)?$order->mandob->name:"----"}}</td>
                                    <td>{{isset($order->mondob_stage_id)?$order->mandob_stage->stage:"----"}}</td>
                                    @if($option)
                                        <td>{{is_null($order->store_id)?"لم يتم تعيين مخزن":$order->store->name}}</td>
                                    @endif

                                    <td>
                                        <a href="{{ url('admin/orders/show/'. $order->id ) }}"
                                           class="btn btn-success">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        @if($option)
                                            @if(is_null($order->store_id))
                                                <a href="{{ url('admin/orders/store/select/'. $order->id ) }}"
                                                   class="btn btn-success">
                                                    تعيين مخزن
                                                </a>
                                            @endif

                                        @endif
                                        @if($order->order_stage_id>=3)
                                            @if($order->confirm_received_money==null)
                                                @if(Auth::user()->finance_manager==$order->store_id)
                                                    <a href="{{url('/admin/confirm_received_money/'.$order['id'])}}"
                                                       class="btn btn-success">
                                                        تأكيد استلام المبلغ
                                                    </a>
                                                @endif

                                            @else
                                                <p>تم تاكيد المبلغ من جانب مسئول الماليه</p>
                                            @endif




                                            @if($order->confirm_delivery_receipt==0)
                                                @if(Auth::user()->keeper_id!=null)
                                                    <a href="{{url('/admin/confirm_delivery_receipt/'.$order['id'])}}"
                                                       class="btn btn-success">
                                                        تأكيد تسليم الفاتوره
                                                    </a>
                                                @endif

                                            @elseif($order->confirm_delivery_receipt==1)
                                                <p>تم تأكيد تسليم الفاتوره </p>
                                            @endif
                                        @endif
{{--                                        <a href="{{ url('admin/orders/' . $order->id . '/track') }}"--}}
{{--                                           class="btn btn-outline btn-circle btn-sm blue">--}}
{{--                                            <i class="fa fa-motorcycle"></i>--}}
{{--                                        </a>--}}
{{--                                        @role('super_administrator')--}}
{{--                                        <form method="POST" onclick="return confirm('هل انت متأكد؟')"--}}
{{--                                              action="{{ url('admin/orders/' . $order['id']) }}" style="display:inline">--}}

{{--                                            <button name="_method" type="hidden" value="DELETE"--}}
{{--                                                    class="btn btn-default btn-sm">--}}
{{--                                                <span class="glyphicon glyphicon-remove"></span>--}}
{{--                                            </button>--}}
{{--                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
{{--                                        </form>--}}
{{--                                        @endrole--}}

                                    </td>
                                </tr>
                            @endif
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->

        </div>
    </div>

@endsection
