@extends('layouts.main')
@section('content')


    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">

                <h2> المنتجات الاكثر مبيعا </h2>
                <ul class="nav navbar-right panel_toolbox">
{{--                    <li><a href="{{ url('admin/mostproducts/create') }}"> <i class="fa fa-plus"></i>اضافه</a></li>--}}


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
                        {{--              <th>الكميه</th>--}}
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($mostproducts as $i=>$mostproduct)

                        <tr>
                            <th scope="row">{{++$i}}</th>
                            <td>{{ $mostproduct->product->name }}</td>
                        </tr>

                    @endforeach

                    </tbody>
                </table>

            </div>
        </div>
    </div>


@endsection
