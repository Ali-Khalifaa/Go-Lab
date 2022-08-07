@extends('layouts.main')
@section('content')

    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{url('/admin')}}">لوحة التحكم</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{{url('/admin/subcategories')}}"> الفئات الفرعية</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>اضافة</span>
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
                        <span class="caption-subject font-green bold uppercase">اضافة فئه فرعية</span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form method="POST" action="{{ Route('subcategories.store') }}" enctype="multipart/form-data" class="form-horizontal form-row-seperated">
                        {{ csrf_field() }}

                        <div class="form-body">

                            <div class="form-group">
                                <label class="control-label col-md-3">اسم الفئه</label>
                                <div class="col-md-9">
                                    <select class="form-control" name="category_id" required>
                                        @foreach ($categories as $category)


                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">اسم الشركه</label>
                                <div class="col-md-9">
                                    <select multiple="multiple" required class="multi-select" id="my_multi_select1" name="company[]">
                                        @foreach ($companies as $company)
                                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">اسم الفئه الفرعية باللغة العربية</label>
                                <div class="col-md-9">
                                    <input type="text" name="name" id="name" value="{{old('name')}}"
                                           class="form-control col-md-7 col-xs-12" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">اسم الفئه الفرعية باللغة الانجليزية</label>
                                <div class="col-md-9">
                                    <input type="text" name="name_en" id="name" value="{{old('name_en')}}"
                                           class="form-control col-md-7 col-xs-12" required>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-md-3">ايقاف الفئه</label>
                                <div class="col-md-9">
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


                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button class="btn btn-primary" type="button"><a href="{{url('/')}}/admin/subcategories"
                                                                                     style="color:white">إلغاء</a></button>
                                    <button class="btn btn-primary" type="reset">إعاده</button>
                                    <button type="submit" class="btn btn-success">اضافه</button>
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

    <script type="text/javascript">
        $(document).ready(function () {
            $('select').selectpicker();
        });
    </script>
@endsection
