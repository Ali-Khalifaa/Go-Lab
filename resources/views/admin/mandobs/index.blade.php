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
                <span>المندوبين</span>
            </li>
        </ul>

    </div>
    @permission('create-mandobs')
    <a href="{{ url('admin/mandoobs/create') }}" class="btn green"> أضافة
        <i class="fa fa-plus"></i>
    </a>
    @endpermission


    <div class="row">
        <div class="col-md-12 ">

            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">جدول عرض تفاصيل المندوبين</span>
                    </div>
                    <div class="tools"> </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                        <thead>
                        <tr>
                            <th> <i class="fa fa-cogs"></i></th>
                            <th><i class="fa fa-sticky-note-o"></i>اسم المندوب</th>
                            <th><i class="fa fa-sticky-note-o"></i>مناطق المندوب</th>
                            <th><i class="fa fa-folder-open"></i> عنوان المندوب </th>
                            <th><i class="fa fa-sticky-note-o"></i>تقييمات المندوب </th>
                            <th><i class="fa fa-bookmark"></i> التحكم </th>
                            <th><i class="fa fa-tripadvisor"></i> تفعيل / الغاء تفعيل </th>


                        </tr>
                        </thead>
                        <tbody>

                        @foreach($mandobs as $i=>$store)

                            <tr>
                                <td scope="row">{{ $i + 1}}</td>

                                <td>{{ $store['name'] }}</td>

                                <td>
                                    @foreach($store->places as $place)
                                        {{ $place->place }}<br>
                                    @endforeach
                                </td>

                                <td>{{ $store['address'] }}</td>
                                <td>{{ $store['rate'] }}</td>
                                <td>

                                    @permission('update-mandobs')
                                    <a href="{{url('admin/mandoobs/'.$store['id'].'/edit')}}" class="btn btn-outline btn-circle btn-sm purple">
                                        <i class="fa fa-edit"></i> تعديل </a>
                                    @endpermission

                                    @permission('read-orders')

                                    <a href="{{url('/admin/mandob-orders/'.$store['id'])}}" class="btn btn-outline btn-circle btn-sm blue">
                                        <i class="fa fa-edit"></i> عرض </a>
                                    @endpermission

                                </td>

                                <td>


                                    @permission('update-users')
                                    @if($store->status != 1)

                                        <form method="get" onclick="return confirm('هل انت متأكد من تفعيل المندوب؟')" action="{{ url('admin/mandoobs/status/'.$store['id']) }}"  style="display:inline" >
                                            {{ csrf_field() }}

                                            <button href="" class="btn btn-outline btn-circle btn-sm blue">
                                                <i class="fa fa-edit"></i> تفعيل </button>

                                        </form>
                                    @elseif($store->status != 0)
                                        <form method="get" onclick="return confirm('هل تريد عمل بلوك للمندوب؟')" action="{{ url('admin/mandoobs/block/'.$store['id']) }}"  style="display:inline" >
                                            {{ csrf_field() }}
                                            <button class="btn btn-outline btn-circle btn-sm red">
                                                <i class="fa fa-edit"></i>ايقاف التفعيل </button>

                                        </form>
                                    @else
                                    @endif
                                    @endpermission
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
