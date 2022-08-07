@extends('layouts.main')
@section('content')


    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">

                <h2> استلام البضائع </h2>
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
                        <th> المنتج</th>
                        <th> الكميه</th>
                        <th> اجمالي </th>
                        <th> التحكم</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($examination_units as $i=>$examination_unit)
                        @if($user_products->contains($examination_unit->product->id))
                        <tr>
                            <th scope="row">{{++$i}}</th>
                            <th>{{$examination_unit->product->name}}</th>
                            <th>{{$examination_unit->receive}}</th>
                            <th>{{$examination_unit->total_price}}</th>
                            <th>
                                <a href="{{route('store_keeper.receive_unit',$examination_unit->id)}}" class="btn btn-success" >
                                    <span class="glyphicon glyphicon-check"> استلام </span>
                                </a>
                            </th>
                        </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>


@endsection
