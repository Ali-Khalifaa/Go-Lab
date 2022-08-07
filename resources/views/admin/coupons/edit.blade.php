@extends('layouts.main')
@section('content')

    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{url('/admin')}}">لوحة التحكم</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{{url('/admin/coupons')}}"> برومو كود </a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>تعديل</span>
            </li>
        </ul>
    </div>

    <h1 class="page-title"> برومو كود </h1>
    @include('partials._errors')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">

                <div class="x_content">
                    <br>
                    <form method="POST" action="{{ url('admin/coupons/'.$types->id) }}"
                          enctype="multipart/form-data" categories-parsley-validate=""
                          class="form-horizontal form-label-left">

                        <input name="_method" type="hidden" value="PUT">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">اسم البرومو كود باللغة العربية</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="name" name="title" value="{{$types->title}}"
                                       class="form-control col-md-7 col-xs-12" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">اسم البرومو كود باللغة الانجليزية</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="name" name="title_en" value="{{$types->title_en}}"
                                       class="form-control col-md-7 col-xs-12" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">نسبة الخصم</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" id="name" name="percentage" value="{{$types->percentage}}"
                                       class="form-control col-md-7 col-xs-12" required>
                            </div>
                        </div>

                        <div class="form-group gomla_discount">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price_total"> الكود
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text"  name="code" id="discount_total" value="{{$types->code}}"
                                       class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">تاريخ الانتهاء</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="name" name="end_date" value="{{$types->end_date}}"
                                       class="form-control col-md-7 col-xs-12" required>
                            </div>
                        </div>

                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button class="btn btn-primary" type="button"><a href="{{url('/')}}/admin/coupons"
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
