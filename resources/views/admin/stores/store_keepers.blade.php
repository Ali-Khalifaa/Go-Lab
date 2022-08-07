@extends('layouts.main')
@section('content')


    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">

                <h2> امناء مخزن {{$store->name}} </h2>
                <button class="btn btn-primary" type="button"><a href="{{ url()->previous() }}" style="color:white">إلغاء</a></button>
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
                        <th> التحكم</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($store_keepers as $i=>$store_keeper)
                        <tr>
                            <th scope="row">{{++$i}}</th>
                            <th>{{$store_keeper->name}}</th>
                            <th>
                                <a href="{{route('store_keeper.edit_products',$store_keeper->id)}}"
                                   class="btn btn-success">
                                    <span class="glyphicon glyphicon-eye-open"> المنتجات </span>
                                </a>
                            </th>
                        </tr>
                    @endforeach

                    </tbody>
                </table>

            </div>
        </div>
    </div>


@endsection
