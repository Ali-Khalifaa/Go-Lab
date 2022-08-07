@extends('layouts.main')
@section('content')

    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{url('/admin')}}">لوحة التحكم</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{{url('/admin/global_notify')}}">المكافأه العام على جميع المخازن
                </a>

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
                            class="caption-subject font-green bold uppercase">تعديل المكافأه العام على المخازن</span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <br>
                    <form method="POST" action="{{ url('admin/update_global_notify') }}" enctype="multipart/form-data"
                          categories-parsley-validate="" class="form-horizontal form-label-left">
                        <input name="_method" type="hidden" value="PUT">
                        {{ csrf_field() }}

                        <div class="form-body">

                            <div class="form-group">

                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="from_price">بيانات
                                    المكافأه الأساسية</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <div class="row">
                                        <div class=" col-md-3">
                                            <label class="control-label" for="inputEmail4">الحد الادني من السعر
                                                جملة</label>
                                            <input type="number" value="{{$notify->min_total}}" min="1" name="min_total"
                                                   class="form-control" id="inputEmail4" required>
                                        </div>
                                        <div class=" col-md-3">
                                            <label class="control-label" for="inputEmail4">الحد الادني من السعر
                                                قطاعي</label>
                                            <input type="number" value="{{$notify->min_unit}}" min="1" name="min_unit"
                                                   class="form-control" id="inputEmail4" required>
                                        </div>
                                        <div class=" col-md-3">
                                            <label class="control-label" for="inputEmail4">ابتداء من تاريخ</label>
                                            <input type="date" value="{{$notify->from}}" name="from"
                                                   class="form-control"
                                                   id="inputEmail4" required>
                                        </div>
                                        <div class=" col-md-3">
                                            <label class="control-label" for="inputEmail4">يتنهى في تاريخ</label>
                                            <input type="date" value="{{$notify->to}}" name="to" class="form-control"
                                                   id="inputEmail4" required>
                                        </div>

                                    </div>

                                </div>
                            </div>

                            @foreach($products as $index => $product)
                                <?php
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
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="from_price">اسم المنتج
                                        : {{$product->name}}</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <div class="row">
                                            <div class=" col-md-3">
                                                <label class="control-label" for="inputEmail4">% نسبة المكافأه
                                                    قطاعي</label>
                                                <input type="number" min="0"
                                                       value="{{$true?$notify_unit->discount_unit:''}}"
                                                       name="info[{{$product->id}}][discount_unit]" class="form-control"
                                                       id="inputEmail4">
                                            </div>
                                            <div class=" col-md-3">
                                                <label class="control-label" for="inputEmail4">% نسبة المكافأه
                                                    جملة</label>
                                                <input type="number" min="0"
                                                       value="{{$true?$notify_unit->discount_total:''}}"
                                                       name="info[{{$product->id}}][discount_total]"
                                                       class="form-control"
                                                       id="inputPassword4">
                                            </div>
                                            <div class=" col-md-3">
                                                <label class="control-label" for="inputEmail4">نسبة المكافأه الفورية
                                                    قطاعي</label>
                                                <input type="number" min="0" value="{{$true?$notify_unit->now_unit:''}}"
                                                       name="info[{{$product->id}}][now_unit]" class="form-control"
                                                       id="inputEmail4">
                                            </div>

                                            <div class=" col-md-3">
                                                <label class="control-label" for="inputEmail4">نسبة المكافأه الأجلة
                                                    قطاعي</label>
                                                <input type="number" min="0"
                                                       value="{{$true?$notify_unit->later_unit:''}}"
                                                       name="info[{{$product->id}}][later_unit]" class="form-control"
                                                       id="inputEmail4">
                                            </div>
                                            <div class=" col-md-3">
                                                <label class="control-label" for="inputEmail4">نسبة المكافأه الفورية
                                                    جملة</label>
                                                <input type="number" min="0"
                                                       value="{{$true?$notify_unit->now_total:''}}"
                                                       name="info[{{$product->id}}][now_total]" class="form-control"
                                                       id="inputEmail4">
                                            </div>
                                            <div class=" col-md-3">
                                                <label class="control-label" for="inputEmail4">نسبة المكافأه الأجلة
                                                    جملة</label>
                                                <input type="number" min="0"
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
                                    <button class="btn btn-primary" type="button"><a
                                            href="{{url('/')}}/admin/global_notify"
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


    {{--    <div class="row">--}}
    {{--        <div class="col-md-12 col-sm-12 col-xs-12">--}}
    {{--            <div class="x_panel">--}}
    {{--                <div class="x_title">--}}
    {{--                    <h2>تعديل المكافأه العام على المخازن </h2>--}}

    {{--                    <div class="clearfix"></div>--}}
    {{--                </div>--}}
    {{--                <div class="x_content">--}}
    {{--                    <br>--}}
    {{--                    <form method="POST" action="{{ url('admin/update_global_notify') }}" enctype="multipart/form-data"--}}
    {{--                          categories-parsley-validate="" class="form-horizontal form-label-left">--}}
    {{--                        <input name="_method" type="hidden" value="PUT">--}}

    {{--                        {{ csrf_field() }}--}}
    {{--                        <label>بيانات المكافأه الأساسية</label>--}}
    {{--                        <div class="ln_solid"></div>--}}
    {{--                        <div class="row">--}}
    {{--                            <div class="form-group col-md-2">--}}
    {{--                                <label for="inputEmail4">الحد الادني من السعر جملة</label>--}}
    {{--                                <input type="number" value="{{$notify->min_total}}" min="1" name="min_total"--}}
    {{--                                       class="form-control" id="inputEmail4" required>--}}
    {{--                            </div>--}}
    {{--                            <div class="form-group col-md-2">--}}
    {{--                                <label for="inputEmail4">الحد الادني من السعر قطاعي</label>--}}
    {{--                                <input type="number" value="{{$notify->min_unit}}" min="1" name="min_unit"--}}
    {{--                                       class="form-control" id="inputEmail4" required>--}}
    {{--                            </div>--}}
    {{--                            <div class="form-group col-md-2">--}}
    {{--                                <label for="inputEmail4">ابتداء من تاريخ</label>--}}
    {{--                                <input type="date" value="{{$notify->from}}" name="from" class="form-control"--}}
    {{--                                       id="inputEmail4" required>--}}
    {{--                            </div>--}}
    {{--                            <div class="form-group col-md-2">--}}
    {{--                                <label for="inputEmail4">يتنهى في تاريخ</label>--}}
    {{--                                <input type="date" value="{{$notify->to}}" name="to" class="form-control"--}}
    {{--                                       id="inputEmail4" required>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                        <div class="ln_solid"></div>--}}
    {{--                        @foreach($products as $index => $product)--}}
    {{--                            <?php--}}
    {{--                            $notify_units = $notify->notify_units();--}}
    {{--                            $notify_unit = $notify_units->where('product_id', $product->id)->get()->first();--}}
    {{--                            $true = true;--}}
    {{--                            if (empty($notify_unit)) {--}}
    {{--                                $true = false;--}}
    {{--                            }--}}
    {{--                            ?>--}}
    {{--                            <label>اسم المنتج : {{$product->name}}</label>--}}
    {{--                            <div class="ln_solid"></div>--}}

    {{--                            <input type="hidden" name="info[{{$product->id}}][product_id]" value="{{$product->id}}">--}}

    {{--                            <div class="row">--}}
    {{--                                <div class="form-group col-md-2">--}}
    {{--                                    <label for="inputEmail4">% نسبة المكافأه قطاعي</label>--}}
    {{--                                    <input type="number" min="0" value="{{$true?$notify_unit->discount_unit:''}}"--}}
    {{--                                           name="info[{{$product->id}}][discount_unit]" class="form-control"--}}
    {{--                                           id="inputEmail4">--}}
    {{--                                </div>--}}
    {{--                                <div class="form-group col-md-2">--}}
    {{--                                    <label for="inputPassword4">% نسبة المكافأه جملة</label>--}}
    {{--                                    <input type="number" min="0" value="{{$true?$notify_unit->discount_total:''}}"--}}
    {{--                                           name="info[{{$product->id}}][discount_total]" class="form-control"--}}
    {{--                                           id="inputPassword4">--}}
    {{--                                </div>--}}
    {{--                                <div class="form-group col-md-2">--}}
    {{--                                    <label for="inputEmail4">نسبة المكافأه الفورية قطاعي</label>--}}
    {{--                                    <input type="number" min="0" value="{{$true?$notify_unit->now_unit:''}}"--}}
    {{--                                           name="info[{{$product->id}}][now_unit]" class="form-control"--}}
    {{--                                           id="inputEmail4">--}}
    {{--                                </div>--}}
    {{--                                <div class="form-group col-md-2">--}}
    {{--                                    <label for="inputEmail4">نسبة المكافأه الأجلة قطاعي</label>--}}
    {{--                                    <input type="number" min="0" value="{{$true?$notify_unit->later_unit:''}}"--}}
    {{--                                           name="info[{{$product->id}}][later_unit]" class="form-control"--}}
    {{--                                           id="inputEmail4">--}}
    {{--                                </div>--}}
    {{--                                --}}{{----}}
    {{--                                <div class="form-group col-md-2">--}}
    {{--                                    <label for="inputEmail4">نسبة المكافأه الفورية جملة</label>--}}
    {{--                                    <input type="number" min="0" value="{{$true?$notify_unit->now_total:''}}"--}}
    {{--                                           name="info[{{$product->id}}][now_total]" class="form-control"--}}
    {{--                                           id="inputEmail4">--}}
    {{--                                </div>--}}
    {{--                                <div class="form-group col-md-2">--}}
    {{--                                    <label for="inputEmail4">نسبة المكافأه الأجلة جملة</label>--}}
    {{--                                    <input type="number" min="0" value="{{$true?$notify_unit->later_total:''}}"--}}
    {{--                                           name="info[{{$product->id}}][later_total]" class="form-control"--}}
    {{--                                           id="inputEmail4">--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        @endforeach--}}
    {{--                        <div class="form-group">--}}
    {{--                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">--}}
    {{--                                <button class="btn btn-primary" type="button"><a href="{{url('/')}}/admin/stores"--}}
    {{--                                                                                 style="color:white">إلغاء</a></button>--}}
    {{--                                <button class="btn btn-primary" type="reset">إعاده</button>--}}
    {{--                                <button type="submit" class="btn btn-success">تعديل</button>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}

    {{--                    </form>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}


@endsection
