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
                <span>انواع الخصومات</span>
            </li>
        </ul>

    </div>
    @permission('create-discount_type')
{{--    <a href="{{ url('admin/discount_type/create') }}" class="btn green"> أضافة--}}
{{--        <i class="fa fa-plus"></i>--}}
{{--    </a>--}}
    @endpermission


    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">جدول عرض تفاصيل انواع الخصومات</span>
                    </div>
                    <div class="tools"> </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                        <thead>
                        <tr>
                            <th> <i class="fa fa-cogs"></i></th>
                            <th><i class="fa fa-object-group"></i> نوع الخصم باللغة العربية </th>
                            <th><i class="fa fa-object-group"></i>من </th>
                            <th><i class="fa fa-object-group"></i>الى </th>
                            <th><i class="fa fa-object-group"></i>نسبة الخصم الفورى</th>
                            <th><i class="fa fa-object-group"></i>نسبة الخصم المؤجل</th>
                            <th><i class="fa fa-bookmark"></i> عرض </th>

                        </tr>
                        </thead>
                        <tbody>

                        @foreach($types as $i=>$type)

                            <tr>
                                <td scope="row">{{ $i + 1}}</td>

                                <td>{{ $type->name}}</td>
                                <td>{{ $type->from}}</td>
                                <td>{{$type->to}}</td>
                                <td>{{$type->immediately}}</td>
                                <td>{{$type->postponed}}</td>

                                <td>
                                    @permission('update-discount_type')
                                    <a href="{{url('admin/discount_type/'.$type->id.'/edit')}}" class="btn btn-outline btn-circle btn-sm purple">
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
