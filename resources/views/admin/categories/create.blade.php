@extends('layouts.main')
@section('content')

    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{url('/admin')}}">لوحة التحكم</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{{url('/admin/categories')}}"> الفئات </a>
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

                <div class="x_content">
                    <br>
                    <form method="POST" action="{{ Route('categories.store') }}" enctype="multipart/form-data"
                          data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">

                        {{ csrf_field() }}


                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> اسم الفئه باللغة العربية<span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="name" id="name" value="{{old('name')}}"
                                       class="form-control col-md-7 col-xs-12" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> اسم الفئه باللغة الانجليزية<span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="name_en" id="name" value="{{old('name_en')}}"
                                       class="form-control col-md-7 col-xs-12" required>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title" requied>ايقاف الفئه
                            </label>

                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="radio" name="is_hidden" value="1"> نعم<br>
                                <input type="radio" name="is_hidden" value="0"> لا<br>
                            </div>

                        </div>


                        <div class="form-group ">
                            <label  class="control-label col-md-3 col-sm-3 col-xs-12">
                                صورة</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                    <div>
                                        <span class="btn default btn-file">
                                            <span class="fileinput-new"> اضافة صوره </span>
                                            <span class="fileinput-exists"> تغير </span>
                                            <input type="file" id="photo"  name="image" required> </span>
                                        <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> حذف </a>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button class="btn btn-primary" type="button"><a href="{{url('/')}}/admin/categories"
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
