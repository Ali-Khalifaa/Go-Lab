@extends('layouts.main')
@section('content')


    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>تعديل منتجات المخزن</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>

                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br>
                    <form method="POST" action="{{ url('admin/stores/product_info/'.$store->id) }}"
                          enctype="multipart/form-data" categories-parsley-validate=""
                          class="form-horizontal form-label-left">

                        {{ csrf_field() }}

                        @foreach($products as $index => $product)
                            <?php
                            $info = $product->infos()->wherePivot('store_id', '=', $store->id)->get();
                            ?>
                            <label>اسم المنتج : {{$product->name}}</label>
                            <input type="hidden" name="info[{{$product->id}}][product]" value="{{$product->id}}">
                            <input type="hidden" name="info[{{$product->id}}][id]" value="{{$info->first()->id}}">
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="inputEmail4">الحد الأدني</label>
                                    <input type="number" min="0" name="info[{{$product->id}}][lower_limit]"
                                           value="{{$info->first()->lower_limit}}" class="form-control" id="inputEmail4"
                                           required>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputEmail4">حد اعادة الطلب</label>
                                    <input type="number" min="0" name="info[{{$product->id}}][reorder_limit]"
                                           value="{{$info->first()->reorder_limit}}" class="form-control"
                                           id="inputEmail4" required>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputEmail4">الحد الاقصى</label>
                                    <input type="number" min="0" name="info[{{$product->id}}][max_limit]"
                                           value="{{$info->first()->max_limit}}" class="form-control" id="inputEmail4"
                                           required>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputPassword4">سعر الشراء</label>
                                    <input type="number" min="0" name="info[{{$product->id}}][buy_price]"
                                           value="{{$info->first()->buy_price}}" class="form-control"
                                           id="inputPassword4" required>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputPassword4"> % نسبة المكسب تجزئة</label>
                                    <input type="number" min="0" name="info[{{$product->id}}][sp_unit_percentage]"
                                           value="{{$info->first()->sp_unit_percentage}}" class="form-control"
                                           id="inputPassword4" required>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputPassword4">% نسبة المكسب جملة</label>
                                    <input type="number" min="0" name="info[{{$product->id}}][sp_total_percentage]"
                                           value="{{$info->first()->sp_total_percentage}}" class="form-control"
                                           id="inputPassword4" required>
                                </div>
                            </div>
                        @endforeach

                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button class="btn btn-primary" type="button"><a href="{{url('/')}}/admin/stores/"
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
