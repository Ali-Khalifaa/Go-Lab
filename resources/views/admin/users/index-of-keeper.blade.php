@extends('layouts.main')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
@section('content')


    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">

                <h2> تقارير امناء المخازن </h2>
                <ul class="nav navbar-right panel_toolbox">
                    @permission('create-users')
                    <li><a href="{{ url('admin/users/create') }}"> <i class="fa fa-plus"></i>اضافه</a></li>
                    @endpermission
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>

            <div class="x_content table-scrollable">

                <table id="table_id" class="table table-striped table-bordered table-advance table-hover">
                    <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>اسم المستخدم</th>
                        <th> البريد الالكتروني</th>
                        <th> رقم التليفون</th>
                        <th>التحكم</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $i=>$user)

                        <tr>
                            <th scope="row">{{++$i}}</th>
                            <td>{{ $user['name'] }}</td>
                            <td>{{ $user['email'] }}</td>

                            <td>
                                {{ $user->phone }}
                            </td>
                            <td>
                                <a href="{{url('/admin/examination-of-keeper/'.$user['id'])}}" class="btn btn-success">
                                    فواتير الشراء
                                </a>

                                <a href="{{url('/admin/online-orders-of-keeper/'.$user['id'])}}"
                                   class="btn btn-success">
                                    فواتير بيع online
                                </a>

                                <a href="{{url('/admin/direct-selle-of-keeper/'.$user['id'])}}" class="btn btn-success">
                                    البيع المباشر
                                </a>


                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection
@section('js')
    <script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#table_id').DataTable();
        });
    </script>
@endsection
