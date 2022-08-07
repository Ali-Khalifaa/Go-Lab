@extends('layouts.main')
@section('content')


    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>اضافة مكافأه خاص للعميل {{$user->name}}</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <div class="ui warning message">
                                <div class="header">
                                    لا يجب ان تكون نسبة المكافأه اكبر من نسبة المكسب!
                                </div>
                                القيم الموجودة حاليا هي القيم الموجوده بالمكافأه على المخزن او العام
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
                    <form method="POST" action="{{ url('admin/user_notifies') }}" enctype="multipart/form-data"
                          categories-parsley-validate="" class="form-horizontal form-label-left">
                        <input type="hidden" name="notify_id" value="{{$notify->id}}">
                        <input type="hidden" name="user_id" value="{{$user->id}}">

                        {{ csrf_field() }}

                        @foreach($notify_units as $index => $unit)
                            <?php
                            $product = $unit->product;
                            $store_id = is_null($notify->store) ? 0 : $notify->store->id;
                            $info = $unit->product->infos()->wherePivot('store_id', '=', $store_id)->get();
                            ?>
                            <input type="hidden" name="info[{{$product->id}}][product_id]" value="{{$product->id}}">
                            @if($store_id == 0)
                                <label>اسم المنتج : {{$unit->product->name}}</label>
                                <div class="ln_solid"></div>

                                <input type="hidden" name="info[{{$unit->product->id}}][product_id]"
                                       value="{{$unit->product->id}}">

                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail4">% نسبة المكافأه قطاعي</label>
                                        <input type="number" min="0" name="info[{{$unit->product->id}}][discount_unit]"
                                               value="{{$unit->discount_unit}}" class="form-control" id="inputEmail4">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputPassword4">% نسبة المكافأه جملة</label>
                                        <input type="number" min="0" name="info[{{$unit->product->id}}][discount_total]"
                                               value="{{$unit->discount_total}}" class="form-control"
                                               id="inputPassword4">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail4">نسبة المكافأه الفورية قطاعي</label>
                                        <input type="number" min="0" value="{{$unit->now_unit}}"
                                               name="info[{{$unit->product->id}}][now_unit]" class="form-control"
                                               id="inputEmail4">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail4">نسبة المكافأه الأجلة قطاعي</label>
                                        <input type="number" min="0" value="{{$unit->later_unit}}"
                                               name="info[{{$unit->product->id}}][later_unit]" class="form-control"
                                               id="inputEmail4">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="inputEmail4">نسبة المكافأه الفورية جملة</label>
                                        <input type="number" min="0" value="{{$unit->now_total}}"
                                               name="info[{{$unit->product->id}}][now_total]" class="form-control"
                                               id="inputEmail4">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail4">نسبة المكافأه الأجلة جملة</label>
                                        <input type="number" min="0" value="{{$unit->later_total}}"
                                               name="info[{{$unit->product->id}}][later_total]" class="form-control"
                                               id="inputEmail4">
                                    </div>
                                </div>
                            @else
                                <label>اسم المنتج : {{$unit->product->name}}</label>
                                <div class="ln_solid"></div>

                                <input type="hidden" name="info[{{$unit->product->id}}][product_id]"
                                       value="{{$unit->product->id}}">
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail4">% نسبة المكافأه قطاعي</label>
                                        <input type="number" min="0" max="{{$info->first()->sp_unit_percentage}}"
                                               value="{{$unit->discount_unit}}"
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
                                               value="{{$unit->discount_total}}"
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
                                               value="{{$unit->now_unit}}" name="info[{{$product->id}}][now_unit]"
                                               class="form-control" id="inputEmail4">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail4">نسبة المكافأه الأجلة قطاعي</label>
                                        <input type="number" min="0" max="{{$info->first()->sp_unit_percentage}}"
                                               value="{{$unit->later_unit}}" name="info[{{$product->id}}][later_unit]"
                                               class="form-control" id="inputEmail4">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="inputEmail4">نسبة المكافأه الفورية جملة</label>
                                        <input type="number" min="0" max="{{$info->first()->sp_total_percentage}}"
                                               value="{{$unit->now_total}}" name="info[{{$product->id}}][now_total]"
                                               class="form-control" id="inputEmail4">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail4">نسبة المكافأه الأجلة جملة</label>
                                        <input type="number" min="0" max="{{$info->first()->sp_total_percentage}}"
                                               value="{{$unit->later_total}}" name="info[{{$product->id}}][later_total]"
                                               class="form-control" id="inputEmail4">
                                    </div>
                                </div>
                            @endif


                        @endforeach

                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button class="btn btn-primary" type="button"><a href="{{url('/')}}/admin/stores"
                                                                                 style="color:white">إلغاء</a></button>
                                <button class="btn btn-primary" type="reset">إعاده</button>
                                <button type="submit" class="btn btn-success">اضافة</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
