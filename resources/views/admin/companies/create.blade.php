@extends('layouts.main')
@section('content')

    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{url('/admin')}}">لوحة التحكم</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{{url('/admin/companies')}}"> الشركات </a>
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
                    <form method="POST" action="{{ Route('companies.store') }}" enctype="multipart/form-data"
                          data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">

                        {{ csrf_field() }}

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">اسم الفئه</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" name="category_id" required>
                                    @foreach ($categories as $category)


                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> اسم الشركة باللغة العربية<span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" required name="name" id="name" value="{{old('name')}}"
                                       class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> اسم الشركة باللغة الانجليزية<span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" required name="name_en" id="name" value="{{old('name_en')}}"
                                       class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> تخصص الشركة باللغة العربية<span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" required name="company_field" id="name" value="{{old('company_field')}}"
                                       class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> تخصص الشركة باللغة الانجليزية<span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" required name="company_field_en" id="name" value="{{old('company_field_en')}}"
                                       class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title" >ايقاف الشركه
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
                                <button class="btn btn-primary" type="button"><a href="{{url('/')}}/admin/companies"
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
