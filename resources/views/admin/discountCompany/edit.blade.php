@extends('layouts.main')

@section('content')

    <script src="https://cdn.tinymce.com/4/tinymce.min.js"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: 'textArea',
            height: 160,
            toolbar: 'bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect | forecolor backcolor fontsizeselect | image media link table emoticons | bullist numlist | outdent indent blockquote | undo, redo removeformat | subscript superscript | restoredraft code',
            plugins: 'code textcolor colorpicker image emoticons link autolink autosave hr media table wordcount lists',
            menubar: "file edit insert format table"
        });
    </script>

    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{url('/admin')}}">لوحة التحكم</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{{url('admin/companies')}}">الشركات</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>{{$company->discount_status == 0 ? "اضافة":"تعديل"}}</span>
            </li>
        </ul>

    </div>
    <h1 class="page-title">{{$company->discount_status == 0 ? "اضافة خصم":"تعديل الخصم"}}</h1>
    @include('partials._errors')
    <div class="row">
        <div class="col-md-12">

            <!-- BEGIN SAMPLE FORM PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-green-haze">
                        <i class="icon-settings font-green-haze"></i>
                        <span class="caption-subject bold uppercase"> {{$company->discount_status == 0 ? "اضافة":"تعديل"}}</span>
                    </div>
                    <div class="actions">

                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;"
                           data-original-title="" title=""> </a>
                    </div>
                </div>
                <div class="portlet-body form" style="height: auto;">
                    <form method="POST" action="{{route('companyDiscount.update',$company->id)}}" role="form"
                          class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('put')}}

                        <div class="form-body">
                            <div class="form-group ">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="form_control_1">اضافة
                                    خصم</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control discount" name="discount_status" id="form_control_1">
                                        <option value="0" {{$company->discount_status == 0 ? "selected" : "" }}>لا يوجد خصم</option>
                                        <option value="1" {{$company->discount_status == 1 ? "selected" : "" }}>اضافة خصم</option>
                                    </select>
                                    <div class="form-control-focus"></div>
                                </div>
                            </div>

                            <div class="form-group gomla_discount">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price_total">نسبة الخصم
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="number"  step="0.01" name="percentage" id="discount_total"
                                           value="{{$company->percentage}}"
                                           class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-10">
                                        <a href="{{url('admin/companies')}}"
                                           class="btn default">الغاء</a>
                                        <button class="btn blue" type="reset">اعادة</button>
                                        <button type="submit" class="btn btn-success">تعديل</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
            <!-- END SAMPLE FORM PORTLET-->

        </div>
    </div>

    <script>
        document.querySelector('.discount').onchange = function () {
            if (this.value == 1) {
                document.querySelector('.gomla_discount').style.display = "block";
            } else {
                document.querySelector('.gomla_discount').style.display = "none";
                document.getElementById('discount_total').setAttribute('value', 0)
            }
        }
    </script>
@endsection
