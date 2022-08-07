@extends('layouts.main')
@section('content')


    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">

                <h2> النقل </h2>
                <ul class="nav navbar-right panel_toolbox">
                    {{--                    <li> <a href="{{ url('admin/orders/create') }}"> <i class="fa fa-plus"></i>اضافه</a></li>--}}


                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>

                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <table id="table_id" class="table table-striped">
                    <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>من</th>
                        <th>الى</th>
                        <th> حالة النقل</th>
                        <th>تاريخ النقل</th>
                        <th>تاريخ التسليم</th>
                        {{--                            <th>اجمالى سعر الجملة</th>--}}
                        {{--                            <th>اجمالى سعر القطاعي</th>--}}
                        <th>المندوب</th>
                        <th>حالة المندوب</th>
                        {{-- <th>اجمالي المكافأه </th> --}}
                        <th width="15%">التحكم</th>
                    </tr>
                    </thead>
                    @foreach ($transfers as $i => $transfer)
                        <?php
                        $order = $transfer->order;
                        //                            dd($transfer->order);
                        //                            dd($order);
                        ?>
                        <tbody>
                        <tr>
                            <th scope="row">{{ ++$i }}</th>
                            <td>{{$transfer->from_store->name}}</td>
                            <td>{{$transfer->to_store->name}}</td>
                            <td>{{isset($order->order_stage_id)?$order->order_stage->stage:"معلق"}}</td>
                            <td>{{$order->date_of_order}}</td>
                            <td>{{isset($order->date_of_receipt)?$order->date_of_receipt:"----"}}</td>
                            {{--                               <td>{{ $order->price_total_sum }}</td>--}}
                            {{--                               <td>{{ $order->price_unit_sum }}</td>--}}
                            <td>{{isset($order->mandob)?$order->mandob->name:"----"}}</td>
                            <td>{{isset($order->mondob_stage_id)?$order->mandob_stage->stage:"----"}}</td>

                            <td>
                                <a href="{{ url('admin/orders/show/'. $order->id ) }}" class="btn btn-success">
                                    <i class="fa fa-eye"></i>
                                </a>
                                {{-- <a href="{{ url('admin/orders/' . $order->id . '/track') }}" class="btn btn-success">
                                    <i class="fa fa-motorcycle"></i>
                                </a> --}}
                                @permission('delete-orders')
                                <form method="POST" onclick="return confirm('هل انت متأكد؟')"
                                      action="{{ url('admin/orders/' . $order['id']) }}" style="display:inline">

                                    <button name="_method" type="hidden" value="DELETE" class="btn btn-default btn-sm">
                                        <span class="glyphicon glyphicon-remove"></span>
                                    </button>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                </form>
                                @endpermission
                            </td>
                        </tr>
                        </tbody>
                    @endforeach
                </table>

            </div>
        </div>
    </div>


@endsection
