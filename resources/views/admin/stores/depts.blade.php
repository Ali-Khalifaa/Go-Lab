@extends('layouts.main')
@section('content')


    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">

                <h2> سجل الشيفتات لمخزن {{$store->name}} </h2>
                <ul class="nav navbar-right panel_toolbox">
                    {{--              <li> <a href="{{ url('admin/stores/create') }}"> <i class="fa fa-plus"></i>اضافه</a></li>--}}

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
                        <th> المورد</th>
                        <th> الكمية</th>
                        <th> التصفيه</th>
                        <th> التحكم</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($depts as $i=>$dept)

                        <tr>
                            <th scope="row">{{++$i}}</th>
                            <th>{{$dept->supplier->name}}</th>
                            <th>{{number_format($dept->amount, 0, ',', ' ')}}</th>
                            <th>{{!$dept->is_settlement? 'لم يتم التصفيه بعد' : 'تمت تصفيته'}}</th>
                            <th>
                                @if(!$dept->is_settlement)
                                    <a href="{{route('supplier_depts_settle',[$store->id,$dept->id])}}"
                                       class="btn btn-success">
                                        <span class="glyphicon glyphicon-check"></span>
                                    </a>
                                @endif
                            </th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>


@endsection
