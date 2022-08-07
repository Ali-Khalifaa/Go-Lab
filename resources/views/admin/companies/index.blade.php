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
                <span>الشركات</span>
            </li>
        </ul>

    </div>
    @permission('create-companies')
    <a href="{{ url('admin/companies/create') }}" class="btn green"> أضافة
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
                        <span class="caption-subject bold uppercase">جدول عرض تفاصيل الشركات</span>
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                        <thead>
                        <tr>
                            <th><i class="fa fa-cogs"></i></th>
                            <th><i class="fa fa-object-group"></i> اسم الشركه</th>
                            <th><i class="fa fa-object-group"></i> ايقاف الشركه</th>
                            <th><i class="fa fa-object-group"></i>صوره الشركه</th>
                            <th><i class="fa fa-object-group"></i>نسبة الخصم</th>
                            <th><i class="fa fa-bookmark"></i> عرض</th>

                        </tr>
                        </thead>
                        <tbody>

                        @foreach($companies as $i=>$company)

                            <tr>
                                <td scope="row">{{ $i + 1}}</td>
                                <td>{{ $company['name'] }}</td>

                                <td>


                                    @permission('update-companies')
                                    @if($company->is_hidden != 0)

                                        <form method="post" onclick="return confirm('هل انت متأكد من تفعيل الشركه؟')" action="{{ url('admin/company/deactive/'.$company['id']) }}"  style="display:inline" >
                                            {{ csrf_field() }}

                                            <button href="" class="btn btn-outline btn-circle btn-sm blue">
                                                <i class="fa fa-edit"></i> تفعيل </button>

                                        </form>
                                        @elseif($company->is_hidden != 1)
                                        <form method="post" onclick="return confirm('هل انت متأكد من ايقاف الشركه؟')" action="{{ url('admin/company/active/'.$company['id']) }}"  style="display:inline" >
                                            {{ csrf_field() }}
                                            <button class="btn btn-outline btn-circle btn-sm red">
                                                <i class="fa fa-edit"></i>ايقاف التفعيل </button>

                                        </form>
                                    @else
                                    @endif
                                    @endpermission


                                </td>

                                <td>
                                    <img src="{{asset('uploads/companies/'.$company->image)}}" alt="Image"
                                         style="width:50px;height:50px;margin-left:30px;">
                                </td>

                                <td>{{$company->discount_status == 1 ? $company->percentage . " %" : "لا يوجد خصم"}}</td>


                                <td>
                                    @permission('update-companies')
                                    <a href="{{url('admin/companies/'.$company['id'].'/edit')}}"
                                       class="btn btn-outline btn-circle btn-sm purple">
                                        <i class="fa fa-edit"></i> تعديل </a>

                                    <a href="{{route('companyDiscount.edit', $company['id'])}}" class="btn btn-outline btn-circle btn-sm green">
                                        <i class="fa fa-dollar"></i>{{$company['discount_status'] ? "تعديل الخصم" : "اضافة خصم"}} </a>
                                    @endpermission

                                    @permission('delete-companies')
                                    {{--                 <form method="POST" onclick="return confirm('هل انت متأكد؟')" action="{{ url('admin/companies/'.$company['id']) }}"  style="display:inline" >--}}

                                    {{--                <button name="_method" type="hidden" value="DELETE" class="btn btn-default btn-sm">--}}
                                    {{--                <span class="glyphicon glyphicon-remove"></span>--}}
                                    {{--                </button>--}}
                                    {{--                <input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
                                    {{--                </form>--}}
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
