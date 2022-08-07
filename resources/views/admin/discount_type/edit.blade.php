@extends('layouts.main')
@section('content')

    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{url('/admin')}}">لوحة التحكم</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{{url('/admin/discount_type')}}"> انواع الخصومات </a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>تعديل</span>
            </li>
        </ul>

    </div>
    <h1 class="page-title">تعديل نشاط </h1>
    @include('partials._errors')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">

                <div class="x_content">
                    <br>
                    <form method="POST" action="{{ url('admin/discount_type/'.$types->id) }}"
                          enctype="multipart/form-data" categories-parsley-validate=""
                          class="form-horizontal form-label-left">

                        <input name="_method" type="hidden" value="PUT">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">الخصم يبدأ من</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" id="from" name="from" value="{{$types->from}}"
                                       class="form-control col-md-7 col-xs-12" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">الخصم ينتهى الى</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" id="to" name="to" value="{{$types->to}}"
                                       class="form-control col-md-7 col-xs-12" required>
                            </div>
                        </div>

                        @if($types->id == 1 || $types->id == 3)

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">نسبة الخصم
                                    الفورية</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="number" id="immediately" name="immediately"
                                           value="{{$types->immediately}}"
                                           class="form-control col-md-7 col-xs-12" required>
                                </div>
                            </div>
                        @endif

                        @if($types->id == 2 || $types->id == 3)

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">نسبة الخصم
                                    المؤجلة</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="number" id="postponed" name="postponed" value="{{$types->postponed}}"
                                           class="form-control col-md-7 col-xs-12" required>
                                </div>
                            </div>
                        @endif

                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button class="btn btn-primary" type="button"><a href="{{url('/')}}/admin/discount_type"
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
