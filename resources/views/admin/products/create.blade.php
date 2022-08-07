@extends('layouts.main')
@section('content')

    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{url('/admin')}}">لوحة التحكم</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{{url('/admin/products')}}">المنتجات </a>
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
            <div class="portlet light form-fit bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-social-dribbble font-green"></i>
                        <span class="caption-subject font-green bold uppercase">اضافة منتج</span>
                    </div>
                </div>
                <div class="portlet-body form">

                    <form method="POST" action="{{ Route('products.store') }}" enctype="multipart/form-data"
                          data-parsley-validate="" class="form-horizontal form-row-seperated">

                        {{ csrf_field() }}
                        <div class="form-body">

                            <div class="form-group ">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="form_control_1"> اسم
                                    الفئه</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="category_id" id="form_control_1">
                                        @foreach ($categories as $category)

                                            <option value="{{ $category->id }}">{{ $category->name }}</option>

                                        @endforeach
                                    </select>
                                    <div class="form-control-focus"></div>
                                </div>
                            </div>

                            {{--                            <div class="form-group ">--}}
                            {{--                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="form_control_1"> اسم الفئه--}}
                            {{--                                    الفرعية</label>--}}
                            {{--                                <div class="col-md-6 col-sm-6 col-xs-12">--}}
                            {{--                                    <select class="form-control" name="subcategory_id" id="form_control_1">--}}
                            {{--                                        @foreach ($subcategories as $category)--}}

                            {{--                                            <option value="{{ $category->id }}">{{ $category->name }}</option>--}}

                            {{--                                        @endforeach--}}
                            {{--                                    </select>--}}
                            {{--                                    <div class="form-control-focus"></div>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}

                            <div class="form-group ">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="form_control_1"> اسم
                                    الشركه</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="company_id" id="form_control_1">
                                        @foreach ($companies as $company)

                                            <option value="{{ $company->id }}">{{ $company->name }}</option>

                                        @endforeach
                                    </select>
                                    <div class="form-control-focus"></div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> اسم المنتج باللغة
                                    العربية<span
                                        class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="name" id="name" value="{{old('name')}}"
                                           class="form-control col-md-7 col-xs-12" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> اسم المنتج باللغة
                                    الانجليزية<span
                                        class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="name_en" id="name" value="{{old('name_en')}}"
                                           class="form-control col-md-7 col-xs-12" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> كود المنتج <span
                                        class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="code" id="code" value=""
                                           class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> نوع الوحدة باللغة
                                    العربية
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="unit_type" id="unit_type" value="{{old('unit_type')}}"
                                           class="form-control col-md-7 col-xs-12" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> نوع الوحدة باللغة
                                    الانجليزية
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="unit_type_en" id="unit_type"
                                           value="{{old('unit_type_en')}}"
                                           class="form-control col-md-7 col-xs-12" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="quantity_unit"> كمية
                                    الوحده
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="number" name="quantity_unit" id="quantity_unit"
                                           value="{{old('quantity_unit')}}" class="form-control col-md-7 col-xs-12"
                                           required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> نوع القطعه الواحده
                                    باللغة العربية
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="subunit_type" id="subunit_type"
                                           value="{{old('subunit_type')}}"
                                           class="form-control col-md-7 col-xs-12" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> نوع القطعه الواحده
                                    باللغة الانجليزية
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="subunit_type_en" id="subunit_type"
                                           value="{{old('subunit_type_en')}}"
                                           class="form-control col-md-7 col-xs-12" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price_total"> السعر جمله
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="number" step="0.01" name="price_total" id="price_total"
                                           value="{{old('price_total')}}"
                                           class="form-control col-md-7 col-xs-12" required>
                                </div>
                            </div>

                            <div class="form-group ">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="form_control_1">اضافة
                                    خصم</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control discount" name="discount_type" id="form_control_1">
                                        <option value="0">لا يوجد خصم</option>
                                        <option value="1">خصم شهرى</option>
                                        <option value="2">خصم اسبوعى</option>
                                    </select>
                                    <div class="form-control-focus"></div>
                                </div>
                            </div>

                            <div class="form-group gomla_discount">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price_total"> الخصم جمله
                                    بالجنية
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="number" step="0.01" name="discount_total" id="discount_total" value="0"
                                           class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            {{--                            <div class="form-group">--}}
                            {{--                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price_unit"> السعر قطاعى--}}
                            {{--                                </label>--}}
                            {{--                                <div class="col-md-6 col-sm-6 col-xs-12">--}}
                            {{--                                    <input type="number" step="0.01" name="price_unit" id="price_unit"--}}
                            {{--                                           value="{{old('price_unit')}}"--}}
                            {{--                                           class="form-control col-md-7 col-xs-12" required>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}

                            {{--                            <div class="form-group">--}}
                            {{--                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price_unit"> الخصم قطاعى--}}
                            {{--                                </label>--}}
                            {{--                                <div class="col-md-6 col-sm-6 col-xs-12">--}}
                            {{--                                    <input type="number" step="0.01" name="discount_unit" id="discount_unit" value="0"--}}
                            {{--                                           value="{{old('discount_unit')}}"--}}
                            {{--                                           class="form-control col-md-7 col-xs-12">--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description"> تفاصيل
                                    المنتج باللغة العربية
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea name="description" id="description"
                                          class="form-control col-md-7 col-xs-12"
                                          required>{{old('description')}}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description"> تفاصيل
                                    المنتج باللغة الانجليزية
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea name="description_en" id="description"
                                          class="form-control col-md-7 col-xs-12"
                                          required>{{old('description_en')}}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> رقم الترتيب <span
                                        class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="number" name="rank_code" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title" requied> طريقة
                                    البيع
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {{--                                    <input type="radio" name="is_unit" value="1"> جمله وقطاعى<br>--}}
                                    <input checked type="radio" name="is_unit" value="0"> جمله فقط<br>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title" requied>تفعيل
                                    المنتج ؟</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="radio" name="status" value="1"> نعم<br>
                                    <input type="radio" name="status" value="0"> لا<br>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title" requied>ايقاف
                                    المنتج
                                </label>

                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="radio" name="is_hidden" value="1"> نعم<br>
                                    <input type="radio" name="is_hidden" value="0"> لا<br>
                                </div>

                            </div>


                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title" requied> وضع المنتج
                                    في قائمه الانتظار</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="radio" name="waiting_status" value="1"> نعم<br>
                                    <input type="radio" name="waiting_status" value="0"> لا<br>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title" requied> تحديد كميه
                                    للمنتج ؟</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="radio" name="quantity_status" value="1"> نعم<br>
                                    <input type="radio" name="quantity_status" value="0"> لا<br>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> اقصي كميه متاحه
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="number" name="max_quantity" id="max_quantity"
                                           value="{{old('max_quantity')}}" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                    صورة</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                            <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image"
                                                 alt=""/>
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail"
                                             style="max-width: 200px; max-height: 150px;"></div>
                                        <div>
                                        <span class="btn default btn-file">
                                            <span class="fileinput-new"> اضافة صوره </span>
                                            <span class="fileinput-exists"> تغير </span>
                                            <input type="file" id="photo" name="image" required> </span>
                                            <a href="javascript:;" class="btn red fileinput-exists"
                                               data-dismiss="fileinput"> حذف </a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="form-group form-md-line-input has-success">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="form_control_1">صور
                                    تفصيلية للمنتج</label>
                                <div class="input-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="file" name="images[]" id="images" class="form-control" multiple>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="ln_solid"></div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button class="btn btn-primary" type="button"><a href="{{url('/')}}/admin/products"
                                                                                     style="color:white">إلغاء</a>
                                    </button>
                                    <button class="btn btn-primary" type="reset">إعاده</button>
                                    <button type="submit" class="btn btn-success">اضافه</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>



    <script>
        document.querySelector('.discount').onchange = function () {
            debugger
            if (this.value == 1 || this.value == 2) {
                document.querySelector('.gomla_discount').style.display = "block";
            } else {
                document.querySelector('.gomla_discount').style.display = "none";
                document.getElementById('discount_total').setAttribute('value', 0)
            }
        }
    </script>
@endsection
