@extends('layouts.main')
@section('content')


    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2> اضافه عميل </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>

                    </ul>
                    <div class="clearfix"></div>
                </div>
                @include('partials._errors')
                <div class="x_content">
                    <br>
                    <form method="POST" action="{{ Route('store_client.store') }}" enctype="multipart/form-data"
                          data-parsley-validate="" class="form-horizontal form-label-left">

                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> اسم العميل <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="name" id="name"
                                       class="form-control col-md-7 col-xs-12" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number"> رقم التليفون <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" name="number" id="number"
                                       class="form-control col-md-7 col-xs-12" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="shop_name"> اسم العياده <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="shop_name" id="shop_name"
                                       class="form-control col-md-7 col-xs-12" required>
                            </div>
                        </div>
                        <div class="form-group form-md-line-input has-success">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_id"> التخصص </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" name="shop_type" id="form_control_1">
                                    @foreach($shope_types as $shop_type)

                                        <option value="{{ $shop_type->name }}">{{ $shop_type->name }}</option>

                                    @endforeach
                                </select>
                                <div class="form-control-focus"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address"> العنوان <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="address" id="address"
                                       class="form-control col-md-7 col-xs-12" required>
                            </div>
                        </div>
                        <div class="form-group form-md-line-input has-success">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_id"> اسم
                                المنطقة </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" name="place_id" id="form_control_1">
                                    @foreach ($places as $place)

                                        <option value="{{ $place->id }}">{{ $place->place }}</option>

                                    @endforeach
                                </select>
                                <div class="form-control-focus"></div>
                            </div>
                        </div>


                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button class="btn btn-primary" type="button"><a href="{{url('/')}}/admin/users"
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
