@extends('layouts.main')
@section('content')


    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>اضافه مندوب </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>

                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br>
                    <form method="POST" action="{{ url('admin/orders/'.$order->id .'/set_mandob') }}"
                          enctype="multipart/form-data" orders-parsley-validate=""
                          class="form-horizontal form-label-left">

                        {{-- <input name="_method" type="hidden" value="PUT"> --}}
                        {{ csrf_field() }}


                        <div class="form-group ">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="form_control_1"> اسم
                                المندوب</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" name="mandob_id" value="{{$order->mandob_id}}" id="form_control_1">
                                    @foreach ($mandobs as $mandob)

                                        <option value="{{ $mandob->id }}">{{ $mandob->name }}</option>

                                    @endforeach
                                </select>
                                <div class="form-control-focus"></div>
                            </div>
                        </div>


{{--                        <div class="form-group">--}}
{{--                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="mandob_id">اسم المندوب--}}
{{--                            </label>--}}
{{--                            <div class="col-md-6 col-sm-6 col-xs-12">--}}
{{--                                <div class="ui fluid search selection dropdown">--}}
{{--                                    <input type="hidden" name="mandob_id" value="{{$order->mandob_id}}">--}}
{{--                                    <i class="dropdown icon"></i>--}}
{{--                                    <div class="default text">المندوب</div>--}}
{{--                                    <div class="menu">--}}
{{--                                        @foreach ($mandobs as $mandob)--}}
{{--                                            <div class="item" data-value="{{ $mandob->id }}">{{ $mandob->name }}</div>--}}
{{--                                        @endforeach--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button class="btn btn-primary" type="button"><a href="{{url('/')}}/admin/orders"
                                                                                 style="color:white">إلغاء</a></button>
                                <button type="submit" class="btn btn-success">اضافه</button>

                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
