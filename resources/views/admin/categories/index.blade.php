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
                <span>الفئات</span>
            </li>
        </ul>

    </div>
    @permission('create-categories')
    <a href="{{ url('admin/categories/create') }}" class="btn green"> أضافة
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
                        <span class="caption-subject bold uppercase">جدول عرض تفاصيل الفئات</span>
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                        <thead>
                        <tr>
                            <th><i class="fa fa-cogs"></i></th>
                            <th><i class="fa fa-object-group"></i> اسم الفئة</th>
                            <th><i class="fa fa-object-group"></i> ايقاف الفئه</th>
                            <th><i class="fa fa-object-group"></i>صوره الفئه</th>
                            <th><i class="fa fa-bookmark"></i> عرض</th>

                        </tr>
                        </thead>
                        <tbody>

                        @foreach($categories as $i=>$company)

                            <tr>
                                <td scope="row">{{ $i + 1}}</td>
                                <td>{{ $company['name'] }}</td>

                                <td>

                                    @permission('update-categories')
                                    @if($company->is_hidden != 0)

                                        <form method="post" onclick="return confirm('هل انت متأكد من تفعيل الفئه؟')" action="{{ url('admin/category/deactive/'.$company['id']) }}"  style="display:inline" >
                                            {{ csrf_field() }}

                                            <button href="" class="btn btn-outline btn-circle btn-sm blue">
                                                <i class="fa fa-edit"></i> تفعيل </button>

                                        </form>
                                    @elseif($company->is_hidden != 1)
                                        <form method="post" onclick="return confirm('هل انت متأكد من ايقاف الفئه؟')" action="{{ url('admin/category/active/'.$company['id']) }}"  style="display:inline" >
                                            {{ csrf_field() }}
                                            <button class="btn btn-outline btn-circle btn-sm red">
                                                <i class="fa fa-edit"></i>ايقاف التفعيل </button>

                                        </form>
                                    @else
                                    @endif
                                    @endpermission


                                </td>

                                <td>
                                    <img src="{{asset('uploads/categories/'.$company->image)}}" alt="Image"
                                         style="width:50px;height:50px;margin-left:30px;">
                                </td>


                                <td>
                                    @permission('update-categories')
                                    <a href="{{url('admin/categories/'.$company['id'].'/edit')}}"
                                       class="btn btn-outline btn-circle btn-sm purple">
                                        <i class="fa fa-edit"></i> تعديل </a>
                                    @endpermission

                                    @permission('delete-categories')
                                    {{--                    <form method="POST" onclick="return confirm('هل انت متأكد؟')" action="{{ url('admin/categories/'.$company['id']) }}"  style="display:inline" >--}}
                                    {{--                    <button name="_method" type="hidden" value="DELETE" class="btn btn-default btn-sm">--}}
                                    {{--                    <span class="glyphicon glyphicon-remove"></span>--}}
                                    {{--                    </button>--}}
                                    {{--                    <input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
                                    {{--                    </form>--}}
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
