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
                <span>تعديل</span>
            </li>
        </ul>

    </div>
    <h1 class="page-title">تعديل المنتج </h1>
    @include('partials._errors')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <br>
                    <form method="POST" action="{{ url('admin/products/'.$products->id) }}"
                          enctype="multipart/form-data" categories-parsley-validate=""
                          class="form-horizontal form-label-left">

                        <input name="_method" type="hidden" value="PUT">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_id">اسم الفئه
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" required id="exampleFormControlSelect1"
                                        class="form-control col-md-6 col-xs-12" name="category_id">
                                    <option value="">---</option>

                                    @foreach ($categories as $category)
                                        <option
                                            value="{{$category->id}}" {{ ($category->id == $products->category_id)?"selected":"" }}>{{$category->name}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

{{--                        <div class="form-group">--}}
{{--                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_id">اسم الفئه الفرعية--}}
{{--                            </label>--}}
{{--                            <div class="col-md-6 col-sm-6 col-xs-12">--}}
{{--                                <select class="form-control" required id="exampleFormControlSelect1"--}}
{{--                                        class="form-control col-md-6 col-xs-12" name="subcategory_id">--}}
{{--                                    <option value="">---</option>--}}

{{--                                    @foreach ($subcategories as $category)--}}
{{--                                        <option--}}
{{--                                            value="{{$category->id}}" {{ ($category->id == $products->subcategory_id)?"selected":"" }}>{{$category->name}}</option>--}}
{{--                                    @endforeach--}}

{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_id">اسم الشركة
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" required id="exampleFormControlSelect1"
                                        class="form-control col-md-6 col-xs-12" name="company_id">
                                    <option value="">---</option>

                                    @foreach ($companies as $company)
                                        <option
                                            value="{{$company->id}}" {{ ($company->id == $products->company_id)?"selected":"" }}>{{$company->name}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> اسم المنتج باللغة العربية<span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="name" id="name" value="{{$products->name}}"
                                       class="form-control col-md-7 col-xs-12" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> اسم المنتج باللغة الانجليزية<span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="name_en" id="name" value="{{$products->name_en}}"
                                       class="form-control col-md-7 col-xs-12" required>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> كود المنتج <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="code" id="code" value="{{$products->code}}"
                                       class="form-control col-md-7 col-xs-12" required>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> نوع الوحدة باللغة العربية
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="unit_type" id="unit_type" value="{{$products->unit_type}}"
                                       class="form-control col-md-7 col-xs-12" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> نوع الوحدة باللغة الانجليزية
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="unit_type_en" id="unit_type" value="{{$products->unit_type_en}}"
                                       class="form-control col-md-7 col-xs-12" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="quantity_unit"> كمية الوحده
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" name="quantity_unit" id="quantity_unit"
                                       value="{{$products->quantity_unit}}" class="form-control col-md-7 col-xs-12"
                                       required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> نوع القطعه الواحده باللغة العربية
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="subunit_type" id="subunit_type"
                                       value="{{$products->subunit_type}}"
                                       class="form-control col-md-7 col-xs-12" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> نوع القطعه الواحده باللغة الانجليزية
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="subunit_type_en" id="subunit_type"
                                       value="{{$products->subunit_type_en}}"
                                       class="form-control col-md-7 col-xs-12" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price_total"> السعر جمله
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" step="0.01" name="price_total" id="price_total"
                                       value="{{$products->price_total}}"
                                       class="form-control col-md-7 col-xs-12" required>
                            </div>
                        </div>

{{--                        <div class="form-group">--}}
{{--                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price_total"> الخصم جمله--}}
{{--                            </label>--}}
{{--                            <div class="col-md-6 col-sm-6 col-xs-12">--}}
{{--                                <input type="number" step="0.01" name="discount_total" id="discount_total"--}}
{{--                                       value="{{$products->discount_total}}"--}}
{{--                                       class="form-control col-md-7 col-xs-12">--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group">--}}
{{--                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price_unit"> السعر قطاعى--}}
{{--                            </label>--}}
{{--                            <div class="col-md-6 col-sm-6 col-xs-12">--}}
{{--                                <input type="number" step="0.01" name="price_unit" id="price_unit"--}}
{{--                                       value="{{$products->price_unit}}"--}}
{{--                                       class="form-control col-md-7 col-xs-12" required>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group">--}}
{{--                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price_unit"> الخصم قطاعى--}}
{{--                            </label>--}}
{{--                            <div class="col-md-6 col-sm-6 col-xs-12">--}}
{{--                                <input type="number" step="0.01" name="discount_unit" id="discount_unit"--}}
{{--                                       value="{{$products->discount_unit}}"--}}
{{--                                       class="form-control col-md-7 col-xs-12">--}}
{{--                            </div>--}}
{{--                        </div>--}}

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description"> تفاصيل المنتج باللغة العربية
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea name="description" id="description"
                                          class="form-control col-md-7 col-xs-12"
                                          required>{{ $products->description }}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">  تفاصيل المنتج باللغة الانجليزية
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea name="description_en" id="description"
                                          class="form-control col-md-7 col-xs-12"
                                          required>{{ $products->description_en }}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> رقم الترتيب <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" name="rank_code" value="{{ $products->rank_code }}" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title" requied> طريقة البيع
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
{{--                                <input type="radio" name="is_unit" value="1"--}}
{{--                                       @if($products->is_unit=="1") checked @endif > جمله وقطاعى<br>--}}
                                <input type="radio" name="is_unit" value="0"
                                       @if($products->is_unit=="0") checked @endif > جمله فقط<br>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title" requied>تفعيل المنتج ؟
                            </label>
                            @if($products->status == 1)
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="radio" name="status" value="1" checked> نعم<br>
                                    <input type="radio" name="status" value="0"> لا<br>
                                </div>
                            @elseif($products->status == 0)
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="radio" name="status" value="1"> نعم<br>
                                    <input type="radio" name="status" value="0" checked> لا<br>
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title" requied>ايقاف المنتج
                            </label>

                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="radio" name="is_hidden" value="1"
                                       @if($products->is_hidden == 1) checked @endif> نعم<br>
                                <input type="radio" name="is_hidden" value="0"
                                       @if($products->is_hidden == 0) checked @endif > لا<br>
                            </div>

                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title" requied>تحديد كميه
                                للمنتج ؟
                            </label>
                            @if($products->quantity_status == 1)
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="radio" name="quantity_status" value="1" checked> نعم<br>
                                    <input type="radio" name="quantity_status" value="0"> لا<br>
                                </div>
                            @elseif($products->quantity_status == 0)
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="radio" name="quantity_status" value="1"> نعم<br>
                                    <input type="radio" name="quantity_status" value="0" checked> لا<br>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title" requied> وضع المنتج في
                                قائمه الانتظار
                            </label>
                            @if($products->waiting_status == 1)
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="radio" name="waiting_status" value="1" checked> نعم<br>
                                    <input type="radio" name="waiting_status" value="0"> لا<br>
                                </div>
                            @elseif($products->waiting_status == 0)
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="radio" name="waiting_status" value="1"> نعم<br>
                                    <input type="radio" name="waiting_status" value="0" checked> لا<br>
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> اقصي كميه متاحه
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" name="max_quantity" id="max_quantity"
                                       value="{{ $products->max_quantity }}" class="form-control col-md-7 col-xs-12"
                                       required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">صورة</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                        <img src="{{asset('uploads/products/'.$products->image)}}"  alt="Image" style="width:100%;height:100%;">
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                    <div>
                                        <span class="btn default btn-file">
                                            <span class="fileinput-new"> اضافة صوره  </span>
                                            <span class="fileinput-exists"> تغير </span>
                                            <input type="file" id="img" name="image" value="{{$products->image}}" > </span>
                                        <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> حذف </a>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button class="btn btn-primary" type="button"><a href="{{url('/')}}/admin/products"
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
