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
                <span>العملاء</span>
            </li>
        </ul>

    </div>
    <div class="x_title">

        <div style="padding-top: 10px;">
            <li style="list-style: none;">
                <form method="GET" action="{{route('clients.index')}}" class="form-inline">
                    <label for="from"> من </label>
                    <input class="form-control" required id="from" type="date" name="from_date"
                           value="{{request()->from_date}}">
                    <label for="to">الى</label>
                    <input id="to" class="form-control" required type="date" name="to_date"
                           value="{{request()->to_date}}">
                    <input class="btn btn-primary mb-2" type="submit" value="جرد">
                </form>
            </li>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 ">

            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">جدول عرض تفاصيل العملاء</span>
                    </div>
                    <div class="tools"> </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                        <thead>
                        <tr>
                            <th> <i class="fa fa-cogs"></i></th>
                            <th><i class="fa fa-sticky-note-o"></i>اسم العميل</th>
                            <th><i class="fa fa-sticky-note-o"></i>اسم العياده</th>
                            <th><i class="fa fa-folder-open"></i> التخصص </th>
                            <th><i class="fa fa-sticky-note-o"></i>العنوان </th>
                            <th><i class="fa fa-sticky-note-o"></i>النقاط </th>
                            <th><i class="fa fa-sticky-note-o"></i>المنطقه </th>
                            <th><i class="fa fa-phone"></i> رقم العميل </th>
                            <th><i class="fa fa-sticky-note-o"></i> مضاف بواسطة </th>
                            <th><i class="fa fa-money"></i> الصوره </th>
                            <th><i class="fa fa-money"></i> الكود </th>
                            <th><i class="fa fa-calendar"></i> اخر طلب </th>
                            <th><i class="fa fa-bookmark"></i> التحكم </th>
                            <th><i class="fa fa-tripadvisor"></i> تفعيل / بلوك </th>

                        </tr>
                        </thead>
                        <tbody>

                        @foreach($users as $i=>$user)

                            <tr>
                                <td scope="row">{{ $i + 1}}</td>

                                <td>{{ $user['name'] }}</td>
                                <td>
                                    {{ $user['shop_name'] }}
                                </td>
                                <td>
                                    {{ $user['shop_type'] }}
                                </td>
                                <td>{{ $user['address'] }}</td>
                                <td>{{ $user['points'] }}</td>
                                <td>{{ is_null($user->place)? "---" :$user->place->place }}</td>
                                <td>
                                    {{ $user->phone }}
                                    <a style="font-size: 20px" href="tel:{{ $user->phone }}"><span
                                            class="glyphicon glyphicon-phone"></span></a>
                                </td>
                                <td>{{ is_null($user->adder)? "---" : $user->adder->name }}</td>


                                <td>
                                    @if($user->image==null)
                                        <img src="{{asset('/images/logo.png')}}" alt="Image"
                                             style="width:50px;height:50px;margin-left:30px;">

                                    @else
                                        <img src="{{asset('images/'.$user->image)}}" alt="Image"
                                             style="width:50px;height:50px;margin-left:30px;">
                                    @endif

                                </td>
                                <td>
                                    {{ $user->id }}
                                </td>

                                <td>
                                    {{$user->last_order}}

                                </td>
                                <td>

                                        <ul >
                                            <li>
                                                <a href="{{url('admin/users/'.$user['id'])}}">
                                                    <i class="fa fa-eye"></i> عرض </a>
                                            </li>
                                            <li>
                                                <a href="{{url('/admin/clients/orders/'.$user['id'])}}">
                                                    <i class="fa fa-shopping-cart"></i> الفواتير </a>
                                            </li>
                                            <li>
                                                <a href="{{url('/admin/user_depts/'.$user['id'])}}">
                                                    <i class="fa fa-money"></i> المديونيات </a>
                                            </li>
                                            <li>
                                                <a href="{{url('admin/user/'.$user['id'].'/print_barcode')}}">
                                                    <i class="fa fa-print"></i> طباعة الباركود </a>
                                            </li>
                                            @permission('update-users')
                                            <li>
                                                <a href="{{url('admin/clients/'.$user['id'].'/edit')}}">
                                                    <i class="fa fa-plus"></i> تعديل </a>
                                            </li>
                                            @endpermission


                                        </ul>

                                </td>

                                <td>


                                    @permission('update-users')
                                    @if($user->status != 1)

                                        <form method="get" onclick="return confirm('هل انت متأكد من تفعيل المستخدم؟')" action="{{ url('admin/users/status/'.$user['id']) }}"  style="display:inline" >
                                            {{ csrf_field() }}

                                            <button href="" class="btn btn-outline btn-circle btn-sm blue">
                                                <i class="fa fa-edit"></i> تفعيل </button>

                                        </form>
                                    @elseif($user->status != 2)
                                        <form method="get" onclick="return confirm('هل تريد عمل بلوك للمستخدم؟')" action="{{ url('admin/users/block/'.$user['id']) }}"  style="display:inline" >
                                            {{ csrf_field() }}
                                            <button class="btn btn-outline btn-circle btn-sm red">
                                                <i class="fa fa-edit"></i>ايقاف التفعيل </button>

                                        </form>
                                    @else
                                    @endif
                                    @endpermission


{{--                                    @permission('update-users')--}}
{{--                                    <form method="get" action="{{ url('admin/users/status/'.$user['id']) }}">--}}
{{--                                        {{ csrf_field() }}--}}

{{--                                        @if($user->status != 1)--}}

{{--                                            <button type="submit"--}}
{{--                                                    onclick="return confirm('هل انت متأكد من تفعيل المستخدم؟')"--}}
{{--                                                    class="btn btn-success">--}}
{{--                                                <i class="fa fa-check-circle"></i>--}}

{{--                                            </button>--}}
{{--                                        @endif--}}
{{--                                    </form>--}}
{{--                                    <form method="get" action="{{ url('admin/users/block/'.$user['id']) }}">--}}
{{--                                        {{ csrf_field() }}--}}

{{--                                        @if($user->status != 2)--}}
{{--                                            <button type="submit" onclick="return confirm('هل تريد عمل بلوك للمستخدم؟')"--}}
{{--                                                    style="background: #ec0f0f" class="btn btn-denger">--}}
{{--                                                <i class="fa fa-remove" style="color: #fff"></i>--}}
{{--                                            </button>--}}
{{--                                        @endif--}}
{{--                                    </form>--}}
{{--                                    @endpermission--}}
                                </td>

                            </tr>


                        @endforeach

                        </tbody>
                    </table>
                </div>
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
