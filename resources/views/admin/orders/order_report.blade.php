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


    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">جدول عرض تقارير جميع الطلبات</span>
                    </div>
                    <div class="tools"> </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                        <thead>
                        <tr>
                            <th> <i class="fa fa-cogs"></i></th>
                            <th><i class="fa fa-object-group"></i> حالة الطلب</th>
                            <th><i class="fa fa-object-group"></i>تاريخ الطلب</th>
                            <th><i class="fa fa-object-group"></i>تاريخ التسليم</th>
                            <th><i class="fa fa-object-group"></i> المخزن</th>
                            <th><i class="fa fa-object-group"></i>اسم العميل</th>
                            {{--<th><i class="fa fa-object-group"></i>اجمالى سعر الجملة</th>--}}
                            {{--<th><i class="fa fa-object-group"></i>اجمالى سعر القطاعي</th>--}}
                            <th><i class="fa fa-object-group"></i>اجمالى السعر</th>
                            <th><i class="fa fa-object-group"></i> المتحصل من الندوب</i></th>
                            <th><i class="fa fa-object-group"></i>المندوب</th>
                            <th><i class="fa fa-object-group"></i>حالة المندوب</th>

                            @if($option)
                                <th><i class="fa fa-object-group"></i>حالة المخزن </th>
                            @endif
                            {{-- <th>اجمالي المكافأه </th> --}}
                            <th><i class="fa fa-bookmark"></i> عرض </th>

                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($orders as $i => $order)

                            <tr>
                                <td scope="row">{{ ++$i }}</td>
                                <td>{{isset($order->order_stage_id)?$order->order_stage->stage:"معلق"}}</td>
                                <td>{{$order->date_of_order}}</td>
                                <td>{{isset($order->date_of_receipt)?$order->date_of_receipt:"----"}}</td>
                                <td>{{$order->store->name}}</td>
                                <td>{{ $order->user->name }}</td>
                                {{--                               <td>{{ $order->price_total_sum }}</td>--}}
                                {{--                               <td>{{ $order->price_unit_sum }}</td>--}}
                                <td>{{ $order->total_price}}</td>
                                <td>{{ $order->received_money?$order->received_money:'----'}}</td>
                                <td>{{isset($order->mandob_id)?$order->mandob->name:"----"}}</td>
                                <td>{{isset($order->mondob_stage_id)?$order->mandob_stage->stage:"----"}}</td>
                                @if($option)
                                    <td>{{is_null($order->store_id)?"لم يتم تعيين مخزن":$order->store->name}}</td>
                                @endif

                                <td>
                                    <a href="{{ url('admin/orders/show/'. $order->id ) }}" class="btn btn-success">
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

                                    {{-- <a href="{{ url('admin/orders/' . $order->id . '/track') }}" class="btn btn-success">
                                        <i class="fa fa-motorcycle"></i>
                                    </a> --}}
                                    {{--                                  @role('super_administrator')--}}
                                    {{--                                  <form method="POST" onclick="return confirm('هل انت متأكد؟')"--}}
                                    {{--                                      action="{{ url('admin/orders/' . $order['id']) }}" style="display:inline">--}}

                                    {{--                                      <button name="_method" type="hidden" value="DELETE" class="btn btn-default btn-sm">--}}
                                    {{--                                          <span class="glyphicon glyphicon-remove"></span>--}}
                                    {{--                                      </button>--}}
                                    {{--                                      <input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
                                    {{--                                  </form>--}}
                                    {{--                                  @endrole--}}
                                </td>

                            </tr>


                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->

        </div>
    </div>

@endsection
