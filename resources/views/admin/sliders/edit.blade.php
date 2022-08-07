@extends('layouts.main')
@section('content')

    @include('partials._errors')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>تعديل السلايدر </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>

                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br>
                    <form method="POST" action="{{ url('admin/sliders/'.$sliders->id) }}" enctype="multipart/form-data"
                          sliders-parsley-validate="" class="form-horizontal form-label-left">

                        <input name="_method" type="hidden" value="PUT">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_id">اسم الفئه
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" required name="category_id" id="exampleFormControlSelect1"
                                        class="form-control col-md-6 col-xs-12">

                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}"
                                            {{ ($category->id == $sliders->category_id)?"selected":"" }}
                                        >{{$category->name}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="product_id">اسم المنتج
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" required name="product_id" id="exampleFormControlSelect1"
                                        class="form-control col-md-6 col-xs-12">

                                    @foreach ($products as $product)
                                        <option value="{{$product->id}}"
                                            {{ ($product->id == $sliders->product_id)?"selected":"" }}
                                        >{{$product->name}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        {{--                        <div class="form-group">--}}
                        {{--                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_id">اسم--}}
                        {{--                                المنتج </label>--}}
                        {{--                            <div class="col-md-6 col-sm-6 col-xs-12">--}}
                        {{--                                <div class="ui fluid search selection dropdown">--}}
                        {{--                                    <input type="hidden" name="product_id" value="{{$sliders->product_id}}">--}}
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

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">صورة السلايدر</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                        @if($sliders->image ==null)
                                        @else
                                            <img src="{{asset('uploads/sliders/'.$sliders->image)}}" alt="Image"
                                                 style="width:100%;height:100%;">
                                        @endif
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail"
                                         style="max-width: 200px; max-height: 150px;"></div>
                                    <div>
                                        <span class="btn default btn-file">
                                            <span class="fileinput-new"> اضافة صوره  </span>
                                            <span class="fileinput-exists"> تغير </span>
                                            <input type="file" id="img" name="image"
                                                   value="{{$sliders->image}}"> </span>
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
                        {{--                                    <input type="file" name="image" value="{{ $sliders->image }}" id="_image"--}}
                        {{--                                           class="form-control"></div>--}}
                        {{--                            </div>--}}
                        {{--                            @if($sliders->image ==null)--}}
                        {{--                            @else--}}
                        {{--                                <img src="{{asset('uploads/sliders/'.$sliders->image)}}" alt="Image"--}}
                        {{--                                     style="width:50px;height:50px;margin-left:30px;">--}}
                        {{--                            @endif--}}
                        {{--                        </div>--}}


                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button class="btn btn-primary" type="button"><a href="{{url('/')}}/admin/sliders"
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
