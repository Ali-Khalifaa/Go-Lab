@extends('layouts.main')
@section('content')


    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">

                <h2> مصروفات مخزن {{$store->name}} </h2>
                <ul class="nav navbar-right panel_toolbox">
                    @if(!empty(Auth::user()->manager_store()->get()->first()))
                        <li><a href="{{ url('admin/items/create?id='.$store->id) }}"> <i class="fa fa-plus"></i>اضافه
                                بند مصروفات</a></li>
                    @endif
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
                        <th> الاسم</th>
                        <th> القيمه</th>
                        <th> القسم</th>
                        <th> التاريخ</th>
                        <th> الحالة</th>
                        <th> التحكم</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($outs as $i=>$out)
                        <tr>
                            <th scope="row">{{++$i}}</th>
                            <th>{{$out->name}}</th>
                            <th>{{number_format($out->price,'0','.',',')}}</th>
                            <th>{{$out->outgoing->name}}</th>
                            <th>{{$out->date}}</th>
                            <th>{{$out->is_confirmed?"تم":"بانتظار الموافقة"}}</th>

                            @if(!$out->is_confirmed)
                                <th>
                                    <a href="{{route('finance.confirm_out',$out->id)}}"
                                       class="btn btn-success">
                                        <span class="glyphicon glyphicon-check"> تصفيه </span>
                                    </a>
                                </th>
                            @endif
                        </tr>
                    @endforeach

                    </tbody>
                </table>

            </div>
        </div>
    </div>


@endsection
