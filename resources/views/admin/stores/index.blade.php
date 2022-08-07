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
                <span>المخازن</span>
            </li>
        </ul>

    </div>
    @permission('create-stores')
    @if(count($stores) == 0)
    <a href="{{ url('admin/stores/create') }}" class="btn green"> أضافة
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
                        <span class="caption-subject bold uppercase">جدول عرض تفاصيل المخازن</span>
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                        <thead>
                        <tr>
                            <th><i class="fa fa-cogs"></i></th>
                            <th><i class="fa fa-object-group"></i> اسم المخزن</th>
                            <th><i class="fa fa-object-group"></i> امين المخزن الحالي</th>
                            <th><i class="fa fa-object-group"></i> امناء المخزن</th>
                            <th><i class="fa fa-object-group"></i> المسئول المالي الحالي</th>
                            <th><i class="fa fa-object-group"></i> مسئولين المالية</th>
                            <th><i class="fa fa-object-group"></i> البائعين</th>
                            <th><i class="fa fa-object-group"></i> المسؤلين</th>
                            <th><i class="fa fa-object-group"></i> المحاسب</th>
                            <th><i class="fa fa-object-group"></i> منطقه المخزن</th>
                            <th><i class="fa fa-object-group"></i> عنوان المخزن</th>
                            <th><i class="fa fa-bookmark"></i> عرض</th>

                        </tr>
                        </thead>
                        <tbody>

                        @foreach($stores as $i=>$store)

                            <tr>
                                <td scope="row">{{ $i + 1}}</td>

                                <td>{{ $store->name }}</td>
                                <td>{{ $store->store_keeper['name'] }}</td>
                                <td>
                                    @foreach($store->store_keepers as $store_keeper)
                                        {{$store_keeper->name}} <br>
                                    @endforeach
                                </td>
                                <td>{{ $store->store_finance_manager['name'] }}</td>
                                <td>
                                    @foreach($store->finance_managers as $manager)
                                        {{$manager->name}} <br>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($store->store_sellers as $seller)
                                        {{$seller->name}} <br>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($store->store_managers as $manager)
                                        {{$manager->name}} <br>
                                    @endforeach
                                </td>
                                <td>{{ $store->accountant ? $store->accountant->name : "---"  }}</td>
                                <td>{{ $store->place->place }}</td>
                                <td>{{ $store->address }}</td>
                                {{--                            <td>--}}
                                {{--                                @foreach($store->products as $product)--}}
                                {{--                                    {{$product->name}}<br>--}}
                                {{--                                @endforeach--}}
                                {{--                            </td>--}}

                                <td>
                                    @permission('update-stores')
                                    <a href="{{url('admin/stores/'.$store['id'].'/edit')}}"
                                       class="btn btn-outline btn-circle btn-sm purple">
                                        <i class="fa fa-edit"></i> تعديل </a>
                                    @endpermission

                                    <a href="{{route('stores.show',$store->id)}}"
                                       class="btn btn-outline btn-circle btn-sm blue">
                                        <i class="fa fa-eye"></i> عرض </a>
                                    @permission('delete-stores')
                                    {{--                     <form method="POST" onclick="return confirm('هل انت متأكد؟')" action="{{ url('admin/stores/'.$store['id']) }}"  style="display:inline" >--}}
                                    {{--                        <button name="_method" type="hidden" value="DELETE" class="btn btn-default btn-sm">--}}
                                    {{--                        <span class="glyphicon glyphicon-remove"></span>--}}
                                    {{--                        </button>--}}
                                    {{--                        <input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
                                    {{--                    </form>--}}
                                    @endpermission
                                    <br>
                                    @permission('update-infos')
                                    <a href="{{ url('admin/stores/product_info',$store->id) }}"
                                       class="btn btn-outline btn-circle btn-sm dark">
                                        <i class="fa fa-plus"></i>تعديل بيانات المخزن
                                    </a>
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
