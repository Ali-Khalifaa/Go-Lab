@extends('layouts.main')
@section('content')


    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">

                <h2> الحاله الائتمانيه للعملاء </h2>
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
                        <th>اسم العميل</th>
                        <th>اسم المحل</th>
                        <th>نوع المحل</th>
                        <th>العنوان</th>
                        <th>اجمالي المدفوعات</th>
                        <th>اجمالي المديونات</th>
                        <th>نسبه التسديد</th>


                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $i=>$user)

                        <tr>
                            <th scope="row">{{++$i}}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->shop_name }}</td>
                            <td>{{ $user->shop_type }}</td>
                            <td>{{ $user->address }}</td>
                            <td>{{ $user->total_paid }}</td>
                            <td>{{ $user->total_reset }}</td>
                            @if($user->total_reset + $user->total_paid != 0)
                                <td>{{ number_format ($user->total_paid/($user->total_paid + $user->total_reset) * 100 , 2) }}
                                    %
                                </td>
                            @else
                                <td>-----</td>
                            @endif
                        </tr>
                    @endforeach

                    </tbody>
                </table>

            </div>
        </div>
    </div>


@endsection
