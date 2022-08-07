@extends('layouts.main')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
@section('content')

    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{url('/admin')}}">لوحة التحكم</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>المستخدمين</span>
            </li>
        </ul>

    </div>

    @permission('create-users')
    <a href="{{ url('admin/users/create') }}" class="btn green"> أضافة
        <i class="fa fa-plus"></i>
    </a>
    @endpermission
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">جدول عرض تفاصيل المستخدمين</span>
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                        <thead>
                        <tr>
                            <th><i class="fa fa-cogs"></i></th>
                            <th><i class="fa fa-user"></i> الأسم</th>
                            <th><i class="fa fa-at"></i> البريد الألكترونى</th>
                            {{--                            <th><i class="fa fa-object-group"></i> الصلاحيات </th>--}}
                            <th><i class="fa fa-phone"></i> الهاتف</th>
                            <th><i class="fa fa-user"></i> مضاف بواسطة</th>
                            <th><i class="fa fa-bookmark"></i> عرض</th>

                        </tr>
                        </thead>
                        <tbody>

                        @foreach($users as $i=>$user)

                            <tr>
                                <td scope="row">{{ $i + 1}}</td>

                                <td>{{ $user['name'] }}</td>
                                <td>{{ $user['email'] }}</td>
                                {{--                                <td>--}}
                                {{--                                    <div class="mydiv">--}}
                                {{--                                        @foreach($user->permissions as $permission)--}}
                                {{--                                            @php--}}
                                {{--                                                $arr = explode('-',$permission->name);--}}
                                {{--                                            @endphp--}}

                                {{--                                            {{$maps[$arr[0]]}} {{$permissions[$arr[1]]}} <br>--}}
                                {{--                                        @endforeach--}}
                                {{--                                    </div>--}}
                                {{--                                </td>--}}
                                <td>
                                    {{ $user->phone }}
                                </td>
                                <td>{{ is_null($user->adder)? "---" : $user->adder->name }}</td>


                                <td>
                                    <a href="{{url('admin/users/'.$user['id'])}}"
                                       class="btn btn-outline btn-circle btn-sm blue">
                                        <i class="fa fa-eye"></i> عرض الصلاحيات </a>
                                    @permission('update-users')
                                    <a href="{{url('admin/users/'.$user['id'].'/edit')}}"
                                       class="btn btn-outline btn-circle btn-sm purple">
                                        <i class="fa fa-edit"></i> تعديل </a>
                                    @endpermission

                                </td>

                            </tr>


                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->

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
