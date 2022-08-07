@extends('layouts.main')
@section('content')

    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{url('/admin')}}">لوحة التحكم</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{{url('/admin/suppliers')}}"> الموردين </a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>تعديل</span>
            </li>
        </ul>

    </div>
    <h1 class="page-title">تعديل المورد </h1>
    @include('partials._errors')



    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">

                <div class="x_content">
                    <br>
                    <form method="POST" action="{{ url('admin/suppliers/'.$supplier->id) }}"
                          enctype="multipart/form-data" suppliers-parsley-validate=""
                          class="form-horizontal form-label-left">

                        <input name="_method" type="hidden" value="PUT">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">اسم المورد
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="name" name="name" value="{{$supplier->name}}"
                                       class="form-control col-md-7 col-xs-12" required>
                            </div>
                            <div id="dtBox"></div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">حالة التفعيل</label>
                            <div class="col-md-9">
                                <input type="checkbox" name="is_active" value="{{$supplier->is_active}}" {{$supplier->is_active? "checked":""}} class="make-switch" id="test" data-size="mini">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone">التليفون
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="phone" name="phone" value="{{$supplier->phone}}"
                                       class="form-control col-md-7 col-xs-12" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address"> العنوان
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="address" name="address" value="{{$supplier->address}}"
                                       class="form-control col-md-7 col-xs-12" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="s_togary"> سجل تجارى
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="s_togary" name="s_togary" value="{{$supplier->s_togary}}"
                                       class="form-control col-md-7 col-xs-12" required>
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button class="btn btn-primary" type="button"><a href="{{url('/')}}/admin/suppliers"
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
