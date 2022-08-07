@extends('layouts.main')
@section('content')

    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{url('/admin')}}">لوحة التحكم</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>المناطق</span>
            </li>
        </ul>

    </div>
    @permission('create-places')
    <a href="{{ url('admin/places/create') }}" class="btn green"> أضافة
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
                        <span class="caption-subject bold uppercase">جدول عرض تفاصيل المناطق</span>
                    </div>
                    <div class="tools"> </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                        <thead>
                        <tr>
                            <th> <i class="fa fa-cogs"></i></th>
                            <th><i class="fa fa-object-group"></i> اسم المنطقه </th>
                            <th><i class="fa fa-object-group"></i> المخزن </th>
                            <th><i class="fa fa-bookmark"></i> عرض </th>

                        </tr>
                        </thead>
                        <tbody>

                        @foreach($places as $i=>$place)

                            <tr>
                                <td scope="row">{{ $i + 1}}</td>

                                <td>{{ $place['place'] }}</td>
                                <th> {{ $place->store ? $place->store->name : "---" }}  </th>

                                <td>
                                    @permission('update-places')
                                    <a href="{{url('admin/places/'.$place['id'].'/edit')}}" class="btn btn-outline btn-circle btn-sm purple">
                                        <i class="fa fa-edit"></i> تعديل </a>
                                    @endpermission

                                    @permission('delete-places')
                                    {{--                    <form method="POST" onclick="return confirm('هل انت متأكد؟')" action="{{ url('admin/places/'.$place['id']) }}"  style="display:inline" >--}}

                                    {{--                        <button name="_method" type="hidden" value="DELETE" class="btn btn-default btn-sm">--}}
                                    {{--                        <span class="glyphicon glyphicon-remove"></span>--}}
                                    {{--                        </button>--}}
                                    {{--                        <input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
                                    {{--                     </form>--}}
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
