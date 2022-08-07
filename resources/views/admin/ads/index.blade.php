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
                <span>المساحه الاعلانية</span>
            </li>
        </ul>

    </div>
    @permission('create-ads')
    <a href="{{ url('admin/ads/create') }}" class="btn green"> أضافة
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
                        <span class="caption-subject bold uppercase">جدول عرض تفاصيل المساحة الاعلانية</span>
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                        <thead>
                        <tr>
                            <th><i class="fa fa-cogs"></i></th>
                            <th><i class="fa fa-object-group"></i>الصورة</th>
                            <th><i class="fa fa-bookmark"></i> عرض</th>

                        </tr>
                        </thead>
                        <tbody>

                        @foreach($ads as $i=>$type)

                            <tr>
                                <td scope="row">{{ $i + 1}}</td>

                                <td>
                                    <img src="{{asset('uploads/ads/'.$type['img'])}}" alt="Image"
                                         style="width:50px;height:50px;margin-left:30px;">
                                </td>


                                <td>
                                    @permission('update-ads')
                                    <a href="{{url('admin/ads/'.$type['id'].'/edit')}}"
                                       class="btn btn-outline btn-circle btn-sm purple">
                                        <i class="fa fa-edit"></i> تعديل </a>
                                    @endpermission

                                    @permission('delete-ads')
                                    <form method="POST" onclick="return confirm('هل انت متأكد؟')"
                                          action="{{ url('admin/ads/'.$type['id']) }}"
                                          style="display:inline">
                                        {{ csrf_field() }}
                                        {{ method_field('delete') }}
                                        <button name="_method" new="hidden" value="DELETE"
                                                class="btn btn-outline btn-circle dark btn-sm black">
                                            <span class="fa fa-trash-o"></span> حذف
                                        </button>
                                    </form>
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
