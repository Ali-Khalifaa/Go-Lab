@extends('layouts.main')
@section('content')

    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{url('/admin')}}">لوحة التحكم</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>السلايدر</span>
            </li>
        </ul>

    </div>
    @permission('create-sliders')
    @if(count($sliders) < 5)
    <a href="{{ url('admin/sliders/create') }}" class="btn green"> أضافة
        <i class="fa fa-plus"></i>
    </a>
    @endif
    @endpermission


    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">جدول عرض تفاصيل السلايدر</span>
                    </div>
                    <div class="tools"> </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                        <thead>
                        <tr>
                            <th> <i class="fa fa-cogs"></i></th>
                            <th><i class="fa fa-object-group"></i> الصوره </th>
                            <th><i class="fa fa-object-group"></i> اسم المنتج </th>
                            <th><i class="fa fa-object-group"></i>القسم الرئيسي </th>
                            <th><i class="fa fa-bookmark"></i> عرض </th>

                        </tr>
                        </thead>
                        <tbody>

                        @foreach($sliders as $i=>$slide)

                            <tr>
                                <td scope="row">{{ $i + 1}}</td>

                                <td>
                                    <img src="{{asset('uploads/sliders/'.$slide->image)}}" alt="Image"
                                         style="width:50px;height:50px;margin-left:30px;">
                                </td>

                                <td>{{$slide->product->name}}</td>
                                <td>{{$slide->category->name}}</td>


                                <td>
                                    {{--                                    <a href="{{url('admin/users/'.$user['id'])}}" class="btn btn-outline btn-circle btn-sm blue">--}}
                                    {{--                                        <i class="fa fa-eye"></i> عرض الصلاحيات </a>--}}
                                    @permission('update-sliders')
                                    <a href="{{url('admin/sliders/'.$slide['id'].'/edit')}}" class="btn btn-outline btn-circle btn-sm purple">
                                        <i class="fa fa-edit"></i> تعديل </a>
                                    @endpermission

{{--                                    @permission('delete-sliders')--}}

{{--                                    <form method="POST" onclick="return confirm('هل انت متأكد؟')"--}}
{{--                                          action="{{ url('admin/sliders/'.$slide['id']) }}" style="display:inline">--}}

{{--                                        {{ csrf_field() }}--}}
{{--                                        {{ method_field('delete') }}--}}
{{--                                        <button name="_method" new="hidden" value="DELETE" class="btn btn-outline btn-circle dark btn-sm black">--}}
{{--                                            <span class="fa fa-trash-o"></span> حذف--}}
{{--                                        </button>--}}
{{--                                    </form>--}}
{{--                                    @endpermission--}}

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
