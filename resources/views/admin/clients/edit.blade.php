@extends('layouts.main')
@section('content')

    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{url('/admin')}}">لوحة التحكم</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{{url('/admin/clients')}}"> العملاء </a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>تعديل</span>
            </li>
        </ul>

    </div>
    <h1 class="page-title"> تعديل عميل </h1>
    @include('partials._errors')


    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <br>
                    <form method="POST" action="{{ Route('clients.update',$user->id) }}" enctype="multipart/form-data"
                          data-parsley-validate="" class="form-horizontal form-label-left">
                        <input name="_method" type="hidden" value="PUT">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> اسم العميل <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="name" id="name" value="{{$user->name}}"
                                       class="form-control col-md-7 col-xs-12" required>
                            </div>
                        </div>
{{--                        <div class="form-group">--}}
{{--                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id"> رقم التليفون <span--}}
{{--                                    class="required">*</span>--}}
{{--                            </label>--}}
{{--                            <div class="col-md-6 col-sm-6 col-xs-12">--}}
{{--                                <input type="number" value="{{$user->phone}}" name="id" id="id"--}}
{{--                                       class="form-control col-md-7 col-xs-12" required>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="shop_name"> اسم العياده <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" value="{{$user->shop_name}}" name="shop_name" id="shop_name"
                                       class="form-control col-md-7 col-xs-12" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="shop_type"> التخصص <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" value="{{$user->shop_type}}" name="shop_type" id="shop_type"
                                       class="form-control col-md-7 col-xs-12" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address"> العنوان <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" value="{{$user->address}}" name="address" id="address"
                                       class="form-control col-md-7 col-xs-12" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">اسم المنطقة</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" required id="exampleFormControlSelect1"
                                        class="form-control col-md-6 col-xs-12" name="place_id">
                                    <option value="">---</option>

                                    @foreach ($places as $place)
                                        <option
                                            value="{{$place->id}}" {{ ($place->id == $user->place_id)?"selected":"" }}>{{$place->place}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        {{--                        <div class="form-group">--}}
                        {{--                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_id">اسم--}}
                        {{--                                المنطقة </label>--}}
                        {{--                            <div class="col-md-6 col-sm-6 col-xs-12">--}}
                        {{--                                <div class="ui fluid search selection dropdown">--}}
                        {{--                                    <input type="hidden" name="place_id" value="{{$user->place_id}}">--}}
                        {{--                                    <i class="dropdown icon"></i>--}}
                        {{--                                    <div class="default text">المنطقة</div>--}}
                        {{--                                    <div class="menu">--}}
                        {{--                                        @foreach ($places as $place)--}}
                        {{--                                            <div class="item" data-value="{{ $place->id }}">{{ $place->place }}</div>--}}
                        {{--                                        @endforeach--}}
                        {{--                                    </div>--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button class="btn btn-primary" type="button"><a href="{{url('/')}}/admin/clients"
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
