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
    <h2 class="page-title">  {{$store->name}}
        ( نواقص مخزن ) </h2>
    <h6 class="page-title">امين المخزن: {{$store->store_keeper->name }}</h6>
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">جدول عرض تفاصيل انواع الانشطه</span>
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
                            <th><i class="fa fa-object-group"></i> اسم الفئة</th>
                            <th><i class="fa fa-object-group"></i> الكمية جمله</th>

                            <th><i class="fa fa-object-group"></i> نوع القطعه</th>
                            <th><i class="fa fa-object-group"></i> نوع الوحدة</th>
                            <th><i class="fa fa-object-group"></i> حد اعادة الطلب</th>
                            <th><i class="fa fa-object-group"></i> سعر الشراء</th>

                            <th><i class="fa fa-object-group"></i> سعر البيع جملة</th>

                        </tr>
                        </thead>
                        <tbody>

                        @foreach($array as $i => $product)
                            <?php
                            $info = $product->infos()->wherePivot('store_id', '=', $store->id)->get()->first();
                            ?>

                            <tr>
                                <th scope="row">{{++$i}}</th>
                                <td>{{$product->name}}</td>
                                <td>{{$product->company->name}}</td>
                                <td>{{$product->category->name}}</td>
                                <td>
                                    {{$info->quantity}}
                                    @if($info->quantity < $info->reorder_limit)
                                        <a class="ui label red tiny">
                                            اعد الطلب
                                        </a>
                                    @endif
                                </td>

                                <td>{{$product->subunit_type}} </td>
                                <td>{{$product->unit_type}} </td>
                                <td>{{$info->reorder_limit}} </td>
                                <td>{{$info->buy_price}} </td>
                                <td>{{$info->sell_total}} </td>

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
