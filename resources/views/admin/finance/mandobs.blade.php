@extends('layouts.main')
@section('content')


    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">

                <h2> مندوبين مخزن {{$store->name}} </h2>
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
                        <th> الاسم</th>
                        <th> المحفظة</th>
                        <th> التحكم</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($mandobs as $i=>$mandob)
                        <tr>
                            <th scope="row">{{++$i}}</th>
                            <th>{{$mandob->name}}</th>
                            <th>{{number_format($mandob->wallet,'0','.',',')}}</th>
                            @if($mandob->wallet>0)
                                <th>
                                    <a href="{{route('finance.mandob_zero',[$store->id,$mandob->id])}}" class="btn btn-success" >
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
