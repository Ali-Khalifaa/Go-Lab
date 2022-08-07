@extends('layouts.main')
@section('content')


    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>تعديل مسار الطلب </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>

                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br>
                    <form method="POST"
                          action="{{ url('admin/orders/'.$orders->order_id .'/'.$orders->user_id . '/track') }}"
                          enctype="multipart/form-data" orders-parsley-validate=""
                          class="form-horizontal form-label-left">

                        {{-- <input name="_method" type="hidden" value="PUT"> --}}
                        {{ csrf_field() }}


                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title" requied>مسار الاوردر
                            </label>

                            <div class="col-md-6 col-sm-6 col-xs-12" style="font-size: 15px;">
                                <input type="radio" name="stage_id" value="0"
                                       @if($orders->stage_id == 0) checked @endif> معلق<br>
                                <br>
                                <input type="radio" name="stage_id" value="1"
                                       @if($orders->stage_id == 1) checked @endif> جاري المعالجه<br>
                                <br>

                                <input type="radio" name="stage_id" value="2"
                                       @if($orders->stage_id == 2) checked @endif> تم التأكيد<br>
                                <br>

                                <input type="radio" name="stage_id" value="3"
                                       @if($orders->stage_id == 3) checked @endif> جاري التحضير<br>
                                <br>

                                <input type="radio" name="stage_id" value="4"
                                       @if($orders->stage_id == 4) checked @endif> في الطريق<br>
                                <br>

                                <input type="radio" name="stage_id" value="5"
                                       @if($orders->stage_id == 5) checked @endif> تم التسليم<br>


                            </div>

                        </div>

                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button class="btn btn-primary" type="button"><a href="{{url('/')}}/admin/orders"
                                                                                 style="color:white">إلغاء</a></button>
                                <button class="btn btn-primary" type="reset">ارسال</button>
                                <button type="submit" class="btn btn-success">تعديل</button>

                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
