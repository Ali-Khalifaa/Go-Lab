@extends('layouts.main')
@section('content')


    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">

                <h2> الطلبات </h2>

                <div class="clearfix"></div>
            </div>

            <div class="x_content">

                <table id="table_id" class="table table-striped">
                    <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>اسم المنتج</th>
                        <th>اسم اليوزر</th>
                        <th>اجمالي المكافأه</th>
                        <th>الاجمالي</th>

                        <th width="15%">التحكم</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($previousorders as $i=>$order)

                        <tr>
                            <th scope="row">{{++$i}}</th>
                            <td>{{ $order->product->name }}</td>
                            <td>{{ $order->user->name }}</td>
                            <td>{{ $order->discount }}</td>
                            <td>{{ $order->price }}</td>


                            <td>


                                <form method="POST" onclick="return confirm('هل انت متأكد؟')"
                                      action="{{ url('admin/previousorders/'.$order['id']) }}" style="display:inline">

                                    <button name="_method" type="hidden" value="DELETE" class="btn btn-default btn-sm">
                                        <span class="glyphicon glyphicon-remove"></span>
                                    </button>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                </form>

                            </td>


                        </tr>

                    @endforeach

                    </tbody>
                </table>

            </div>
        </div>
    </div>


@endsection
