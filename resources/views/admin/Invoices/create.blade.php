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
                    <h2>اضافه طلب</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br>
                    <form method="POST" id="formSubmit" action="{{ Route('orders.store') }}"
                          enctype="multipart/form-data"
                          data-parsley-validate="" class="form-horizontal form-label-left">
                        {{ csrf_field() }}
                        <input type="hidden" name="store_id" value="{{ $store->id }}">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_id">نوع
                                الفاتوره </label>
                            <div class="col-md-6 col-sm-6 col-xs-12" required>
                                <div onchange="viewBack(event.target.value)"
                                     class="ui fluid search selection dropdown checkDrop " style="text-align: center;"
                                     required>
                                    <input type="hidden" name="invoice_type" required>
                                    <i class="dropdown icon"></i>
                                    <div class="default text" required>نوع الفاتوره</div>
                                    <div class="menu">
                                        <div class="item" data-value="0">عرض اسعار</div>
                                        <div class="item" data-value="1">بيان اسعار</div>
                                        <div class="item" data-value="2">فاتورة مبيعات</div>
                                        <div class="item" data-value="3">مرتجع مبيعات</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_id">العميل </label>
                            <div class="col-md-6 col-sm-6 col-xs-12" required>
                                <div class="ui fluid search selection dropdown" style="text-align: center;" required>
                                    <input type="hidden" name="user_id" required>
                                    <i class="dropdown icon"></i>
                                    <div class="default text" required>العميل</div>
                                    <div class="menu">
                                        @foreach ($users as $user)
                                            <div class="item" data-value="{{ $user->id }}">{{ $user->name }}
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_id">المنتجات
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="ui fluid search dropdown" id="members_dropdown" multiple="" required
                                        class="form-control testSelec col-md-6 col-xs-12">
                                <!--@foreach ($products as $product)-->
                                <!--    <option value="{{ $product->id }}">{{$product->code}}</option>-->
                                    <!--@endforeach-->
                                </select>
                            </div>

                            <div class="col-md-3">
                                <input type="text" id="barcode" class="form-control" placeholder="Bar code Search">
                            </div>
                        </div>
                        <div class="form-group" style="justify-content: center;">
                            <p style="margin-left: 5%;">نوع البيع:</p>
                            <input type="radio" id="html" name="type" value="0" checked>
                            <label for="html" style="margin-left: 25px;">جمله </label><br>
                            {{--                            <input type="radio" id="css" name="type" value="1">--}}
                            {{--                            <label for="css">قطاعى </label><br>--}}
                            <br>
                        </div>
                        <!-- gemy-->
                        <div class="clearfix"></div>
                        @foreach ($products as $index => $product)
                            @if ($product->infos()->wherePivot('store_id', '=', $store->id)->get()->first() != null)
                                <?php
                                $product_info = $product
                                    ->infos()
                                    ->wherePivot('store_id', '=', $store->id)
                                    ->get()
                                    ->first();
                                ?>
                                <div class="clearfix"></div>
                                <div id="{{ $product->id }}" class="{{ $product->id }} box-custom">
                                    <label> <span style="color: red;"> اسم المنتج </span> :
                                        <span style="font-size:120%">{{ $product->name }} </span>
                                        <br>
                                        @if (Auth::user()->id == 1 || Auth::user()->id == 2)
                                            <label> <span style="color: red;"> سعر الشراء </span> :
                                                <span style="font-size:120%">
                                                {{ $product_info->buy_price }}
                                                </span>
                                                <br>
                                                @endif
                                                <br>
                                            <!--<span style="color: red;"> اسم الشركه </span>  :{{ $product->company->name }} </label>-->
                                                <input type="hidden" name="products[{{ $product->id }}][product]"
                                                       value="{{ $product->id }}">
                                                <input type="hidden" name="products[{{ $product->id }}][buy_price]"
                                                       value="{{ $product_info->buy_price }}">
                                                <div style="display : flex  ; padding : 20px 0" class="row  form-row "
                                                     style="">
                                                    <div class="col-md-4">
                                                        <div style="display : flex" class="row">
                                                            <label for="inputEmail4" class="col-md-6"> الكميه
                                                                <br>
                                                                <span style="color: #0a6aa1">المتاح منها ({{$product->infos()->wherePivot('store_id','=',$store->id)->get()->first()->quantity}}) </span></label>
                                                            <div class="col-md-6">
                                                                <input type="number"
                                                                       name="products[{{ $product->id }}][quantity]"
                                                                       value="0"
                                                                       min="0"
                                                                       max="{{$product->infos()->wherePivot('store_id', '=', $store->id)->get()->first()->quantity}}"
                                                                       class="form-control  gomlaQuantity "
                                                                       id="inputEmail4" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" class="product_gomla_price"
                                                           value="{{ $product->price_total }}">
                                                    <input type="hidden" class="product_gomla_discount"
                                                           value="{{$product->discount_total != 0 && $product->date_end >= now() ? $product->discount_total : 0 }}">
                                                    <input type="hidden" class="product_unit_price"
                                                           value="{{ $product->price_unit }}">
                                                    <input type="hidden" class="product_unit_discount"
                                                           value="{{ $product->discount_unit }}">
                                                    <div class="col-md-4">
                                                        <div style="display : flex" class="row">
                                                            <label for="inputEmail4" class="col-md-3"> السعر </label>
                                                            <div class="col-md-9">
                                                                <input type="number" readonly
                                                                       name="products[{{ $product->id }}][price]"
                                                                       value="0"
                                                                       min="0"
                                                                       class="form-control  gomlaPrice  unitYousri"
                                                                       id="inputEmail4" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <!--<label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_id">  حالة المرتجع  </label>-->
                                                        <div class="row" style="display: flex;">
                                                            <label class="col-md-3">تواريخ الصلاحيه </label>
                                                            <div class="col-md-9 col-sm-6 col-xs-12">
                                                                <div class="  ui fluid search selection dropdown"
                                                                     style="text-align: center;">
                                                                    <input type="hidden"
                                                                           name="products[{{ $product->id }}][info_id]">
                                                                    <i class="dropdown icon"></i>
                                                                    <div class="default text"> تواريخ الصلاحيه</div>
                                                                    <div class="menu">

                                                                        <input hidden name="length" id="length"
                                                                               value="{{$product_info->info_expirations()->count()}}">
                                                                        @foreach ($product_info->info_expirations as $index=>$info_expirations)
                                                                            <?php
                                                                            $i = ++$index;
                                                                            ?>

                                                                            <div class="item expire_base"
                                                                                 id="expire_base{{$i}}"
                                                                                 data-value="{{ $info_expirations->id }}">

                                                                                {{ $info_expirations->production_date }}
                                                                                ---{{ $info_expirations->expiry_date }}
                                                                                --متاح
                                                                                ({{ $info_expirations->quantity_total}}
                                                                                )

                                                                            </div>
                                                                            <input hidden name="expire_total"
                                                                                   id="expire_total{{$i}}"
                                                                                   value="{{ $info_expirations->production_date }} ---{{ $info_expirations->expiry_date }} --متاح  ({{ $info_expirations->quantity_total}})  ">
                                                                            <input hidden name="expire_unit"
                                                                                   id="expire_unit{{$i}}"
                                                                                   value="{{ $info_expirations->production_date }} ---{{ $info_expirations->expiry_date }} --متاح  ({{ $info_expirations->quantity_unit}})  ">
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="display : flex; padding : 20px 0 " class="row">
                                                    <div class="col-md-4">
                                                        <div style="display : flex" class="row">
                                                            <label for="inputEmail4" class="col-md-3"> الخصم الاضافى
                                                                مبلغ
                                                            </label>
                                                            <div class="form-group col-md-9">
                                                                <input type="number"
                                                                       name="products[{{ $product->id }}][additional_discount_price]"
                                                                       value="0" min="0" step="0.01"
                                                                       class="form-control  " id="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div style="display : flex" class="row">
                                                            <label for="inputEmail4" class="col-md-3"> الخصم الاضافى
                                                                نسبه
                                                            </label>
                                                            <div class="form-group col-md-9">
                                                                <input type="number"
                                                                       name="products[{{ $product->id }}][additional_discount_percentage]"
                                                                       value="0" min="0" step="0.01"
                                                                       class="form-control  " id="">
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div style="display : flex ;padding : 20px 0 " class="row backSection ">
                                                    <div class="col-md-6 ">
                                                        <div class="row">
                                                            <div class="col-md-12 col-sm-6 col-xs-12 ">
                                                                <label> حالة المرتجع </label>
                                                                <div class="ui fluid search selection dropdown"
                                                                     style="text-align: center;">
                                                                    <input type="hidden"
                                                                           name="products[{{ $product->id }}][return_status]">
                                                                    <i class="dropdown icon"></i>
                                                                    <div class="default text"> حالة المرتجع</div>
                                                                    <div class="menu">
                                                                        @foreach ($return_reason as $return_reas)
                                                                            <div class="item"
                                                                                 data-value="{{ $return_reas->id }}">
                                                                                {{ $return_reas->status }} </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <hr style="height: 1px;color: #123455;background-color: #123455;border: none;background: black;margin: 5px;">
                                </div>
                            @endif
                        <!--<div class="clearfix"></div>-->
                        @endforeach
                        <div class="clearfix"></div>
                        <!-- gemy-->
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12 col-sm-6 col-xs-12">
                                    <label> طريقة السداد </label>
                                    <div class="ui fluid search selection dropdown" style="text-align: center;"
                                         onchange="myFunction()">
                                        <input type="hidden"
                                               name="payment_type" onchange="myFunction()" id="mySelect">
                                        <i class="dropdown icon"></i>
                                        <div class="default text"> طريقة السداد</div>
                                        <div class="menu">
                                            <div class="item"
                                                 data-value="0">
                                                عند الاستلام
                                            </div>
                                            <div class="item"
                                                 data-value="1">
                                                اجل
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group col-md-12 col-sm-6 col-xs-12" style="margin-top: 10px">
                                    <label> نوع الفاتورة </label>
                                    <div class="ui fluid search selection dropdown" style="text-align: center;">
                                        <input type="hidden"
                                               name="fatora_dripa" id="mySelect">
                                        <i class="dropdown icon"></i>
                                        <div class="default text"> فاتورة غير ضريبية</div>
                                        <div class="menu default">
                                            <div class="default item"
                                                 data-value="0">
                                                فاتورة غير ضريبية
                                            </div>
                                            <div class="item"
                                                 data-value="1">
                                                فاتورة ضريبية
                                            </div>
                                        </div>
                                    </div>

                                </div>


                                <div class="col-md-4">
                                    <div style="display : flex" class="row">
                                        <label for="inputPassword4"> ضريبه قيمه مضافه </label>
                                        <div class="form-group col-md-9">
                                            <input type="number" class="form-control "
                                                   name="qema_modafa" value="0">
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div style="display : flex" class="row">
                                        <label for="inputEmail4" class="col-md-3"> قيمة الشحن
                                        </label>
                                        <div class="form-group col-md-9">
                                            <input type="number"
                                                   name="delivery_amount"
                                                   value="0" min="0" step="0.01" class="form-control  " id="">
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div style="display : flex" class="row">
                                        <label for="inputEmail4" class="col-md-3"> نسبة الفيزا
                                        </label>
                                        <div class="form-group col-md-9">
                                            <input type="number"
                                                   name="visa_amount"
                                                   value="0" min="0" step="0.01" class="form-control  " id="">
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <!--   -->
                        <div class="ln_solid"></div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button class="btn btn-primary" type="button"><a
                                            href="{{ url('/admin/direct_sells') }}"
                                            style="color:white">إلغاء</a></button>
                                    <button class="btn btn-primary" type="reset">إعاده</button>
                                    <button type="button" id="submiting" class="btn btn-success">اضافه</button>
                                    <button type="button" class="btn btn-danger" id="showTotal" class="btn btn-success"
                                            style="position: fixed;top: 305px;left: 20px;">عرض الاجمالي
                                    </button>
                                    <div style="position: fixed;top: 340px;left: 20px;display: grid;">
                                        <div class="form-group col-md-2">
                                            <input type="text" readonly value="0" class="form-control unitPrice"
                                                   id="totalGomlaPrice" style="width: 100px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input hidden id="demo" name="paid_value">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
@endsection
@section('javascript1')
    <script>


        $('.gomlaQuantity').on('keyup', function () {
            $gomlaQuantity = $(this).val();
            console.log($gomlaQuantity)
            $baseGomlaPrice = $(this).parents('.form-row').find('.product_gomla_price').val();
            console.log($baseGomlaPrice)
            $baseGomlaDiscount = $(this).parents('.form-row').find('.product_gomla_discount').val();
            console.log($baseGomlaDiscount)
            if ($gomlaQuantity == 0) {
                $percentage = 0;
            } else {
                $percentage = (($baseGomlaPrice - $baseGomlaDiscount) * $gomlaQuantity);
            }
            $(this).parents('.form-row').find('.gomlaPrice').val($percentage);
        });

        $('input[type=radio][name=type]').change(function () {

            if (this.value == '0') {

                $('.gomlaQuantity').on('keyup', function () {
                    $gomlaQuantity = $(this).val();
                    console.log($gomlaQuantity)
                    $baseGomlaPrice = $(this).parents('.form-row').find('.product_gomla_price').val();
                    console.log($baseGomlaPrice)
                    $baseGomlaDiscount = $(this).parents('.form-row').find('.product_gomla_discount').val();
                    console.log($baseGomlaDiscount)
                    if ($gomlaQuantity == 0) {
                        $percentage = 0;
                    } else {
                        $percentage = (($baseGomlaPrice - $baseGomlaDiscount) * $gomlaQuantity);
                    }
                    $(this).parents('.form-row').find('.gomlaPrice').val($percentage);
                });

                // $expire_total =document.getElementById('expire_total1').value;
                // $expire_unit =document.getElementById('expire_unit2').value;
                $length = document.getElementById('length').value;

                // $expire_base =document.getElementById('expire_base');
                // console.log($expire_unit)
                // $expire_base.innerHTML= $expire_unit ;


                for (let i = 1; i <= $length; i++) {
                    console.log(document.getElementById(`expire_base${i}`))
                    document.getElementById(`expire_base${i}`).innerHTML = document.getElementById(`expire_total${i}`).value
                }


//  id="expire_total"
//  id="expire_unit"

            } else if (this.value == '1') {
                $('.gomlaQuantity').on('keyup', function () {
                    $gomlaQuantity = $(this).val();
                    console.log($gomlaQuantity)
                    $baseGomlaPrice = $(this).parents('.form-row').find('.product_unit_price').val();
                    console.log($baseGomlaPrice)
                    $baseGomlaDiscount = $(this).parents('.form-row').find('.product_unit_discount').val();
                    console.log($baseGomlaDiscount)
                    if ($gomlaQuantity == 0) {
                        $percentage = 0;
                    } else {
                        $percentage = (($baseGomlaPrice - $baseGomlaDiscount) * $gomlaQuantity);
                    }
                    $(this).parents('.form-row').find('.gomlaPrice').val($percentage);
                });

                // $expire_total =document.getElementById('expire_total1').value;
                // $expire_unit =document.getElementById('expire_unit2').value;
                $length = document.getElementById('length').value;

                // $expire_base =document.getElementById('expire_base');
                // console.log($expire_unit)
                // $expire_base.innerHTML= $expire_unit ;


                for (let i = 1; i <= $length; i++) {
                    console.log(document.getElementById(`expire_base${i}`))
                    document.getElementById(`expire_base${i}`).innerHTML = document.getElementById(`expire_unit${i}`).value
                }

            }
        });
        // for calculate total price
        let totalGomla = 0;

        function getAllGomlaAndCalculate() {
            totalGomla = 0;
            $('.unitYousri:visible').each(function () {
                totalGomla = Number($(this).val()) + totalGomla;
            });
            return totalGomla;
        };
        $('#showTotal').on('click', function () {
            getAllGomlaAndCalculate();
            document.getElementById('totalGomlaPrice').setAttribute('value', getAllGomlaAndCalculate())
            $('#totalGomlaPrice').css('display', 'block');
        });

        // prombet
        function myFunction() {
            console.log("hello from fun ")

            var x = document.getElementById("mySelect").value;
            console.log(x)
            if (x == 1) {
                var person = prompt("ادخل القيمه المدفوعه", "");
                if (person != null) {
                    document.getElementById("demo").value = person;
                    console.log(document.getElementById("demo").value)
                }
            } else {
                return 0
            }
//   document.getElementById("demo").innerHTML = "You selected: " + x;
        }

        // Working On The Bar Code
        //   let allProducts = []
        $('#barcode').on('keyup', function () {
            //  allProducts =  {{$products}};
// console.log('asd' + allProducts) ;

        })

        // $(":input").keypress(function(event){
        // if (event.which == '10' || event.which == '13') {
        //     event.preventDefault();
        // }


        // });
        let allProducts = [];
        allProducts = <?php echo $products; ?>
            // console.log(allProducts)
            console.log(document.getElementById('members_dropdown'))
        console.log('asdasdasdasd')
        options = ``;
        for (let i = 0; i < allProducts.length; i++) {
            options += `
                  <option  value="${allProducts[i].id}">${allProducts[i].name}</option>
            `

        }

        document.getElementById('members_dropdown').innerHTML = options;

        $('#barcode').on('keyup', function (event) {


            console.log((event.target.value))
            if (event.target.value) {

                $('#submiting').click(function (e) {
                    e.preventDefault()
                })


                let filtered = allProducts.filter(product => {
                    return product.code == event.target.value
                });
                console.log(filtered)

                options = ``;
                for (let i = 0; i < filtered.length; i++) {
                    options += `
                  <option selected value="${filtered[i].id}">${filtered[i].name}</option>
            `
                    document.getElementById(`${filtered[i].id}`).style.display = 'block';

                    document.getElementById(`barcode`).value = '';

                    console.log(document.getElementById(`${filtered[i].id}`))

                }
                document.getElementById('members_dropdown').innerHTML = options;


            } else {
                options = ``;
                for (let i = 0; i < allProducts.length; i++) {
                    options += `
                  <option  value="${allProducts[i].id}">${allProducts[i].name}</option>
            `

                }

                document.getElementById('members_dropdown').innerHTML = options;

            }

            // document.getElementById("barcode").value = "";

        })


        $('#submiting').click(function (e) {
            if (e.which == '13') {
                e.preventDefault()
            } else {
                $('#formSubmit').submit()
            }
        })


        function viewBack(e) {
            debugger
            console.log(e)
            if (e == 3) {
                console.log('its exist ');
                $('.backSection').fadeIn();
            } else {
                console.log('not exist ');
                $('.backSection').fadeOut();
            }
        }


    </script>
@endsection
