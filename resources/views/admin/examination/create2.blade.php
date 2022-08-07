@extends('layouts.main-old-jemy')
@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2> عمل فاتورة شراء لمخزن {{$store->name}}  </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>

                    </ul>
                    <div class="clearfix"></div>
                </div>
                <form method="POST" action="{{ Route('examinations.store') }}" enctype="multipart/form-data"
                      data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
                    <div class="x_content">
                        <br>


                        {{ csrf_field() }}

                        <input type="hidden" name="supplier_id" value="{{$supplier_id}}" >
                        <input type="hidden" name="rest_price" value="{{$rest_price}}" >
                    <!--<input type="hidden" name="rest_price" value="{{$rest_price}}" >-->
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label for="inputEmail4">اجمالي الفتورة</label>
                                <input type="number" name="total" value="" min="0" class="form-control" id="inputEmail4"
                                       required>
                            </div>

                            <div class="form-group col-md-2">
                                <label for="inputEmail4"> مصاريف الشحن </label>
                                <input type="number" name="delivery_price" value="0" min="0" class="form-control" id="inputEmail4"
                                       required>
                            </div>

                            <div class="form-group col-md-2">
                                <label for="inputEmail4"> مصروفات اخرى </label>
                                <input type="number" name="additional_price" value="0" min="0" class="form-control" id="inputEmail4"
                                       required>
                            </div>


                        </div>
                        <div class="clearfix"></div>
                        <div class="form-group" style="display: block;">



                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_id">المنتجات
                            </label>



                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="ui fluid search dropdown" id="members_dropdown" multiple="" required
                                        id="exampleFormControlSelect1" class="form-control col-md-6 col-xs-12">
                                    @foreach ($products as $product)
                                        <option value="{{$product->id}}">{{$product->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="dtBox"></div>
                            <div class="ui toggle checkbox">
                                <input type="checkbox" id="selectall">
                                <label>تحديد الكل</label>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        @foreach($products as $index => $product)

                            <div class="form-group" style="display: block;" >
                                <div class="{{$product->id}} box-custom" >
                                    <label> <span style="color: red;"> اسم المنتج </span> : {{$product->name}}
                                        <br>
                                        <span style="color: red;"> اسم الشركه </span>  :{{$product->company->name}}  </label>
                                    <input type="hidden" name="products[{{$product->id}}][product]"
                                           value="{{$product->id}}">
                                    <div class="form-row">
                                        <div class="form-group col-md-1" style="display: block;">
                                            <label for="inputEmail4">استلام</label>
                                            <input type="number" name="products[{{$product->id}}][receive]" value="" min="0"
                                                   class="form-control" id="inputEmail4" required>
                                        </div>
                                        <div class="form-group col-md-2" style="display: block;">
                                            <label for="inputEmail4">باجمالي سعر شراء</label>
                                            <input type="number" name="products[{{$product->id}}][total_price]" value=""
                                                   min="0" class="form-control" id="inputEmail4" required>
                                        </div>
                                        <div class="form-group col-md-2" style="display: block;">
                                            <label for="inputPassword4">حالة البضاعة </label>
                                            <select class="form-select form-control"
                                                    name="products[{{$product->id}}][receipt_status]"
                                                    aria-label="Default select example" style="width: auto;" >
                                                @foreach($receipt_statuses as $receipt_status)
                                                    <option
                                                        value="{{$receipt_status->id}}">{{$receipt_status->status}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2" style="display: block;">
                                            <label for="inputEmail4">بتاريخ انتاج</label>
                                            <input type="date" name="products[{{$product->id}}][production_date]"
                                                   class="form-control" id="inputEmail4" required>
                                        </div>
                                        <div class="form-group col-md-2" style="display: block;">
                                            <label for="inputEmail4">بتاريخ صلاحيه</label>
                                            <input type="date" name="products[{{$product->id}}][expiry_date]"
                                                   class="form-control" id="inputEmail4" required>
                                        </div>
                                        <!--<div class="form-group col-md-1" style="display: block;">-->
                                        <!--    <label for="inputPassword4">ارجاع</label>-->
                                    <!--    <input type="number" name="products[{{$product->id}}][recall]" value="" min="0"-->
                                        <!--           class="form-control" id="inputPassword4" required>-->
                                        <!--</div>-->
                                        <!--<div class="form-group col-md-2" style="display: block;" >-->
                                        <!--    <label for="inputPassword4">سبب الاسترجاع </label>-->
                                        <!--    <select class="form-select form-control"-->
                                    <!--            name="products[{{$product->id}}][return_reason]"-->
                                        <!--            aria-label="Default select example" style="width: 85px;" >-->
                                    <!--        @foreach($return_reasons as $return_reason)-->
                                        <!--            <option-->
                                    <!--                value="{{$return_reason->id}}">{{$return_reason->status}}</option>-->
                                        <!--        @endforeach-->
                                        <!--    </select>-->
                                        <!--</div>-->
                                        <hr style="height: 1px;color: #123455;background-color: #123455;border: none;background: black;margin: 5px;" >
                                    </div>

                                </div>
                            </div>
                            <br>
                        @endforeach

                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group" style="display: block;" >
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button class="btn btn-primary" type="button"><a href="{{url('/')}}/admin/examinations"
                                                                             style="color:white">إلغاء</a></button>
                            <button class="btn btn-primary" type="reset">إعاده</button>
                            <button type="submit" class="btn btn-success">اضافه</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection
