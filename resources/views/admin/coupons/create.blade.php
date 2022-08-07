@extends('layouts.main')
@section('content')


    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{url('/admin')}}">لوحة التحكم</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{{url('/admin/coupons')}}"> برومو كود </a>
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
                    <form method="POST" action="{{ Route('coupons.store') }}" enctype="multipart/form-data"
                          data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">

                        {{ csrf_field() }}


                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">اسم البرومو كود باللغة العربية<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="title" id="name" value="{{old('title')}}"
                                       class="form-control col-md-7 col-xs-12" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">اسم البرومو كود باللغة الانجليزية<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="title_en" id="name" value="{{old('title_en')}}"
                                       class="form-control col-md-7 col-xs-12" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">نسبة الخصم<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" name="percentage" id="name" value="{{old('percentage')}}"
                                       class="form-control col-md-7 col-xs-12" required>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="form_control_1">نوع الكود</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control discount" name="code_type" id="form_control_1">
                                    <option value="0">كود عشوائي</option>
                                    <option value="1">اضافة كود</option>
                                </select>
                                <div class="form-control-focus"></div>
                            </div>
                        </div>

                        <div class="form-group gomla_discount">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price_total"> الكود
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text"  name="code" id="discount_total" value="0"
                                       class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">تاريخ الانتهاء<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="date" name="end_date" id="name" value="{{old('end_date')}}"
                                       class="form-control col-md-7 col-xs-12" required>
                            </div>
                        </div>



                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button class="btn btn-primary" type="button"><a href="{{url('/')}}/admin/coupons"
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

    <script>
        console.log('asdas')
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
