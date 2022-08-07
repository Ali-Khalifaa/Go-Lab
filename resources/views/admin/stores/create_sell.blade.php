@extends('layouts.main-old-jemy')
@section('content')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>بيع مباشر من مخزن {{$store->name}}</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <div class="ui warning message">
                                <div class="header">
                                    ملحوظة
                                </div>
                                لا يجب ان تكون كمية البيع اكبر من الكمية الموجودة بالمخزن!
                            </div>
                        </li>
                        <li>
                            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br>
                    <form method="POST" action="{{ route('store_sell') }}" id="submit_form" enctype="multipart/form-data"
                          class="form-horizontal form-label-left">

                        {{ csrf_field() }}
                        {{ method_field('post')}}

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="user_id"> اسم العميل </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="ui fluid search selection dropdown">
                                    <input type="hidden" name="user_id" value="{{old('user_id')}}">
                                    <i class="dropdown icon"></i>
                                    <div class="default text"> اسم العميل</div>
                                    <div class="menu">
                                        @foreach ($users as $user)
                                            <div class="item" data-value="{{ $user->id }}">{{ $user->name }}</div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="store_id" value="{{$store->id}}">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_id">المنتجات
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="ui fluid search dropdown" id="members_dropdown" multiple="" required
                                        id="exampleFormControlSelect1" class="form-control col-md-6 col-xs-12"
                                        name="products[]">
                                    @foreach ($products as $product)
                                        <option class="{{$product->id}} "
                                                value="{{$product->id}}">{{$product->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="dtBox"></div>
                            <div class="ui toggle checkbox">
                                <input type="checkbox" id="selectall">
                                <label>تحديد الكل</label>
                            </div>
                        </div>

                        @foreach($products as $product)
                            @if($product->infos()->wherePivot('store_id','=',$store->id)->get()->first()!=null)
                                <div class="{{$product->id}} box-custom">
                                    <?php
                                    $info = $product->infos()->wherePivot('store_id', '=', $store->id)->get();
                                    ?>
                                    <label>اسم المنتج : {{$product->name}}</label>
                                    <div class="ln_solid"></div>

                                    <input type="hidden" name="info[{{$product->id}}][product_id]"
                                           value="{{$product->id}}">
                                    <input type="hidden" name="info[{{$product->id}}][info_id]"
                                           value="{{$info->first()->id}}">

                                    <div class="form-row">
                                        <div class="form-group col-md-2">
                                            <label for="inputEmail4">الكمية المطلوبة جملة</label>
                                            <input type="number" value="0" min="0" max="{{$info->first()->quantity}}"
                                                   name="info[{{$product->id}}][quantity_total]"
                                                   class="form-control gomlaQuantity" id="gomlaQuantity">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="inputPassword4">الكمية الموجودة بالمخزن</label>
                                            <input type="text" readonly
                                                   value="({{$product->unit_type}}){{$info->first()->quantity}}"
                                                   class="form-control" id="inputPassword4">
                                        </div>
{{--                                                                            <div class="form-group col-md-2">--}}
{{--                                                                                <label for="inputPassword4">الكمية المطلوبة قطاعى</label>--}}
                                                                                <input type="hidden" value="0" min="0"
                                                                                       max="{{$info->first()->quantity_unit}}"
                                                                                       name="info[{{$product->id}}][quantity_unit]"
                                                                                       class="form-control unitQuantity" id="unitQuantity">
{{--                                                                            </div>--}}
                                    {{--                                        <div class="form-group col-md-2">--}}
                                    {{--                                            <label for="inputPassword4">الكمية الموجودة بالمخزن</label>--}}
                                    {{--                                            <input type="text" readonly--}}
                                    {{--                                                   value="({{$product->subunit_type}}){{$info->first()->quantity_unit}}"--}}
                                    {{--                                                   class="form-control" id="inputPassword4">--}}
                                    {{--                                        </div>--}}

                                    <?php

                                    $product_info = $product->infos()->wherePivot('store_id', '=', $store->id)->get()->first();
                                    $price_total = $product_info->sell_total;
                                    $price_total_sum = $product->quantity_total * ($product_info->sell_total);
                                    $price_unit = $product_info->sell_unit_original / $product->quantity_unit;
                                    $price_unit_sum = $product->quantity_unit * ($product->sell_unit_original / $product->quantity_unit);
                                    $total_price_for_item = $price_total_sum + $price_unit_sum;

                                    ?>



                                    <!--<td>({{ $product->receive_total?$product->receive_total:"----" }}) {{ $product->receive_unit?$product->receive_unit:"----" }}</td>-->

                                    <!--<td>({{ $product->recall_total?$product->recall_total:"----" }}) {{ $product->recall_unit?$product->recall_unit:"----" }}</td>-->
                                        <!--<td>-->
                                    <!--({{ $price_total_sum?$price_total_sum:"----" }})+{{ $price_unit_sum?number_format($price_unit_sum,2):"----" }} =-->
                                    <!-- {{number_format($price_unit_sum,2)+ $price_total_sum }} -->
                                        <!--</td>-->

                                        <div class="form-group col-md-2">
                                            <label for="inputPassword4"> السعر جمله</label>
                                            <input type="text" readonly value="{{$product_info->sell_total}}"
                                                   class="form-control gomlaPrice" id="gomlaPrice">
                                            <input type="hidden" value="{{$product_info->sell_total}}"
                                                   class="form-control baseGomlaPrice" id="baseGomlaPrice">
                                        </div>

{{--                                        <div class="form-group col-md-2">--}}
{{--                                            <label for="inputPassword4">السعر قطاعى</label>--}}
{{--                                            <input type="text" readonly value="{{($product_info->sell_unit($product))}}"--}}
{{--                                                   class="form-control unitPrice" id="unitPrice">--}}
{{--                                            <input type="hidden" value="{{($product_info->sell_unit($product))}}"--}}
{{--                                                   class="form-control baseUnitPrice" id="baseUnitPrice">--}}
{{--                                        </div>--}}
                                    </div>
{{--                                    <div class="row">--}}
{{--                                        <div class="form-group col-md-2">--}}
{{--                                            <label for="inputEmail4">نسبة المكافأه الفورية قطاعي</label>--}}
{{--                                            <input type="number" min="0" max="{{$info->first()->sp_unit_percentage}}"--}}
{{--                                                   value="0" name="info[{{$product->id}}][now_unit]"--}}
{{--                                                   class="form-control" id="inputEmail4">--}}
{{--                                        </div>--}}
{{--                                        <div class="form-group col-md-2">--}}
{{--                                            <label for="inputEmail4">نسبة المكافأه الأجلة قطاعي</label>--}}
{{--                                            <input type="number" min="0" max="{{$info->first()->sp_unit_percentage}}"--}}
{{--                                                   value="0" name="info[{{$product->id}}][later_unit]"--}}
{{--                                                   class="form-control" id="inputEmail4">--}}
{{--                                        </div>--}}

{{--                                        <div class="form-group col-md-2">--}}
{{--                                            <label for="inputEmail4">نسبة المكافأه الفورية جملة</label>--}}
{{--                                            <input type="number" min="0" max="{{$info->first()->sp_total_percentage}}"--}}
{{--                                                   value="0" name="info[{{$product->id}}][now_total]"--}}
{{--                                                   class="form-control" id="inputEmail4">--}}
{{--                                        </div>--}}
{{--                                        <div class="form-group col-md-2">--}}
{{--                                            <label for="inputEmail4">نسبة المكافأه الأجلة جملة</label>--}}
{{--                                            <input type="number" min="0" max="{{$info->first()->sp_total_percentage}}"--}}
{{--                                                   value="0" name="info[{{$product->id}}][later_total]"--}}
{{--                                                   class="form-control" id="inputEmail4">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                </div>
                            @endif
                        @endforeach

                        <div class="form-actions">
                            <div class="col-md-12 col-sm-6 col-xs-12 col-md-offset-3">
                                <button class="btn btn-primary" type="button"><a href="{{ url()->previous() }}"
                                                                                 style="color:white">إلغاء</a></button>
                                <button class="btn btn-primary" type="reset">إعاده</button>
                                <button type="submit" onclick="event.preventDefault();document.getElementById('submit_form').submit()" class="btn btn-success">اتمام</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
