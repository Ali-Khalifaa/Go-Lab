@extends('layouts.main')
@section('content')


    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2> الطلبات المعدله </h2>
                <ul class="nav navbar-right panel_toolbox">
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
                        <th> رقم الطلب</th>
                        <th>المنتج</th>
                        <th>الكميه جمله قبل التعديل</th>
                        <th> الكميه جمله قبل التعديل</th>
                        {{--                        <th> الكميه قطاعى قبل التعديل</th>--}}
                        {{--                        <th>الكميه قطاعى بعد التعديل</th>--}}
                        <th>قام بالتعديل</th>
                        <th>تاريخ التعديل</th>
                        <th width="15%">التحكم</th>
                    </tr>
                    </thead>

                    @foreach ($orders as $i => $order)

                        <tbody>
                        <tr>
                            <th scope="row">{{ ++$i }}</th>
                            <td>
                                {{$order->order_id}}
                            </td>
                            <td>
                                {{$order->product->name}}
                            </td>
                            <td>
                                {{$order->quantity_total_after}}
                            </td>
                            <td>
                                {{$order->quantity_total_before}}
                            </td>
                            {{--                            <td>--}}
                            {{--                                {{$order->quantity_unit_after}}--}}
                            {{--                            </td>--}}
                            {{--                            <td>--}}
                            {{--                                {{$order->quantity_unit_before}}--}}
                            {{--                            </td>--}}
                            <td>
                                {{$order->user->name}}
                            </td>
                            <td>
                                {{$order->created_at}}
                            </td>


                            <td>
                                <a href="{{ url('admin/orders/show/'. $order->order_id ) }}" class="btn btn-success">
                                    <i class="fa fa-eye"></i>
                                </a>


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
                        </tbody>

                    @endforeach

                </table>

            </div>
        </div>
    </div>


@endsection
