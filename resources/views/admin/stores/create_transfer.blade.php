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
    <h2 class="page-title"> ملحوظة </h2>
    <h6 class="page-title">لا يجب ان تكون الكمية المنقولة اكبر من الكمية الموجودة بالمخزن!</h6>
    @include('partials._errors')

    <div class="row">
        <div class="col-md-12">
            <div class="portlet light form-fit bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-social-dribbble font-green"></i>
                        <span
                            class="caption-subject font-green bold uppercase">نقل بضاعه من مخزن {{$store->name}}</span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <br>
                    <form method="POST" action="{{ route('store_transfer') }}" enctype="multipart/form-data"
                          categories-parsley-validate="" class="form-horizontal form-label-left">

                        {{ csrf_field() }}

                        <div class="form-body">

                            <div class="form-group ">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="form_control_1">المخزن
                                    المنقول اليه</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="to_store" id="form_control_1">
                                        @foreach ($stores as $item)
                                            @if($item->id != $store->id)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>

                                            @endif
                                        @endforeach

                                    </select>
                                    <div class="form-control-focus"></div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="form_control_1">المندوب
                                    المسؤل عن
                                    النقل</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="mandob_id" id="form_control_1">
                                        @foreach ($mandobs as $mandob)
                                            <option value="{{ $mandob->id }}">{{ $mandob->name }}</option>

                                        @endforeach

                                    </select>
                                    <div class="form-control-focus"></div>
                                </div>
                            </div>

                            <input type="hidden" name="store_id" value="{{$store->id}}">

                            @foreach($products as $product)
                                @if($product->infos()->wherePivot('store_id','=',$store->id)->get()->first()!=null)
                                    <div class="form-group">
                                        <?php
                                        $info = $product->infos()->wherePivot('store_id', '=', $store->id)->get();
                                        ?>
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="from_price">اسم
                                            المنتج : {{$product->name}}</label>
                                        {{--                                        <label>اسم المنتج : {{$product->name}}</label>--}}
                                        <div class="ln_solid"></div>

                                        <input type="hidden" name="info[{{$product->id}}][product_id]"
                                               value="{{$product->id}}">
                                        <input type="hidden" name="info[{{$product->id}}][info_id]"
                                               value="{{$info->first()->id}}">

                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <div class="form-row row">
                                                <div class=" col-md-3">
                                                    <label class="control-label" for="inputEmail4">الكمية المطلوبة
                                                        جملة</label>
                                                    <input type="number" value="0" min="0"
                                                           max="{{$info->first()->quantity}}"
                                                           name="info[{{$product->id}}][quantity_total]"
                                                           class="form-control"
                                                           id="inputEmail4">
                                                </div>
                                                <div class=" col-md-3">
                                                    <label class="control-label" for="inputPassword4">الكمية الموجودة
                                                        بالمخزن</label>
                                                    <input type="text" readonly
                                                           value="({{$product->unit_type}}){{$info->first()->quantity}}"
                                                           class="form-control" id="inputPassword4">
                                                </div>
                                                <div class=" col-md-3">
{{--                                                    <label class="control-label" for="inputPassword4">الكمية المطلوبة--}}
{{--                                                        قطاعى</label>--}}
                                                    <input type="hidden" value="0" min="0"
                                                           max="{{$info->first()->quantity_unit}}"
                                                           name="info[{{$product->id}}][quantity_unit]"
                                                           class="form-control"
                                                           id="inputPassword4">
                                                </div>
                                                <div class=" col-md-3">
{{--                                                    <label class="control-label" for="inputPassword4">الكمية الموجودة--}}
{{--                                                        بالمخزن</label>--}}
                                                    <input type="hidden" readonly
                                                           value="({{$product->subunit_type}}){{$info->first()->quantity_unit}}"
                                                           class="form-control" id="inputPassword4">
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                @endif
                            @endforeach


                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button class="btn btn-primary" type="button"><a href="{{url('/')}}/admin/stores"
                                                                                     style="color:white">إلغاء</a>
                                    </button>
                                    <button class="btn btn-primary" type="reset">إعاده</button>
                                    <button type="submit" class="btn btn-success">اتمام</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


    {{--    <div class="row">--}}
    {{--        <div class="col-md-12 col-sm-12 col-xs-12">--}}
    {{--            <div class="x_panel">--}}

    {{--                <div class="x_content">--}}
    {{--                    <br>--}}
    {{--                    <form method="POST" action="{{ route('store_transfer') }}" enctype="multipart/form-data"--}}
    {{--                          categories-parsley-validate="" class="form-horizontal form-label-left">--}}

    {{--                        {{ csrf_field() }}--}}
    {{--                        <div class="form-group">--}}
    {{--                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="user_id"> المخزن المنقول--}}
    {{--                                اليه </label>--}}
    {{--                            <div class="col-md-6 col-sm-6 col-xs-12">--}}
    {{--                                <div class="ui fluid search selection dropdown">--}}
    {{--                                    <input type="hidden" name="to_store" value="{{old('user_id')}}">--}}
    {{--                                    <i class="dropdown icon"></i>--}}
    {{--                                    <div class="default text"> اسم المخزن</div>--}}
    {{--                                    <div class="menu">--}}
    {{--                                        @foreach ($stores as $item)--}}
    {{--                                            @if($item->id != $store->id)--}}
    {{--                                                <div class="item" data-value="{{ $item->id }}">{{ $item->name }}</div>--}}
    {{--                                            @endif--}}
    {{--                                        @endforeach--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                        <div class="form-group">--}}
    {{--                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="mandob_id">المندوب المسؤل عن--}}
    {{--                                النقل</label>--}}
    {{--                            <div class="col-md-6 col-sm-6 col-xs-12">--}}
    {{--                                <div class="ui fluid search selection dropdown">--}}
    {{--                                    <input type="hidden" name="mandob_id" value="{{old('mandob_id')}}">--}}
    {{--                                    <i class="dropdown icon"></i>--}}
    {{--                                    <div class="default text"> اسم المندوب</div>--}}
    {{--                                    <div class="menu">--}}
    {{--                                        @foreach ($mandobs as $mandob)--}}
    {{--                                            <div class="item" data-value="{{ $mandob->id }}">{{ $mandob->name }}</div>--}}
    {{--                                        @endforeach--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}


    {{--                        <input type="hidden" name="store_id" value="{{$store->id}}">--}}

    {{--                        @foreach($products as $index => $product)--}}
    {{--                            <?php--}}
    {{--                            $info = $product->infos()->wherePivot('store_id', '=', $store->id)->get();--}}
    {{--                            ?>--}}
    {{--                            <label>اسم المنتج : {{$product->name}}</label>--}}
    {{--                            <div class="ln_solid"></div>--}}

    {{--                            <input type="hidden" name="info[{{$product->id}}][product_id]" value="{{$product->id}}">--}}
    {{--                            <input type="hidden" name="info[{{$product->id}}][info_id]" value="{{$info->first()->id}}">--}}

    {{--                            <div class="row">--}}
    {{--                                <div class="form-group col-md-2">--}}
    {{--                                    <label for="inputEmail4">الكمية المطلوبة جملة</label>--}}
    {{--                                    <input type="number" value="0" min="0" max="{{$info->first()->quantity}}"--}}
    {{--                                           name="info[{{$product->id}}][quantity_total]" class="form-control"--}}
    {{--                                           id="inputEmail4">--}}
    {{--                                </div>--}}
    {{--                                <div class="form-group col-md-2">--}}
    {{--                                    <label for="inputPassword4">الكمية الموجودة بالمخزن</label>--}}
    {{--                                    <input type="text" readonly--}}
    {{--                                           value="({{$product->unit_type}}){{$info->first()->quantity}}"--}}
    {{--                                           class="form-control" id="inputPassword4">--}}
    {{--                                </div>--}}
    {{--                                <div class="form-group col-md-2">--}}
    {{--                                    <label for="inputPassword4">الكمية المطلوبة قطاعى</label>--}}
    {{--                                    <input type="number" value="0" min="0" max="{{$info->first()->quantity_unit}}"--}}
    {{--                                           name="info[{{$product->id}}][quantity_unit]" class="form-control"--}}
    {{--                                           id="inputPassword4">--}}
    {{--                                </div>--}}
    {{--                                <div class="form-group col-md-2">--}}
    {{--                                    <label for="inputPassword4">الكمية الموجودة بالمخزن</label>--}}
    {{--                                    <input type="text" readonly--}}
    {{--                                           value="({{$product->subunit_type}}){{$info->first()->quantity_unit}}"--}}
    {{--                                           class="form-control" id="inputPassword4">--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                            --}}{{--                    <div class="row">--}}
    {{--                            --}}{{--                            <div class="form-group col-md-2">--}}
    {{--                            --}}{{--                                <label for="inputEmail4">نسبة المكافأه الفورية قطاعي</label>--}}
    {{--                            --}}{{--                                <input type="number"  min ="0" max="{{$info->first()->sp_unit_percentage}}" value="0" name="info[{{$product->id}}][now_unit]" class="form-control" id="inputEmail4" >--}}
    {{--                            --}}{{--                            </div>--}}
    {{--                            --}}{{--                            <div class="form-group col-md-2">--}}
    {{--                            --}}{{--                                <label for="inputEmail4">نسبة المكافأه الأجلة قطاعي</label>--}}
    {{--                            --}}{{--                                <input type="number"  min ="0" max="{{$info->first()->sp_unit_percentage}}" value="0" name="info[{{$product->id}}][later_unit]" class="form-control" id="inputEmail4" >--}}
    {{--                            --}}{{--                            </div>--}}
    {{--                            --}}{{--                            --}}{{----}}{{----}}
    {{--                            --}}{{--                            <div class="form-group col-md-2">--}}
    {{--                            --}}{{--                                <label for="inputEmail4">نسبة المكافأه الفورية جملة</label>--}}
    {{--                            --}}{{--                                <input type="number"  min ="0" max="{{$info->first()->sp_total_percentage}}" value="0" name="info[{{$product->id}}][now_total]" class="form-control" id="inputEmail4" >--}}
    {{--                            --}}{{--                            </div>--}}
    {{--                            --}}{{--                            <div class="form-group col-md-2">--}}
    {{--                            --}}{{--                                <label for="inputEmail4">نسبة المكافأه الأجلة جملة</label>--}}
    {{--                            --}}{{--                                <input type="number"  min ="0" max="{{$info->first()->sp_total_percentage}}" value="0" name="info[{{$product->id}}][later_total]" class="form-control" id="inputEmail4" >--}}
    {{--                            --}}{{--                            </div>--}}
    {{--                            --}}{{--                        </div>--}}
    {{--                        @endforeach--}}

    {{--                        <div class="form-group">--}}
    {{--                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">--}}
    {{--                                <button class="btn btn-primary" type="button"><a href="{{url('/')}}/admin/stores"--}}
    {{--                                                                                 style="color:white">إلغاء</a></button>--}}
    {{--                                <button class="btn btn-primary" type="reset">إعاده</button>--}}
    {{--                                <button type="submit" class="btn btn-success">اتمام</button>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}

    {{--                    </form>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}


@endsection
