@extends('layouts.main')
@section('content')


    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                @if(is_null($id))
                    <h2> جميع اقسام المصروفات </h2>
                @else
                    <h2>قسم {{$outgoing->name}}</h2>
                @endif
                <ul class="nav navbar-right panel_toolbox">
                    @permission('create-expenses')
                    @if($add_item)
                        <li><a href="{{ url('admin/outgoings_item/create/'.$id) }}"> <i class="fa fa-plus"></i>اضافه بند</a>
                        </li>
                    @else
                        <li><a href="{{ url('admin/outgoings/create') }}"> <i class="fa fa-plus"></i>اضافه قسم</a></li>
                    @endif
                    @endpermission


                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>

                </ul>
                <div class="clearfix"></div>
            </div>

            <div class="x_content">

                <table id="table_id" class="table table-striped">
                    <thead class="thead-light">
                    @if($add_item)
                        <th>#</th>
                        <!--<th>اسم بند المصروفات</th>-->
                        <th>المبلغ</th>
                        <th>السبب</th>
                        <th>التاريخ</th>
                        <!--<th width="15%">التحكم</th>-->
                    @else
                        <th>#</th>
                        <th>اسم القسم</th>
                        <th>تابع الى</th>
                        <th>يومي/شهري</th>
                        <th width="15%">التحكم</th>
                        @endif
                        </tr>
                    </thead>
                    <tbody>
                    @if($add_item)
                        @foreach($items as $i=>$item)
                            <tr>
                                <th scope="row">{{++$i}}</th>

                                <td>{{ $item['price'] }}</td>
                                <td>{{ $item['name'] }}</td>
                                <td>{{ $item['created_at'] }}</td>

                                <!-- <td>-->
                                <!--     @permission('update-statistics')-->

                            <!--     <a href="{{url('admin/items/'.$item['id'].'/edit')}}" class="btn btn-success" >-->
                                <!--     <span class="glyphicon glyphicon-edit"></span>-->
                                <!--  </a>                            @endpermission-->

                                <!--     @permission('delete-statistics')-->

                            <!--     <form method="POST" onclick="return confirm('هل انت متأكد؟')" action="{{ url('admin/items/'.$item['id']) }}"  style="display:inline" >-->
                                <!-- <button name="_method" type="hidden" value="DELETE" class="btn btn-default btn-sm">-->
                                <!-- <span class="glyphicon glyphicon-remove"></span>-->
                                <!-- </button>-->
                            <!-- <input type="hidden" name="_token" value="{{ csrf_token() }}">-->
                                <!-- </form>-->
                                <!--     @endpermission-->

                                <!--</td>-->
                            </tr>
                        @endforeach
                    @else
                        @foreach($outgoings as $i=>$outgoing)
                            <tr>
                                <th scope="row">{{++$i}}</th>
                                <td>{{ $outgoing['name'] }}</td>
                                @if($outgoing->parent_id ==0)
                                    <td>قسم رئيسي</td>
                                @else
                                    <td>{{$outgoing->parent->name}}</td>
                                @endif
                                @if($outgoing->is_daily ==1)
                                    <td>يومي</td>
                                @else
                                    <td>شهري</td>
                                @endif
                                <td>
                                    <a href="{{url('admin/outgoings/'.$outgoing['id'].'/edit')}}"
                                       class="btn btn-success">
                                        <span class="glyphicon glyphicon-edit"></span>
                                    </a>
                                    <a href="{{ url('admin/outgoings?id='.$outgoing['id']) }}" class="btn btn-success">
                                        <span class="glyphicon glyphicon-eye-open"></span>
                                    </a>
                                    {{--                     <form method="POST" onclick="return confirm('هل انت متأكد؟')" action="{{ url('admin/outgoings/'.$outgoing['id']) }}"  style="display:inline" >--}}
                                    {{--                    <button name="_method" type="hidden" value="DELETE" class="btn btn-default btn-sm">--}}
                                    {{--                    <span class="glyphicon glyphicon-remove"></span>--}}
                                    {{--                    </button>--}}
                                    {{--                    <input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
                                    {{--                    </form>--}}

                                </td>
                            </tr>
                        @endforeach
                    @endif

                    </tbody>
                </table>

            </div>
        </div>
    </div>


@endsection
