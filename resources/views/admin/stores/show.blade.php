@extends('layouts.main')
@section('content')

    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{url('/admin')}}">لوحة التحكم</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{{url('/admin/stores')}}">المخازن </a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>{{$store->name}}</span>
            </li>
        </ul>

    </div>
    {{--    @if(empty($store->notify))--}}
    {{--        @permission('create-notifies')--}}
    {{--        <a href="{{ url('admin/stores/create_notify/'.$store->id) }}" class="btn blue">--}}
    {{--            <i style="margin: 0 3px 0 3px" class="fa fa-plus"></i>اضافه مكافأه</a>--}}
    {{--        @endpermission--}}
    {{--    @else--}}
    {{--        @permission('update-notifies')--}}
    {{--        <a href="{{ url('admin/stores/edit_notify/'.$store->notify->id) }}" class="btn blue">--}}
    {{--            <i class="fa fa-edit"></i>تعديل المكافأه</a>--}}
    {{--        @endpermission--}}
    {{--        @permission('delete-notifies')--}}
    {{--        <a onclick="return confirm('هل انت متأكد')" href="{{ url('admin/stores/delete_notify/'.$store->notify->id) }}"--}}
    {{--           class="btn green">--}}
    {{--            <i class="fa fa-trash"></i>ازالة المكافأه</a>--}}
    {{--        @endpermission--}}
    {{--    @endif--}}
    {{--    @if(empty($store->notify_total))--}}
    {{--        @permission('create-notifies')--}}
    {{--        <a href="{{ url('admin/stores/create_notify_total/'.$store->id) }}" class="btn blue">--}}
    {{--            <i style="margin: 0 3px 0 3px" class="fa fa-plus"></i>اضافه مكافأه فاتورة</a>--}}
    {{--        @endpermission--}}
    {{--    @else--}}
    {{--        @permission('update-notifies')--}}
    {{--        <a href="{{ url('admin/stores/edit_notify_total/'.$store->notify_total->id) }}" class="btn blue">--}}
    {{--            <i class="fa fa-edit"></i>تعديل مكافأه الفاتورة</a>--}}
    {{--        @endpermission--}}
    {{--        @permission('delete-notifies')--}}
    {{--        <a onclick="return confirm('هل انت متأكد')"--}}
    {{--           href="{{ url('admin/stores/delete_notify_total/'.$store->notify_total->id) }}" class="btn green">--}}
    {{--            <i class="fa fa-trash"></i>ازالة مكافأه الفاتورة</a>--}}
    {{--        @endpermission--}}
    {{--    @endif--}}
    {{--    @permission('create-direct_sells')--}}
    {{--    <a href="{{ url('admin/store/direct_sell') }}" class="btn blue">--}}
    {{--        <i style="margin: 0 3px 0 3px" class="fa fa-shopping-basket"></i> بيع مباشر--}}
    {{--    </a>--}}
    {{--    @endpermission--}}
    {{--    @permission('create-transfers')--}}
    {{--    <a href="{{ url('admin/store/create_transfer') }}" class="btn blue">--}}
    {{--        <i style="margin: 0 3px 0 3px" class="fa fa-car"></i> نقل بضاعه لمخزن--}}
    {{--        اخر </a>--}}
    {{--    @endpermission--}}
    @permission('update-infos')
    <a href="{{ url('admin/stores/product_info',$store->id) }}" class="btn blue">
        <i class="fa fa-edit"></i> تعديل بيانات المخزن </a>
    @endpermission

    <a href="{{ url('admin/stores/product_needed',$store->id) }}" class="btn blue"><i class="fa fa-circle-o"></i> نواقص
        المخزن </a>


    @permission('read-statistics')
    <a href="{{ url('/admin/totals/income_store_total',$store->id) }}" class="btn blue">
        <i class="fa fa-eye"></i>احصائيات
        المنتجات المباعه</a>
    @endpermission
    @permission('read-statistics')
    <a href="{{ url('/admin/stores/shift_logs',$store->id) }}" class="btn blue">
        <i class="fa fa-eye"></i>سجل الشيفتات</a>


    @endpermission
    @permission('read-statistics')
    <a href="{{ url('/admin/stores/shift_finance_logs',$store->id) }}" class="btn blue">
        <i class="fa fa-eye"></i>سجل
        شيفتات المالية</a>

    @endpermission
    @permission('read-stores')
    <!--<a href="{{ url('/admin/store/'.$store->id.'/store_keepers') }}" class="btn blue">-->
    <!--    <i class="fa fa-eye"></i>امناء-->
    <!--    المخزن</a>-->

    @endpermission
    @if(!empty(Auth::user()->keeper_store()->get()->first()))
        @if(!$check)
            @if(!$receive_shift)
                <a href="{{ url('/admin/store/switch') }}" class="btn blue"><i class="fa fa-circle-o"></i>تسليم
                    الشيفت</a>
            @else
                <a href="{{ url('/admin/store/receive') }}" class="btn blue"><i class="fa fa-circle-o"></i>استلام
                    الشيفت</a>
            @endif
        @else
            <a href="#" style="color: black" class="btn green"><i class="fa fa-circle-o"></i>بانتظار موافقة نقل
                الشيفت</a>
        @endif
    @endif
    {{--    @if(!empty(Auth::user()->manager_store()->get()->first()))--}}
    {{--        @if($store->store_managers->contains(Auth::user()->id))--}}
    {{--            <a href="{{ route('store.finance_in', $store->id) }}" class="btn blue"><i--}}
    {{--                    class="fa fa-circle-o"></i>--}}
    {{--                الايرادات</a>--}}
    {{--            <a href="{{ route('store.finance_out', $store->id) }}" class="btn blue"><i--}}
    {{--                    class="fa fa-circle-o"></i>--}}
    {{--                المصروفات</a>--}}
    {{--        @endif--}}
    {{--    @endif--}}
    @if(!empty(Auth::user()->finance_manager_store()->get()->first()))
        @if(Auth::user()->id == $store->store_finance_manager->id)
            <a href="{{ route('store.finance_mandobs', $store->id) }}" class="btn blue"><i
                    class="fa fa-circle-o"></i>
                حسابات المندوبين</a>
        @endif

        {{--        @if(Auth::user()->id == $store->store_finance_manager->id)--}}
        {{--            <a href="{{ route('store.finance_out', $store->id) }}" class="btn blue"><i--}}
        {{--                    class="fa fa-circle-o"></i>--}}
        {{--                المصروفات</a>--}}
        {{--            <a href="{{ route('store.finance_in', $store->id) }}" class="btn blue"><i--}}
        {{--                    class="fa fa-circle-o"></i>--}}
        {{--                الايرادات</a>--}}
        {{--        @endif--}}

        @if(!$check_finance)
            @if(!$receive_shift_finance)
                <a href="{{ url('/admin/store/switch_finance') }}" class="btn blue"><i class="fa fa-circle-o"></i>تسليم
                    الشيفت</a>
            @else
                <a href="{{ url('/admin/store/receive_finance') }}" class="btn blue"><i class="fa fa-circle-o"></i>استلام
                    الشيفت</a>
            @endif
        @else
            <a href="#" style="color: black" class="btn blue"><i class="fa fa-circle-o"></i>بانتظار موافقة نقل
                الشيفت</a>
        @endif
    @endif
    @if(!empty(Auth::user()->manager_store()->get()->first()))
        <a href="{{ url('/admin/store/supplier_depts',$store->id) }}" class="btn blue"><i class="fa fa-circle-o"></i>المتبقى
            لنا من الموردين
        </a>
    @endif


    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span
                            class="caption-subject bold uppercase">جدول عرض تفاصيل مخزن : {{$store->name}}</span>
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                        <thead>
                        <tr>
                            <th><i class="fa fa-cogs"></i></th>
                            <th><i class="fa fa-object-group"></i> اسم المنتج</th>
                            <th><i class="fa fa-object-group"></i> اسم الشركة</th>
                            {{--                            <th><i class="fa fa-object-group"></i> اسم الفئة الفرعى</th>--}}
                            <th><i class="fa fa-object-group"></i> الكمية</th>
                            <th><i class="fa fa-object-group"></i> الكمية بالوحدة</th>
                            <th><i class="fa fa-object-group"></i> نوع القطعه</th>
                            <th><i class="fa fa-object-group"></i> نوع الوحدة</th>
                            <th><i class="fa fa-object-group"></i> حد اعادة الطلب</th>
                            @if($can_see)
                                <th><i class="fa fa-object-group"></i> سعر الشراء</th>
                            @endif
                            {{--                            <th><i class="fa fa-object-group"></i> سعر البيع تجزئة</th>--}}
                            {{--                            <th><i class="fa fa-object-group"></i> السعر بعد الخصم تجزئة</th>--}}
                            <th><i class="fa fa-object-group"></i> سعر البيع جملة</th>
                            <th><i class="fa fa-object-group"></i> السعر بعد الخصم جملة</th>
                            {{--                            <th><i class="fa fa-bookmark"></i> عرض </th>--}}

                        </tr>
                        </thead>
                        <tbody>

                        @foreach($products as $i => $product)
                            <?php
                            $info = $product->infos()->wherePivot('store_id', '=', $store->id)->get()->first();
                            ?>

                            <tr>
                                <td scope="row">{{ $i + 1}}</td>

                                <td>{{$product->name}}</td>
                                <td>{{$product->company->name}}</td>
                                {{--                                <td>{{$product->subcategory->name}}</td>--}}
                                <td>
                                    {{$info->quantity}}
                                    @if($info->quantity < $info->reorder_limit)
                                        <a class="ui label red tiny" style="color: red">
                                            اعد الطلب
                                        </a>
                                    @endif
                                </td>
                                <td>{{$info->quantity * $product->quantity_unit }} </td>
                                <td>{{$product->subunit_type}} </td>
                                <td>{{$product->unit_type}} </td>
                                <td>{{$info->reorder_limit}} </td>
                                @if($can_see)
                                    <td>{{$info->buy_price}} </td>
                                @endif
                                <td>{{ $product->price_total }} </td>
                                <td>
                                    @if($product->date_end >= now())
                                    {{ $product->discount_total == null ? "------" :  $product->price_total - $product->discount_total }}
                                    @else
                                        ------
                                    @endif
                                </td>
                                {{--                                <td>{{$product->price_unit}} </td>--}}
                                {{--                                <td>--}}
                                {{--                                    {{ $product->discount_unit == null ? "------" :  $product->price_unit - $product->discount_unit }}--}}
                                {{--                                </td>--}}


                                {{--                <td>--}}
                                {{--                <a href="{{url('admin/stores/'.$store['id'].'/edit')}}" class="btn btn-success" >--}}
                                {{--                <span class="glyphicon glyphicon-edit"></span>--}}
                                {{--                 </a>--}}
                                {{--                <a href="{{ url('admin/stores/product_info',$store->id) }}">--}}
                                {{--                    <i class="fa fa-plus"></i>اسعار المنتجات--}}
                                {{--                </a>--}}


                                {{--                 <form method="POST" onclick="return confirm('هل انت متأكد؟')" action="{{ url('admin/stores/'.$store['id']) }}"  style="display:inline" >--}}

                                {{--                <button name="_method" type="hidden" value="DELETE" class="btn btn-default btn-sm">--}}
                                {{--                <span class="glyphicon glyphicon-remove"></span>--}}
                                {{--                </button>--}}
                                {{--                <input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
                                {{--                </form>--}}

                                {{--               </td>--}}

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
