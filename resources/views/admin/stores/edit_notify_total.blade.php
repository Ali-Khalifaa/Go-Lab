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
    <h6 class="page-title"> لا يجب ان تكون نسبة المكافأه اكبر من نسبة المكسب! </h6>
    @include('partials._errors')

    <div class="row">
        <div class="col-md-12">
            <div class="portlet light form-fit bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-social-dribbble font-green"></i>
                        <span
                            class="caption-subject font-green bold uppercase">تعديل المكافأه خاص لمخزن {{$store->name}}</span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <br>
                    <form method="POST" action="{{ url('admin/stores/update_notify_total/'.$notify->id) }}"
                          enctype="multipart/form-data"
                          categories-parsley-validate="" class="form-horizontal form-label-left">
                        <input name="_method" type="hidden" value="PUT">
                        <input type="hidden" name="store_id" value="{{$store->id}}">
                        {{ csrf_field() }}

                        <div class="form-body">
                            @foreach($products as $index => $product)
                                <?php
                                $info = $product->infos()->wherePivot('store_id', '=', $store->id)->get();
                                $notify_units = $notify->notify_units();
                                $notify_unit = $notify_units->where('product_id', $product->id)->get()->first();
                                $true = true;
                                if (empty($notify_unit)) {
                                    $true = false;
                                }
                                ?>

                                <div class="form-group">
                                    <input type="hidden" name="info[{{$product->id}}][product_id]"
                                           value="{{$product->id}}">
                                    <input type="hidden" name="store_id" value="{{$store->id}}">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="from_price">اسم المنتج
                                        : {{$product->name}}</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <div class="row">
                                            <div class=" col-md-3">
                                                <label class="control-label" for="inputEmail4">% نسبة المكافأه
                                                    قطاعي</label>
                                                <input type="number" min="0"
                                                       max="{{$info->first()->sp_unit_percentage}}"
                                                       value="{{$true?$notify_unit->discount_unit:''}}"
                                                       name="info[{{$product->id}}][discount_unit]" class="form-control"
                                                       id="inputEmail4">
                                            </div>
                                            <div class=" col-md-3">
                                                <label class="control-label" for="inputEmail4"> % نسبة المكسب
                                                    قطاعي</label>
                                                <input type="number" readonly
                                                       value="{{$info->first()->sp_unit_percentage}}"
                                                       name="info[{{$product->id}}][revenue_unit]" class="form-control"
                                                       id="inputPassword4">
                                            </div>
                                            <div class=" col-md-3">
                                                <label class="control-label" for="inputEmail4">% نسبة المكافأه
                                                    جملة</label>
                                                <input type="number" min="0"
                                                       max="{{$info->first()->sp_total_percentage}}"
                                                       value="{{$true?$notify_unit->discount_total:''}}"
                                                       name="info[{{$product->id}}][discount_total]"
                                                       class="form-control"
                                                       id="inputPassword4">
                                            </div>
                                            <div class=" col-md-3">
                                                <label class="control-label" for="inputEmail4">% نسبة المكسب
                                                    جملة</label>
                                                <input type="number" readonly
                                                       value="{{$info->first()->sp_total_percentage}}"
                                                       name="info[{{$product->id}}][revenue_total]" class="form-control"
                                                       id="inputPassword4">
                                            </div>
                                            <div class=" col-md-3">
                                                <label class="control-label" for="inputEmail4">نسبة المكافأه الفورية
                                                    قطاعي</label>
                                                <input type="number" min="0"
                                                       max="{{$info->first()->sp_total_percentage}}"
                                                       value="{{$true?$notify_unit->discount_total:''}}"
                                                       name="info[{{$product->id}}][discount_total]"
                                                       class="form-control"
                                                       id="inputPassword4">
                                            </div>
                                            <div class=" col-md-3">
                                                <label class="control-label" for="inputEmail4">نسبة المكافأه الأجلة
                                                    قطاعي</label>
                                                <input type="number" min="0"
                                                       max="{{$info->first()->sp_unit_percentage}}"
                                                       value="{{$true?$notify_unit->later_unit:''}}"
                                                       name="info[{{$product->id}}][later_unit]" class="form-control"
                                                       id="inputEmail4">
                                            </div>
                                            <div class=" col-md-3">
                                                <label class="control-label" for="inputEmail4">نسبة المكافأه الفورية
                                                    جملة</label>
                                                <input type="number" min="0"
                                                       max="{{$info->first()->sp_total_percentage}}"
                                                       value="{{$true?$notify_unit->now_total:''}}"
                                                       name="info[{{$product->id}}][now_total]" class="form-control"
                                                       id="inputEmail4">
                                            </div>
                                            <div class=" col-md-3">
                                                <label class="control-label" for="inputEmail4">نسبة المكافأه الأجلة
                                                    جملة</label>
                                                <input type="number" min="0"
                                                       max="{{$info->first()->sp_total_percentage}}"
                                                       value="{{$true?$notify_unit->later_total:''}}"
                                                       name="info[{{$product->id}}][later_total]" class="form-control"
                                                       id="inputEmail4">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button class="btn btn-primary" type="button"><a href="{{url('/')}}/admin/stores"
                                                                                     style="color:white">إلغاء</a>
                                    </button>
                                    <button class="btn btn-primary" type="reset">إعاده</button>
                                    <button type="submit" class="btn btn-success">تعديل</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>تعديل المكافأه خاص لمخزن {{$store->name}}</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <div class="ui warning message">
                                <div class="header">
                                    ملحوظة
                                </div>
                                لا يجب ان تكون نسبة المكافأه اكبر من نسبة المكسب!
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
                    <form method="POST" action="{{ url('admin/stores/update_notify_total/'.$notify->id) }}"
                          enctype="multipart/form-data" categories-parsley-validate=""
                          class="form-horizontal form-label-left">
                        <input name="_method" type="hidden" value="PUT">
                        <input type="hidden" name="store_id" value="{{$store->id}}">

                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_id"> المنتجات الغير
                                مشملة بالعرض
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control select2-multiple" id="members_dropdown" multiple="" required
                                        id="exampleFormControlSelect1" class="form-control col-md-6 col-xs-12"
                                        name="products[]">
                                    @foreach ($products as $product)
                                        <option
                                            value="{{$product->id}}" {{$notify->products->contains($product->id)?'selected' : ''}}>{{$product->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="dtBox"></div>
                            <div class="ui toggle checkbox col-md-3 col-sm-3 col-xs-12">
                                <input type="checkbox" id="selectall">
                                <label>تحديد الكل</label>
                            </div>
                        </div>
                        {{--                        <div class="form-group">--}}
                        {{--                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="products"> المنتجات الغير--}}
                        {{--                                مشملة بالعرض--}}
                        {{--                            </label>--}}
                        {{--                            <div class="col-md-6 col-sm-6 col-xs-12">--}}
                        {{--                                <select class="ui fluid search dropdown" id="members_dropdown" multiple="" required--}}
                        {{--                                        id="products" class="form-control col-md-6 col-xs-12" name="products[]">--}}
                        {{--                                    @foreach ($products as $product)--}}
                        {{--                                        <option value="{{$product->id}}" {{$notify->products->contains($product->id)?'selected' : ''}}>{{$product->name}}</option>--}}
                        {{--                                    @endforeach--}}
                        {{--                                </select>--}}
                        {{--                            </div>--}}
                        {{--                            <div id="dtBox"></div>--}}
                        {{--                            <div class="ui toggle checkbox">--}}
                        {{--                                <input type="checkbox" id="selectall">--}}
                        {{--                                <label>تحديد الكل</label>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}

                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button class="btn btn-primary" type="button"><a href="{{url('/')}}/admin/stores"
                                                                                 style="color:white">إلغاء</a></button>
                                <button class="btn btn-primary" type="reset">إعاده</button>
                                <button type="submit" class="btn btn-success">تعديل</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
