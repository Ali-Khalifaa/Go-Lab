@extends('layouts.main')
@section('content')

    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{url('/admin')}}">لوحة التحكم</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>أسباب الإسترجاع</span>
            </li>
        </ul>

    </div>
    @permission('create-return_reasons')
    <a href="{{ url('admin/return_reasons/create') }}" class="btn green"> أضافة
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
                        <span class="caption-subject bold uppercase">جدول عرض تفاصيل أسباب الإسترجاع</span>
                    </div>
                    <div class="tools"> </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                        <thead>
                        <tr>
                            <th> <i class="fa fa-cogs"></i></th>
                            <th><i class="fa fa-object-group"></i> السبب </th>
                            <th><i class="fa fa-bookmark"></i> عرض </th>

                        </tr>
                        </thead>
                        <tbody>

                        @foreach($return_reasons as $i=>$return_reason)

                            <tr>
                                <td scope="row">{{ $i + 1}}</td>

                                <td>{{ $return_reason['status'] }}</td>

                                <td>
                                    @permission('update-return_reasons')
                                    <a href="{{url('admin/return_reasons/'.$return_reason['id'].'/edit')}}" class="btn btn-outline btn-circle btn-sm purple">
                                        <i class="fa fa-edit"></i> تعديل </a>
                                    @endpermission

                                    @permission('delete-return_reasons')

                                    {{--                         <form method="POST" onclick="return confirm('هل انت متأكد؟')" action="{{ url('admin/return_reasons/'.$return_reason['id']) }}"  style="display:inline" >--}}
                                    {{--        --}}
                                    {{--                        <button name="_method" type="hidden" value="DELETE" class="btn btn-default btn-sm">--}}
                                    {{--                        <span class="glyphicon glyphicon-remove"></span>--}}
                                    {{--                        </button>--}}
                                    {{--                        <input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
                                    {{--                        </form>--}}

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
