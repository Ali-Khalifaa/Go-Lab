@extends('layouts.main')
@section('content')


    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{url('/admin')}}">لوحة التحكم</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{{url('/admin/mandoobs')}}">المنادبين </a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>تعديل</span>
            </li>
        </ul>

    </div>
    @include('partials._errors')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light form-fit bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-social-dribbble font-green"></i>
                        <span class="caption-subject font-green bold uppercase">تعديل المندوب</span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form method="POST" action="{{ url('admin/mandoobs/'.$mandobs->id) }}" enctype="multipart/form-data" class="form-horizontal form-row-seperated">
                        <input name="_method" type="hidden" value="PUT">
                        {{ csrf_field() }}

                        <div class="form-body">

                            <div class="form-group">
                                <label class="control-label col-md-3">اسم المندوب</label>
                                <div class="col-md-9">
                                    <input type="text" name="name" id="name" value="{{$mandobs->name}}"
                                           class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

{{--                            <div class="form-group">--}}
{{--                                <label class="control-label col-md-3">رقم تليفون المندوب</label>--}}
{{--                                <div class="col-md-9">--}}
{{--                                    <input type="number" name="phone" id="phone" value="{{$mandobs->phone}}"--}}
{{--                                           class="form-control col-md-7 col-xs-12">--}}
{{--                                </div>--}}
{{--                            </div>--}}


                            <div class="form-group">
                                <label class="control-label col-md-3">مناطق المندوب</label>
                                <div class="col-md-9">
                                    <select multiple="multiple" required class="multi-select" id="my_multi_select1" name="places[]">
                                        @foreach ($places as $place)
                                            <option value="{{$place->id}}"
                                                {{$mandobs->places->contains($place->id)? "selected" :""}}>{{$place->place}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">عنوان المندوب</label>
                                <div class="col-md-9">
                                    <input type="text" name="address" id="address" value="{{$mandobs->address}}"
                                           class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">كلمة السر</label>
                                <div class="col-md-9">
                                    <input type="password" name="password" id="password"
                                           class="form-control col-md-7 col-xs-12" required>
                                </div>
                            </div>

                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button class="btn btn-primary" type="button"><a href="{{url('/')}}/admin/mandoobs"
                                                                                     style="color:white">إلغاء</a></button>
                                    <button class="btn btn-primary" type="reset">إعاده</button>
                                    <button type="submit" class="btn btn-success">تعديل</button>
                                </div>
                            </div>
                        </div>

                    </form>
                    <!-- END FORM-->
                </div>
            </div>
            <!-- END PORTLET-->
        </div>
    </div>




@endsection
