@extends('layouts.main')
@section('content')

    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{url('/admin')}}">لوحة التحكم</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>الاتجاهات</span>
            </li>
        </ul>

    </div>
    @permission('create-places')
    <a href="{{ url('admin/directions/create') }}" class="btn green"> أضافة
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
                        <span class="caption-subject bold uppercase">جدول عرض تفاصيل اتجاهات المناديب</span>
                    </div>
                    <div class="tools"> </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                        <thead>
                        <tr>
                            <th> <i class="fa fa-cogs"></i></th>
                            <th><i class="fa fa-object-group"></i> اسم الاتجاه </th>
                            <th><i class="fa fa-object-group"></i> اسم المنطقه </th>
                            <th><i class="fa fa-bookmark"></i> عرض </th>

                        </tr>
                        </thead>
                        <tbody>

                        @foreach($directions as $i=>$direction)

                            <tr>
                                <td scope="row">{{ $i + 1}}</td>

                                <td>{{ $direction['direction'] }}</td>
                                <td>{{ $direction->place->place }}</td>

                                <td>
                                    @permission('update-places')
                                    <a href="{{url('admin/directions/'.$direction['id'].'/edit')}}" class="btn btn-outline btn-circle btn-sm purple">
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
