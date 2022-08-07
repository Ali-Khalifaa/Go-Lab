@extends('layouts.main')
@section('content')


    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">

                <h2> سجل الشيفتات لمخزن {{$store->name}} </h2>
                <button class="btn btn-primary" type="button">
                    <a href="{{ url()->previous() }}" style="color:white">إلغاء</a>
                </button>
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
                        <th> من</th>
                        <th> الى</th>
                        <th> بداية الشيفت</th>
                        <th> نهاية الشيفت</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($shifts as $i=>$shift)

                        <tr>
                            <th scope="row">{{++$i}}</th>
                            <th>{{$shift->from_user->name}}</th>
                            <th>{{$shift->to_user->name}}</th>
                            <th>{{$shift->start_date}}</th>
                            <th>{{is_null($shift->end_date)?'---':$shift->end_date}}</th>
                        </tr>

                    @endforeach

                    </tbody>
                </table>

            </div>
        </div>
    </div>


@endsection
