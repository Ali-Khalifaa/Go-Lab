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
                <span>المنتجات</span>
            </li>
        </ul>

    </div>
    @permission('create-products')
    <a href="{{ url('admin/products/create') }}" class="btn green"> أضافة
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
                        <span class="caption-subject bold uppercase">جدول عرض تفاصيل المنتجات</span>
                    </div>
                    <div class="tools"> </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                        <thead>
                        <tr>
                            <th> <i class="fa fa-cogs"></i></th>
                            <th><i class="fa fa-object-group"></i> اسم المنتج </th>
                            <th><i class="fa fa-object-group"></i> الصوره </th>
                            <th><i class="fa fa-object-group"></i>الكود </th>
                            <th><i class="fa fa-object-group"></i>ايقاف المنتج </th>
                            <th><i class="fa fa-object-group"></i>تاريخ انتهاء الخصم</th>
                            <th><i class="fa fa-bookmark"></i> عرض </th>

                        </tr>
                        </thead>
                        <tbody>

                        @foreach($products as $product)

                            <tr>
                                <td scope="row">{{ $product['rank_code']}}</td>

                                <td>{{ $product['name'] }}</td>
                                <td>
                                    <img src="{{asset('uploads/products/'.$product->image)}}" alt="Image"
                                         style="width:50px;height:50px;margin-left:30px;">
                                </td>
                                <td>{{ $product['code'] }}</td>
                                <td>{{ $product['date_end'] ? $product['date_end'] : "لا يوجد خصم" }}</td>

                                <td>

                                    @permission('update-products')
                                    @if($product->is_hidden != 0)

                                        <form method="post" onclick="return confirm('هل انت متأكد من تفعيل المنتج؟')" action="{{ url('admin/products/deactive/'.$product['id']) }}"  style="display:inline" >
                                            {{ csrf_field() }}

                                            <button href="" class="btn btn-outline btn-circle btn-sm blue">
                                                <i class="fa fa-edit"></i> تفعيل </button>

                                        </form>
                                    @elseif($product->is_hidden != 1)
                                        <form method="post" onclick="return confirm('هل تريد عمل ايقاف للمنتج؟')" action="{{ url('admin/products/active/'.$product['id']) }}"  style="display:inline" >
                                            {{ csrf_field() }}
                                            <button class="btn btn-outline btn-circle btn-sm red">
                                                <i class="fa fa-edit"></i>ايقاف التفعيل </button>

                                        </form>
                                    @else
                                    @endif
                                    @endpermission
                                </td>

                                <td>
                                    @permission('update-products')
                                    <a href="{{url('admin/products/'.$product['id'].'/edit')}}" class="btn btn-outline btn-circle btn-sm purple">
                                        <i class="fa fa-edit"></i> تعديل </a>
                                    <a href="{{route('productImg.index', $product['id'])}}" class="btn btn-outline btn-circle btn-sm blue">
                                        <i class="fa fa-edit"></i> صور المنتج </a>

                                    <a href="{{route('productDiscount.edit', $product['id'])}}" class="btn btn-outline btn-circle btn-sm green">
                                        <i class="fa fa-dollar"></i>{{$product['date_end'] ? "تعديل الخصم" : "اضافة خصم"}} </a>

                                    @endpermission

                                    <a href="{{url('admin/products/'.$product['id'].'/print_barcode')}}"
                                       class="btn btn-outline btn-circle btn-sm blue">
                                        <i class="fa fa-print"></i> طباعة البار كود
                                    </a>
                                    @if($product['recently_arrived']==0)
                                        <a href="{{url('admin/products/'.$product['id'].'/add_recently_arrived')}}"
                                           class="btn btn-outline btn-circle btn-sm purple">
                                            <i class="fa fa-bell"></i> اضافة الى احدث المنتجات
                                        </a>
                                    @else
                                        <a href="{{url('admin/products/'.$product['id'].'/remove_recently_arrived')}}"
                                           class="btn btn-outline btn-circle btn-sm red">
                                            <i class="fa fa-bell-slash"></i> حذف من احدث المنتجات

                                        </a>
                                    @endif


                                    @permission('delete-products')

                                    {{--                         <form method="POST" onclick="return confirm('هل انت متأكد؟')" action="{{ url('admin/products/'.$product['id']) }}"  style="display:inline" >--}}
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
@section('js')
    <script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#table_id').DataTable();
        });
    </script>
@endsection
