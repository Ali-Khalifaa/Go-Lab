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
                        <span class="caption-subject font-green bold uppercase">تعديل الفئة الفرعية</span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form method="POST" action="{{ url('admin/subcategories/'.$subcategories->id) }}" enctype="multipart/form-data" class="form-horizontal form-row-seperated">
                        <input name="_method" type="hidden" value="PUT">
                        {{ csrf_field() }}

                        <div class="form-body">

                            <div class="form-group">
                                <label class="control-label col-md-3">اسم الفئه</label>
                                <div class="col-md-9">
                                    <select class="form-control" required id="exampleFormControlSelect1"
                                            class="form-control col-md-6 col-xs-12" name="category_id">
                                        <option value="">---</option>

                                        @foreach ($categories as $category)
                                            <option
                                                value="{{$category->id}}" {{ ($category->id == $subcategories->category_id)?"selected":"" }}>{{$category->name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">اسم الشركة</label>
                                <div class="col-md-9">
                                    <select multiple="multiple" required class="multi-select" id="my_multi_select1" name="companys[]">
                                        @foreach ($companies as $company)
                                            <option value="{{$company->id}}"
                                                    @if($subcategories->hasCompany($company->id))
                                                    selected
                                                @endif

                                            >{{$company->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">اسم الفئه الفرعية باللغة العربية</label>
                                <div class="col-md-9">
                                    <input type="text" id="name" name="name" value="{{$subcategories->name}}"
                                           class="form-control col-md-7 col-xs-12" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">اسم الفئه الفرعية باللغة الانجليزية</label>
                                <div class="col-md-9">
                                    <input type="text" id="name" name="name_en" value="{{$subcategories->name_en}}"
                                           class="form-control col-md-7 col-xs-12" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">ايقاف الفئه</label>
                                <div class="col-md-9">
                                    <input type="radio" name="is_hidden" value="1"
                                           @if($subcategories->is_hidden == 1) checked @endif> نعم<br>
                                    <input type="radio" name="is_hidden" value="0"
                                           @if($subcategories->is_hidden == 0) checked @endif > لا<br>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">صورة</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                            <img src="{{asset('uploads/subcategories/'.$subcategories->image)}}"  alt="Image" style="width:100%;height:100%;">
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                        <div>
                                        <span class="btn default btn-file">
                                            <span class="fileinput-new"> اضافة صوره  </span>
                                            <span class="fileinput-exists"> تغير </span>
                                            <input type="file" id="img" name="image" value="{{$subcategories->image}}" > </span>
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
