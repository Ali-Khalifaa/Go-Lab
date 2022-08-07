@extends('layouts.main')
@section('content')


    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">

                <h2> العملاء المميزين </h2>
                <ul class="nav navbar-right panel_toolbox">
                    @permission('create-notify_users')
                    <li><a href="{{ url('admin/select_create/user_notifies') }}"> <i class="fa fa-plus"></i>اضافه</a>
                    </li>
                    @endpermission


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
                        <th> اسم العميل</th>
                        <th> المخازن التي بها مكافأه للعميل</th>
                        <th> المنتجات التي بالمكافأه</th>

                        <th width="15%">التحكم</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($notify_users as $i=>$notify)

                        <tr>
                            <th scope="row">{{++$i}}</th>
                            <td>{{ $notify->user->name }}</td>
                            <td>
                                @if($notify->notify->store_id==0)
                                    مكافأه على كل المخازن
                                @else
                                    ({{$notify->notify->store->place->place}})   {{$notify->notify->store->name}} <br>
                                @endif
                            </td>
                            <td>
                                @foreach($notify->notify_user_units as $unit)
                                    {{$unit->product->name}} <br>
                                @endforeach
                            </td>
                            <td>
                                @permission('update-notify_users')
                                <a href="{{route('user_notifies.edit',$notify->id)}}" class="btn btn-success">
                                    <span class="glyphicon glyphicon-edit"></span>
                                </a>
                                @endpermission

                                <a href="{{route('user_notifies.show',$notify->id)}}" class="btn btn-success">
                                    <span class="glyphicon glyphicon-eye-open"></span>
                                </a>
                                @permission('delete-notify_users')
                                <form method="POST" onclick="return confirm('هل انت متأكد؟')"
                                      action="{{ url('admin/user_notifies/'.$notify->id) }}" style="display:inline">
                                    <button name="_method" type="hidden" value="DELETE" class="btn btn-danger">
                                        <span class="glyphicon glyphicon-remove"></span>
                                    </button>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                </form>
                                @endpermission

                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>

            </div>
        </div>
    </div>


@endsection
