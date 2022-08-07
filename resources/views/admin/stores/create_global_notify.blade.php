@extends('layouts.main')
@section('content')


    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>اضافة مكافأه عام</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <div class="ui warning message">
                                <div class="header">
                                    ملحوظة
                                </div>
                                لا يجب ان تكون نسبة المكافأه اكبر من نسبة المكسب!
                            </div>
                        </li>
                        <li>
                            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br>
                    <form method="POST" action="{{ url('admin/global_notify') }}" enctype="multipart/form-data"
                          categories-parsley-validate="" class="form-horizontal form-label-left">

                        {{ csrf_field() }}
                        <label>بيانات المكافأه الأساسية</label>
                        <div class="ln_solid"></div>
                        <div class="row">
                            <div class="form-group col-md-2">
                                <label for="inputEmail4">الحد الادني من السعر جملة</label>
                                <input type="number" min="1" name="min_total" class="form-control" id="inputEmail4"
                                       required>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputEmail4">الحد الادني من السعر قطاعي</label>
                                <input type="number" min="1" name="min_unit" class="form-control" id="inputEmail4"
                                       required>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputEmail4">ابتداء من تاريخ</label>
                                <input type="date" name="from" class="form-control" id="inputEmail4" required>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputEmail4">يتنهى في تاريخ</label>
                                <input type="date" name="to" class="form-control" id="inputEmail4" required>
                            </div>
                        </div>
                        <div class="ln_solid"></div>

                        @foreach($products as $index => $product)
                            <label>اسم المنتج : {{$product->name}}</label>
                            <div class="ln_solid"></div>

                            <input type="hidden" name="info[{{$product->id}}][product_id]" value="{{$product->id}}">

                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label for="inputEmail4">% نسبة المكافأه قطاعي</label>
                                    <input type="number" min="0" name="info[{{$product->id}}][discount_unit]"
                                           class="form-control" id="inputEmail4">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputPassword4">% نسبة المكافأه جملة</label>
                                    <input type="number" min="0" name="info[{{$product->id}}][discount_total]"
                                           class="form-control" id="inputPassword4">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputEmail4">نسبة المكافأه الفورية قطاعي</label>
                                    <input type="number" min="0" value="0" name="info[{{$product->id}}][now_unit]"
                                           class="form-control" id="inputEmail4">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputEmail4">نسبة المكافأه الأجلة قطاعي</label>
                                    <input type="number" min="0" value="0" name="info[{{$product->id}}][later_unit]"
                                           class="form-control" id="inputEmail4">
                                </div>
                                {{----}}
                                <div class="form-group col-md-2">
                                    <label for="inputEmail4">نسبة المكافأه الفورية جملة</label>
                                    <input type="number" min="0" value="0" name="info[{{$product->id}}][now_total]"
                                           class="form-control" id="inputEmail4">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputEmail4">نسبة المكافأه الأجلة جملة</label>
                                    <input type="number" min="0" value="0" name="info[{{$product->id}}][later_total]"
                                           class="form-control" id="inputEmail4">
                                </div>
                            </div>
                        @endforeach

                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button class="btn btn-primary" type="button"><a href="{{url('/')}}/admin/stores"
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
