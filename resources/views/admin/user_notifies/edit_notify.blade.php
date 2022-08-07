@extends('layouts.main')
@section('content')


    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>تعديل مكافأه خاص لمخزن {{$store->name}}</h2>
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
                    <form method="POST" action="{{ url('admin/stores/update_notify/'.$notify->id) }}"
                          enctype="multipart/form-data" categories-parsley-validate=""
                          class="form-horizontal form-label-left">
                        <input name="_method" type="hidden" value="PUT">

                        {{ csrf_field() }}
                        <label>بيانات المكافأه الأساسية</label>
                        <div class="ln_solid"></div>
                        <div class="row">
                            <div class="form-group col-md-2">
                                <label for="inputEmail4">الحد الادني من السعر جملة</label>
                                <input type="number" value="{{$notify->min_total}}" min="1" name="min_total"
                                       class="form-control" id="inputEmail4" required>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputEmail4">الحد الادني من السعر قطاعي</label>
                                <input type="number" value="{{$notify->min_unit}}" min="1" name="min_unit"
                                       class="form-control" id="inputEmail4" required>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputEmail4">ابتداء من تاريخ</label>
                                <input type="date" value="{{$notify->from}}" name="from" class="form-control"
                                       id="inputEmail4" required>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputEmail4">يتنهى في تاريخ</label>
                                <input type="date" value="{{$notify->to}}" name="to" class="form-control"
                                       id="inputEmail4" required>
                            </div>
                        </div>
                        <div class="ln_solid"></div>

                        @foreach($products as $index => $product)
                            <?php
                            $info = $product->infos()->wherePivot('store_id', '=', $store->id)->get();
                            $notify_unit = $notify_units->where('product_id', $product->id)->get()->first();
                            $true = true;
                            if (empty($notify_unit)) {
                                $true = false;
                            }
                            ?>
                            <label>اسم المنتج : {{$product->name}}</label>
                            <div class="ln_solid"></div>

                            <input type="hidden" name="info[{{$product->id}}][product_id]" value="{{$product->id}}">
                            <input type="hidden" name="store_id" value="{{$store->id}}">

                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label for="inputEmail4">% نسبة المكافأه قطاعي</label>
                                    <input type="number" min="0" max="{{$info->first()->sp_unit_percentage}}"
                                           value="{{$true?$notify_unit->discount_unit:''}}"
                                           name="info[{{$product->id}}][discount_unit]" class="form-control"
                                           id="inputEmail4">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputPassword4"> % نسبة المكسب قطاعي</label>
                                    <input type="number" readonly value="{{$info->first()->sp_unit_percentage}}"
                                           name="info[{{$product->id}}][revenue_unit]" class="form-control"
                                           id="inputPassword4">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputPassword4">% نسبة المكافأه جملة</label>
                                    <input type="number" min="0" max="{{$info->first()->sp_total_percentage}}"
                                           value="{{$true?$notify_unit->discount_total:''}}"
                                           name="info[{{$product->id}}][discount_total]" class="form-control"
                                           id="inputPassword4">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputPassword4">% نسبة المكسب جملة</label>
                                    <input type="number" readonly value="{{$info->first()->sp_total_percentage}}"
                                           name="info[{{$product->id}}][revenue_total]" class="form-control"
                                           id="inputPassword4">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label for="inputEmail4">نسبة المكافأه الفورية قطاعي</label>
                                    <input type="number" min="0" max="{{$info->first()->sp_unit_percentage}}"
                                           value="{{$true?$notify_unit->now_unit:''}}"
                                           name="info[{{$product->id}}][now_unit]" class="form-control"
                                           id="inputEmail4">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputEmail4">نسبة المكافأه الأجلة قطاعي</label>
                                    <input type="number" min="0" max="{{$info->first()->sp_unit_percentage}}"
                                           value="{{$true?$notify_unit->later_unit:''}}"
                                           name="info[{{$product->id}}][later_unit]" class="form-control"
                                           id="inputEmail4">
                                </div>
                                {{----}}
                                <div class="form-group col-md-2">
                                    <label for="inputEmail4">نسبة المكافأه الفورية جملة</label>
                                    <input type="number" min="0" max="{{$info->first()->sp_total_percentage}}"
                                           value="{{$true?$notify_unit->now_total:''}}"
                                           name="info[{{$product->id}}][now_total]" class="form-control"
                                           id="inputEmail4">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputEmail4">نسبة المكافأه الأجلة جملة</label>
                                    <input type="number" min="0" max="{{$info->first()->sp_total_percentage}}"
                                           value="{{$true?$notify_unit->later_total:''}}"
                                           name="info[{{$product->id}}][later_total]" class="form-control"
                                           id="inputEmail4">
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
