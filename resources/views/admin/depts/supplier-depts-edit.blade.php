@extends('layouts.main')
@section('content')


    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>تعديل المديونيه</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>

                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br>
                    <form method="POST" action="{{ url('admin/supplier_depts/'.$depts->id) }}"
                          enctype="multipart/form-data" categories-parsley-validate=""
                          class="form-horizontal form-label-left">

                        <input name="_method" type="hidden" value="POST">
                        {{ csrf_field() }}


                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">اسم المورد <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" readonly name="user_id" id="user_id"
                                       value="{{ $depts->supplier->name }}" class="form-control col-md-7 col-xs-12"
                                       required>
                            </div>
                        </div>


                        <input type="hidden" name="order_id" id="order_id" value="{{ $depts->examination_id }}"
                               class="form-control col-md-7 col-xs-12">


                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> الإجمالي
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="hidden" name="total" id="total" value="{{ $depts->examination->total }}"
                                       class="form-control col-md-7 col-xs-12">
                                <label type="number" name="total" id="total" value="{{ $depts->examination->total }}"
                                       class="form-control col-md-7 col-xs-12">{{ $depts->examination->total }}</label>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="paid"> المبلغ المدفوع <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" readonly name="paid" id="paid"
                                       value="{{ $depts->examination->paid }}" class="form-control col-md-7 col-xs-12"
                                       required>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="paid"> المتبقى <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" readonly name="amount" id="amount" value="{{ $depts->amount }}"
                                       class="form-control col-md-7 col-xs-12" required>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="paid"> تم دفع مبلغ اضافى <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" name="additional_amount" id="additional_amount" value="0"
                                       class="form-control col-md-7 col-xs-12" required>
                            </div>
                        </div>

                        <!--<div class="form-group">-->
                        <!--  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="discount"> التاريخ <span class="required">*</span>-->
                        <!--  </label>-->
                        <!--  <div class="col-md-6 col-sm-6 col-xs-12">-->
                    <!--    <input  type="text"  name="date" id="date" value="{{ $depts->date }}" class="form-control col-md-7 col-xs-12" required>-->
                        <!--  </div>-->
                        <!--</div>-->

                        <!--<div class="form-group">-->
                        <!--  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="discount"> المكافأه <span class="required">*</span>-->
                        <!--  </label>-->
                        <!--  <div class="col-md-6 col-sm-6 col-xs-12">-->
                    <!--    <input  type="number"  name="discount" id="discount" value="{{ $depts->discount }}" class="form-control col-md-7 col-xs-12" required>-->
                        <!--  </div>-->
                        <!--</div>-->

                        <!--<div class="form-group">-->
                        <!--  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="paytype"> طريقه الدفع <span class="required">*</span>-->
                        <!--  </label>-->
                        <!--  <div class="col-md-6 col-sm-6 col-xs-12">-->
                    <!--    <input  type="text"  name="paytype" id="paytype" value="{{ $depts->paytype }}" class="form-control col-md-7 col-xs-12" required>-->
                        <!--  </div>-->
                        <!--</div>-->


                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button class="btn btn-primary" type="button"><a href="{{url('/')}}/admin/depts"
                                                                                 style="color:white">إلغاء</a></button>
                                <button class="btn btn-primary" type="reset">اعاده</button>
                                <button type="submit" class="btn btn-success">تعديل</button>

                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
