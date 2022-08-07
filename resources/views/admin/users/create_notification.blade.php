@extends('layouts.main')
@section('content')


    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2> اضافه اشعار </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>

                    </ul>
                    <div class="clearfix"></div>
                </div>
                @include('partials._errors')
                <div class="x_content">
                    <br>
                    <form method="POST" action="{{ Route('store_notification.store') }}" enctype="multipart/form-data"
                          data-parsley-validate="" class="form-horizontal form-label-left">

                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title"> العنوان <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="title" id="title" value="{{old('title')}}"
                                       class="form-control col-md-7 col-xs-12" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description"> الاشعار <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="description" id="description" value="{{old('description')}}"
                                       class="form-control col-md-7 col-xs-12" required>
                            </div>
                        </div>
                        <div class="form-group form-md-line-input has-success">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_id"> التخصص </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" name="product_id" id="form_control_1">
                                    @foreach ($products as $product)

                                        <option value="{{ $product->id }}">{{ $product->name }}</option>

                                    @endforeach
                                </select>
                                <div class="form-control-focus"></div>
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
