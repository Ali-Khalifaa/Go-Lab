@extends('layouts.main')
@section('content')


    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">

                <h2> مصروفات مخزن {{$store->name}} </h2>
                <ul class="nav navbar-right panel_toolbox">

                    @if(!empty(Auth::user()->manager_store()->get()->first()))
                        <li><a href="{{ url('admin/in_items/create?id='.$store->id) }}"> <i class="fa fa-plus"></i>اضافه
                                 بند ايراد</a></li>
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
                    @foreach($ins as $i=>$in)
                        <tr>
                            <th scope="row">{{++$i}}</th>
                            <th>{{$in->name}}</th>
                            <th>{{number_format($in->price,'0','.',',')}}</th>
                            <th>{{$in->ingoing->name}}</th>
                            <th>{{$in->date}}</th>
                            <th>{{$in->is_confirmed?"تم":"بانتظار الموافقة"}}</th>

                            @if(!$in->is_confirmed)
                                <th>
                                    <a href="{{route('finance.confirm_in',$in->id)}}"
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
