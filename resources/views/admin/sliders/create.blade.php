@extends('layouts.main')
@section('content')

    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{url('/admin')}}">لوحة التحكم</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{{url('/admin/sliders')}}"> السلايدر </a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>اضافة</span>
            </li>
        </ul>

    </div>
    @include('partials._errors')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>اضافه سلايدر</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>

                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br>
                    <form method="POST" action="{{ Route('sliders.store') }}" enctype="multipart/form-data"
                          data-parsley-validate="" class="form-horizontal form-label-left">

                        {{ csrf_field() }}


                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_id">اسم الفئه
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" name="category_id" required>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_id">اسم المنتج
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" name="product_id" required>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{--                        <div class="form-group">--}}
                        {{--                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_id">اسم--}}
                        {{--                                المنتج </label>--}}
                        {{--                            <div class="col-md-6 col-sm-6 col-xs-12">--}}
                        {{--                                <div class="ui fluid search selection dropdown">--}}
                        {{--                                    <input type="hidden" name="product_id">--}}
                        {{--                                    <i class="dropdown icon"></i>--}}
                        {{--                                    <div class="default text">المنتج</div>--}}
                        {{--                                    <div class="menu">--}}
                        {{--                                        @foreach ($products as $product)--}}
                        {{--                                            <div class="item" data-value="{{ $product->id }}">{{ $product->name }}</div>--}}
                        {{--                                        @endforeach--}}
                        {{--                                    </div>--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}

                        <div class="form-group ">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                صوره السلايدر </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image"
                                             alt=""/>
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail"
                                         style="max-width: 200px; max-height: 150px;"></div>
                                    <div>
                                        <span class="btn default btn-file">
                                            <span class="fileinput-new"> اضافة صوره </span>
                                            <span class="fileinput-exists"> تغير </span>
                                            <input type="file" id="photo" name="image" required> </span>
                                        <a href="javascript:;" class="btn red fileinput-exists"
                                           data-dismiss="fileinput"> حذف </a>
                                    </div>
                                </div>

                            </div>
                        </div>

                        {{--                        <div class="form-group">--}}
                        {{--                            <label class="control-label col-md-3 col-sm-3 col-xs-12">صوره السلايدر </label>--}}
                        {{--                            <div class="input-group">--}}
                        {{--                                <div class="col-md-6 col-sm-6 col-xs-12">--}}
                        {{--                                    <input type="file" name="image" id="image" class="form-control"></div>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}

                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button class="btn btn-primary" type="button"><a href="{{url('/')}}/admin/sliders"
                                                                                 style="color:white">إلغاء</a></button>
                                <button class="btn btn-primary" type="reset">إعاده</button>
                                <button type="submit" class="btn btn-success" style="color:white">اضافه</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
