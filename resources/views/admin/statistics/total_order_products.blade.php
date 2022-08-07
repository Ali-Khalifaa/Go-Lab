@extends('layouts.main')
@section('content')


    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">

                <h2> اجمالي الطلبات على المنتجات </h2>
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
                        <th>اسم المنتج</th>
                        <th>الشركه</th>
                        <th>الفئه</th>
                        <th>يومي</th>
                        <th>شهري</th>
                        <th>سنوي</th>


                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $i=>$product)

                        <tr>
                            <th scope="row">{{++$i}}</th>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->company->name }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>{{ $product->order_count_daily }}</td>
                            <td>{{ $product->order_count_monthly }}</td>
                            <td>{{ $product->order_count_yearly }}</td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>

            </div>
        </div>
    </div>


@endsection
