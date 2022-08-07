@extends('layouts.main')
@section('content')

    @include('partials._errors')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>اضافه بند ايرادات</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>

                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br>
                    <form method="POST" action="{{ url('/admin/ingoings_item/store/'.$ingoing->id) }}"
                          enctype="multipart/form-data"
                          data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">

                    @csrf


                    <!--<div class="form-group">-->
                        <!--    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> اسم البند الايرادات <span-->
                        <!--            class="required">*</span>-->
                        <!--    </label>-->
                        <!--    <div class="col-md-6 col-sm-6 col-xs-12">-->
                    <!--        <input type="text" name="name" id="name" value="{{old('name')}}"-->
                        <!--               class="form-control col-md-7 col-xs-12" required>-->
                        <!--    </div>-->
                        <!--</div>-->

                        <div class="form-group ">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                   for="form_control_1">المنخزن</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" name="store_id" id="form_control_1">

                                    @foreach ($stores as $store)
                                        <option value="{{$store->id}}">{{$store->name}}</option>
                                    @endforeach

                                </select>
                                <div class="form-control-focus"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price"> المبلغ <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" name="price" id="price" value="{{old('price')}}"
                                       class="form-control col-md-7 col-xs-12" required>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="form_control_1">القسم</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" name="ingoing_id" id="form_control_1">

                                    @foreach ($ingoings as $in_going)
                                        <option
                                            value="{{ $in_going->id }}">{{ $in_going->name }}</option>

                                    @endforeach

                                </select>
                                <div class="form-control-focus"></div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price"> السبب <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="name" id="name" value="{{old('name')}}"
                                       class="form-control col-md-7 col-xs-12" required>
                            </div>
                        </div>


                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button class="btn btn-primary" type="button"><a href="{{ url()->previous() }}"
                                                                                 style="color:white">إلغاء</a></button>
                                <button class="btn btn-primary" type="reset">إعاده</button>
                                <button type="submit" class="btn btn-success">اضافه</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
