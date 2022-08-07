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
                            class="caption-subject font-green bold uppercase"> اضافة مكافأه فاتورة خاص لمخزن {{$store->name}}</span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <br>
                    <form method="POST" action="{{ url('admin/stores/store_notify_total') }}"
                          enctype="multipart/form-data"
                          categories-parsley-validate="" class="form-horizontal form-label-left">

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
                                            <input type="number" min="1" name="min_total" class="form-control"
                                                   id="inputEmail4"
                                                   required>
                                        </div>
                                        <div class=" col-md-3">
                                            <label class="control-label" for="inputEmail4">الحد الادني من السعر
                                                قطاعي</label>
                                            <input type="number" min="1" name="min_unit" class="form-control"
                                                   id="inputEmail4"
                                                   required>
                                        </div>
                                        <div class=" col-md-3">
                                            <label class="control-label" for="inputEmail4">ابتداء من تاريخ</label>
                                            <input type="date" name="from" class="form-control" id="inputEmail4"
                                                   required>
                                        </div>
                                        <div class=" col-md-3">
                                            <label class="control-label" for="inputEmail4">يتنهى في تاريخ</label>
                                            <input type="date" name="to" class="form-control" id="inputEmail4" required>
                                        </div>
                                        <div class=" col-md-3">
                                            <label class="control-label" for="inputEmail4">نسبة خصم الجمله</label>
                                            <input type="number" name="percentage_total" class="form-control"
                                                   id="inputEmail4" required>
                                        </div>
                                        <div class=" col-md-3">
                                            <label class="control-label" for="inputEmail4">نسبة خصم القطاعي</label>
                                            <input type="number" name="percentage_unit" class="form-control"
                                                   id="inputEmail4" required>
                                        </div>
                                        <input type="hidden" name="store_id" value="{{$store->id}}">
                                    </div>

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_id"> المنتجات
                                    الغير
                                    مشملة بالعرض
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control select2-multiple" id="members_dropdown" multiple=""
                                            required
                                            id="exampleFormControlSelect1" class="form-control col-md-6 col-xs-12"
                                            name="products[]">
                                        @foreach ($products as $product)
                                            <option value="{{$product->id}}">{{$product->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div id="dtBox"></div>
                                <div class="ui toggle checkbox col-md-3 col-sm-3 col-xs-12">
                                    <input type="checkbox" id="selectall">
                                    <label>تحديد الكل</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button class="btn btn-primary" type="button"><a href="{{url('/')}}/admin/stores"
                                                                                     style="color:white">إلغاء</a>
                                    </button>
                                    <button class="btn btn-primary" type="reset">إعاده</button>
                                    <button type="submit" class="btn btn-success">اضافة</button>
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
    {{--                    <h2>اضافة مكافأه فاتورة خاص لمخزن {{$store->name}}</h2>--}}
    {{--                    <ul class="nav navbar-right panel_toolbox">--}}
    {{--                        <li>--}}
    {{--                            <div class="ui warning message">--}}
    {{--                                <div class="header">--}}
    {{--                                    ملحوظة--}}
    {{--                                </div>--}}
    {{--                                لا يجب ان تكون نسبة المكافأه اكبر من نسبة المكسب!--}}
    {{--                            </div>--}}
    {{--                        </li>--}}
    {{--                        <li>--}}
    {{--                            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>--}}
    {{--                        </li>--}}
    {{--                    </ul>--}}
    {{--                    <div class="clearfix"></div>--}}
    {{--                </div>--}}
    {{--                <div class="x_content">--}}
    {{--                    <br>--}}
    {{--                    <form method="POST" action="{{ url('admin/stores/store_notify_total') }}"--}}
    {{--                          enctype="multipart/form-data"--}}
    {{--                          categories-parsley-validate="" class="form-horizontal form-label-left">--}}

    {{--                        {{ csrf_field() }}--}}
    {{--                        <label>بيانات المكافأه الأساسية</label>--}}
    {{--                        <div class="ln_solid"></div>--}}
    {{--                        <div class="row">--}}
    {{--                            <div class="form-group col-md-2">--}}
    {{--                                <label for="inputEmail4">الحد الادني من السعر جملة</label>--}}
    {{--                                <input type="number" min="1" name="min_total" class="form-control" id="inputEmail4"--}}
    {{--                                       required>--}}
    {{--                            </div>--}}
    {{--                            <div class="form-group col-md-2">--}}
    {{--                                <label for="inputEmail4">الحد الادني من السعر قطاعي</label>--}}
    {{--                                <input type="number" min="1" name="min_unit" class="form-control" id="inputEmail4"--}}
    {{--                                       required>--}}
    {{--                            </div>--}}
    {{--                            <div class="form-group col-md-2">--}}
    {{--                                <label for="inputEmail4">ابتداء من تاريخ</label>--}}
    {{--                                <input type="date" name="from" class="form-control" id="inputEmail4" required>--}}
    {{--                            </div>--}}
    {{--                            <div class="form-group col-md-2">--}}
    {{--                                <label for="inputEmail4">يتنهى في تاريخ</label>--}}
    {{--                                <input type="date" name="to" class="form-control" id="inputEmail4" required>--}}
    {{--                            </div>--}}
    {{--                            <div class="form-group col-md-2">--}}
    {{--                                <label for="inputEmail4">نسبة خصم الحمله</label>--}}
    {{--                                <input type="number" name="percentage_total" class="form-control" id="inputEmail4"--}}
    {{--                                       required>--}}
    {{--                            </div>--}}
    {{--                            <div class="form-group col-md-2">--}}
    {{--                                <label for="inputEmail4">نسبة خصم القطاعي</label>--}}
    {{--                                <input type="number" name="percentage_unit" class="form-control" id="inputEmail4"--}}
    {{--                                       required>--}}
    {{--                            </div>--}}
    {{--                            <input type="hidden" name="store_id" value="{{$store->id}}">--}}

    {{--                        </div>--}}
    {{--                        <div class="ln_solid"></div>--}}
    {{--                        <div class="form-group">--}}
    {{--                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_id">المنتجات--}}
    {{--                            </label>--}}
    {{--                            <div class="col-md-6 col-sm-6 col-xs-12">--}}
    {{--                                <select class="form-control select2-multiple" id="members_dropdown" multiple="" required--}}
    {{--                                        id="exampleFormControlSelect1" class="form-control col-md-6 col-xs-12"--}}
    {{--                                        name="products[]">--}}
    {{--                                    @foreach ($products as $product)--}}
    {{--                                        <option value="{{$product->id}}">{{$product->name}}</option>--}}
    {{--                                    @endforeach--}}
    {{--                                </select>--}}
    {{--                            </div>--}}
    {{--                            <div id="dtBox"></div>--}}
    {{--                            <div class="ui toggle checkbox col-md-3 col-sm-3 col-xs-12">--}}
    {{--                                <input type="checkbox"  id="selectall">--}}
    {{--                                <label>تحديد الكل</label>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                        --}}
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
