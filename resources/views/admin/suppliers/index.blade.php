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
                <span> الموردين</span>
            </li>
        </ul>

    </div>
    @permission('create-suppliers')
    <a href="{{ url('admin/suppliers/create') }}" class="btn green"> أضافة
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
                        <span class="caption-subject bold uppercase">جدول عرض تفاصيل الموردين</span>
                    </div>
                    <div class="tools"> </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                        <thead>
                        <tr>
                            <th> <i class="fa fa-cogs"></i></th>
                            <th><i class="fa fa-object-group"></i> اسم المورد </th>
                            <th><i class="fa fa-object-group"></i> التليفون </th>
                            <th><i class="fa fa-object-group"></i> العنوان </th>
                            <th><i class="fa fa-object-group"></i> سجل تجارى </th>
                            <th><i class="fa fa-object-group"></i> حالة المورد </th>
                            <th><i class="fa fa-bookmark"></i> عرض </th>

                        </tr>
                        </thead>
                        <tbody>

                        @foreach($suppliers as $i=>$company)

                            <tr>
                                <td scope="row">{{ $i + 1}}</td>

                                <td>{{ $company['name'] }}</td>
                                <td>{{ $company['phone'] }}</td>
                                <td>{{ $company['address'] }}</td>
                                <td>{{ $company['s_togary'] }}</td>
                                <td>{{ $company['is_active']?'مفعل':'غير مفعل' }}</td>


                                <td>

                                    {{--                                    <a href="{{url('admin/users/'.$user['id'])}}" class="btn btn-outline btn-circle btn-sm blue">--}}
                                    {{--                                        <i class="fa fa-eye"></i> عرض الصلاحيات </a>--}}
                                    @permission('update-suppliers')
                                    <a href="{{url('admin/suppliers/'.$company['id'].'/edit')}}" class="btn btn-outline btn-circle btn-sm purple">
                                        <i class="fa fa-edit"></i> تعديل </a>
                                    <a href="{{url('/admin/supplier_depts/'.$company['id'])}}" class="btn btn-outline btn-circle btn-sm purple">
                                        <i class="fa fa-money"></i> المديونيات </a>
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
