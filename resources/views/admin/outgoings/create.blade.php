@extends('layouts.main')
@section('content')

    @include('partials._errors')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>اضافه قسم مصروفات</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>

                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br>
                    <form method="POST" action="{{ Route('outgoings.store') }}" enctype="multipart/form-data"
                          data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">

                        {{ csrf_field() }}


                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> اسم البند مصروفات <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="name" id="name" value="{{old('name')}}"
                                       class="form-control col-md-7 col-xs-12" required>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="form_control_1">القسم التابع
                                له</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" name="parent_id" id="form_control_1">
                                    <option value="0">قسم رئيسي</option>

                                    @foreach ($outgoings as $outgoing)
                                        <option
                                            value="{{ $outgoing->id }}">{{ $outgoing->name }}</option>

                                    @endforeach

                                </select>
                                <div class="form-control-focus"></div>
                            </div>
                        </div>

{{--                                                <div class="form-group">--}}
{{--                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_id">القسم التابع--}}
{{--                                                        له</label>--}}
{{--                                                    <div class="col-md-6 col-sm-6 col-xs-12">--}}
{{--                                                        <div class="ui fluid search selection dropdown">--}}
{{--                                                            <input type="hidden" name="parent_id">--}}
{{--                                                            <i class="dropdown icon"></i>--}}
{{--                                                            <div class="default text">القسم التابع له</div>--}}
{{--                                                            <div class="menu">--}}
{{--                                                                <div class="item" data-value="0">قسم رئيسي</div>--}}
{{--                                                                @foreach ($outgoings as $outgoing)--}}
{{--                                                                    <div class="item"--}}
{{--                                                                         data-value="{{ $outgoing->id }}">{{ $outgoing->name }}</div>--}}
{{--                                                                @endforeach--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}

                        <div class="form-group ">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="form_control_1">المده</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" name="is_daily" id="form_control_1">

                                    <option value="0">شهري</option>
                                    <option value="1">يومي</option>

                                </select>
                                <div class="form-control-focus"></div>
                            </div>
                        </div>

                        {{--                        <div class="form-group">--}}
                        {{--                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_id">المده</label>--}}
                        {{--                            <div class="col-md-6 col-sm-6 col-xs-12">--}}
                        {{--                                <div class="ui fluid search selection dropdown">--}}
                        {{--                                    <input type="hidden" name="is_daily">--}}
                        {{--                                    <i class="dropdown icon"></i>--}}
                        {{--                                    <div class="default text">المده</div>--}}
                        {{--                                    <div class="menu">--}}
                        {{--                                        <div class="item" data-value="0">شهري</div>--}}
                        {{--                                        <div class="item" data-value="1">يومي</div>--}}
                        {{--                                    </div>--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}

                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button class="btn btn-primary" type="button"><a href="{{url('/')}}/admin/outgoings"
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
