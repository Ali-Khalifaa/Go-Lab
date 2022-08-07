@extends('layouts.main')
@section('content')


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

                <div class="x_content">
                    <br>
                    <form method="POST" action="{{ Route('examinations.create_step_two') }}"
                          enctype="multipart/form-data"
                          data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">

                        {{ csrf_field() }}
                        <label>المعلومات الاساسيه</label>
                        <input type="hidden" name="store_id" value="{{$store->id}}">

                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="inputPassword4">المورد</label>
                                <select required class="form-select form-control" name="supplier_id"
                                        aria-label="Default select example">
                                    @foreach($suppliers as $supplier)
                                        <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!--<div class="form-row">-->
                        <!--    <div class="form-group col-md-2">-->
                        <!--        <label for="inputEmail4">مبلغ متبقى لنا من الفاتورة</label>-->
                        <!--        <input type="number" name="rest_price" value="" min="0" class="form-control"-->
                        <!--               id="inputEmail4" required>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <div class="clearfix"></div>

                        <div class="form-group col-md-4 float-right" style="display: contents;">
                            <label for="exampleFormControlSelect1"> اختر الفئه الرئيسيه </label>
                            <select class="form-control select_1" id="select_1" name="main_cat_id" required>

                                @foreach ($pro_main_catego as $pro_main_cate)

                                    <option value="{{$pro_main_cate->id}}">{{$pro_main_cate->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        {{--                        <div class="form-group col-md-4 float-right" style="display: contents;">--}}
                        {{--                            <label for="exampleFormControlSelect1"> اختر الفئه الفرعيه </label>--}}
                        {{--                            <select class="form-control" id="select_2" name="sub_cat_id" required>--}}
                        {{--                                <option>اختر الفئه الفرعيه</option>--}}
                        {{--                                @foreach ($pro_sub_catego as $pro_sub_cat)--}}

                        {{--                                    <option value="{{$pro_sub_cat->id}}">{{$pro_sub_cat->name}}</option>--}}
                        {{--                                @endforeach--}}
                        {{--                            </select>--}}
                        {{--                        </div>--}}

                        <div class="clearfix"></div>

                        <!--<div class="form-group">-->
                        <!--    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_id">المنتجات-->
                        <!--    </label>-->
                        <!--    <div class="col-md-6 col-sm-6 col-xs-12">-->
                        <!--       <select class="ui fluid search dropdown" id="members_dropdown" multiple="" required id="exampleFormControlSelect1" class="form-control col-md-6 col-xs-12 " name="products[]">-->

                        <!--    </select>-->

                        <!--    </div>-->
                        <!--    <div id="dtBox"></div>-->
                        <!--    <div class="ui toggle checkbox">-->
                        <!--        <input type="checkbox" id="selectall">-->
                        <!--        <label>تحديد الكل</label>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <div class="clearfix"></div>
                        <div class="testing2">
                            <!--statrt testing-->
                        <!--@foreach($products as $index => $product)-->
                        <!--    <div class="{{$product->id}} box-custom" >-->
                        <!--        <label> <span style="color: red;"> اسم المنتج </span> : {{$product->name}}-->
                            <!--            <br>-->
                        <!--            <span style="color: red;"> اسم الشركه </span>  :{{$product->company->name}}  </label>-->
                        <!--        <input type="hidden" name="products[{{$product->id}}][product]"-->
                        <!--               value="{{$product->id}}">-->
                            <!--        <div class="form-row">-->
                            <!--            <div class="form-group col-md-1">-->
                            <!--                <label for="inputEmail4">استلام</label>-->
                        <!--                <input type="number" name="products[{{$product->id}}][receive]" value="" min="0"-->
                            <!--                       class="form-control" id="inputEmail4" required>-->
                            <!--            </div>-->
                            <!--            <div class="form-group col-md-2">-->
                            <!--                <label for="inputEmail4">باجمالي سعر شراء</label>-->
                        <!--                <input type="number" name="products[{{$product->id}}][total_price]" value=""-->
                            <!--                       min="0" class="form-control" id="inputEmail4" required>-->
                            <!--            </div>-->
                            <!--            <div class="form-group col-md-2">-->
                            <!--                <label for="inputPassword4">حالة البضاعة </label>-->
                            <!--                <select class="form-select form-control"-->
                        <!--                        name="products[{{$product->id}}][receipt_status]"-->
                            <!--                        aria-label="Default select example" style="width: auto;" >-->
                        <!--                    @foreach($receipt_statuses as $receipt_status)-->
                            <!--                        <option-->
                        <!--                            value="{{$receipt_status->id}}">{{$receipt_status->status}}</option>-->
                            <!--                    @endforeach-->
                            <!--                </select>-->
                            <!--            </div>-->
                            <!--            <div class="form-group col-md-2">-->
                            <!--                <label for="inputEmail4">بتاريخ انتاج</label>-->
                        <!--                <input type="date" name="products[{{$product->id}}][production_date]"-->
                            <!--                       class="form-control" id="inputEmail4" required>-->
                            <!--            </div>-->
                            <!--            <div class="form-group col-md-2">-->
                            <!--                <label for="inputEmail4">بتاريخ صلاحيه</label>-->
                        <!--                <input type="date" name="products[{{$product->id}}][expiry_date]"-->
                            <!--                       class="form-control" id="inputEmail4" required>-->
                            <!--            </div>-->
                            <!--            <div class="form-group col-md-1">-->
                            <!--                <label for="inputPassword4">ارجاع</label>-->
                        <!--                <input type="number" name="products[{{$product->id}}][recall]" value="" min="0"-->
                            <!--                       class="form-control" id="inputPassword4" required>-->
                            <!--            </div>-->
                            <!--            <div class="form-group col-md-2">-->
                            <!--                <label for="inputPassword4">سبب الاسترجاع </label>-->
                            <!--                <select class="form-select form-control"-->
                        <!--                        name="products[{{$product->id}}][return_reason]"-->
                            <!--                        aria-label="Default select example" style="width: 85px;" >-->
                        <!--                    @foreach($return_reasons as $return_reason)-->
                            <!--                        <option-->
                        <!--                            value="{{$return_reason->id}}">{{$return_reason->status}}</option>-->
                            <!--                    @endforeach-->
                            <!--                </select>-->
                            <!--            </div>-->
                            <!--            <hr style="height: 1px;color: #123455;background-color: #123455;border: none;background: black;margin: 5px;" >-->
                            <!--        </div>-->

                            <!--    </div>-->

                            <!--@endforeach-->
                        </div>
                        <!--end testing-->
                        <div class="clearfix"></div>


                </div>

                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button class="btn btn-primary" type="button"><a href="{{url('/')}}/admin/examinations"
                                                                         style="color:white">إلغاء</a></button>
                        <button class="btn btn-primary" type="reset">إعاده</button>
                        <button type="submit" class="btn btn-success">الذهاب لتحديد المنتجات</button>
                    </div>
                </div>

                </form>
            </div>
        </div>
    </div>
    </div>

@endsection


<!-- new one-->




@section('javascript1')
    <script type='text/javascript'>


        // new for prod-pricing
        // choose school
        $('#select_1').on("change", function () {

            debugger;
            console.log('this is test');
            let selctedValue = $(this).val();
            //  getValue2(selctedValue) ;
            let selectedlist2 = $("#select_2");


            debugger;
            $.ajax({
                type: "GET",
                url: `http://global-dental.matrix-bidding.com/getsub/${selctedValue}`,
                data: {value: selctedValue},

                success: function (data) {
                    // debugger;

                    $("#select_2").find('option').remove();

                    $("#select_2").append('<option value="0" selected="selected">أختر الفئه الفرعيه</option>');

                    //2-fill select-2 from select-1
                    $.each(data, function () {
                        optValue = this.id;
                        optName = this.name;
                        // debugger;
                        $("#select_2").append(new Option(optName, optValue));
                    });


                },
                erorr: function (e) {
                    console.log('asdas');
                    console.log(e);
                }
            });

        });

        let allProducts = [];


        async function getValue2(selectId) {
            debugger;
            let url = window.location.pathname;
            // let urlId = /[^/]*$/.exec(`${url}`)[0] ;

            debugger;
            let respose = await fetch(`http://global-dental.matrix-bidding.com/prod-info/${selectId}/37`);
            let finalResponse = await respose.json();

            allProducts = finalResponse;
            displayItem();
            console.log(allProducts);
        }


        function displayItem() {
            debugger;
            let cartoona = ``;
            if (allProducts.length > 0) {
                debugger;
                allProducts.forEach((product) => {
                    console.log(product);

                    cartoona +=

                        `
                                    <option value="${product.id}">${product.name}</option>
            `


                })

                document.querySelector('#members_dropdown').innerHTML = cartoona;


            }

            $('.sellPrice').on('keyup', function () {
                debugger;
                console.log('its run ');
                $sell_price = $(this).val();
                $buy_price = $(this).parents('.form-row').find('.buyPrice').val();
                $percentage = (($sell_price - $buy_price) / $buy_price) * 100;
                $(this).parents('.form-row').find('.sellPercentage').val($percentage);
            });
            $('.sellPriceTotal').on('keyup', function () {
                $sell_price = $(this).val();
                $buy_price = $(this).parents('.form-row').find('.buyPrice').val();
                $percentage = (($sell_price - $buy_price) / $buy_price) * 100;
                $(this).parents('.form-row').find('.sellPercentageTotal').val($percentage);
            });


            $('.sellPrice').on('keyup', function () {
                $sell_price = $(this).val();
                $buy_price = $(this).parents('.form-row').find('.buyPrice').val();
                $percentage = ($sell_price - $buy_price);
                $(this).parents('.form-row').find('.sp_unit_LE').val($percentage);
            });
            $('.sellPriceTotal').on('keyup', function () {
                $sell_price = $(this).val();
                $buy_price = $(this).parents('.form-row').find('.buyPrice').val();
                $percentage = ($sell_price - $buy_price);
                $(this).parents('.form-row').find('.sp_total_LE').val($percentage);
            });


            $('.price_total').on('keyup', function () {
                $price = $(this).val();
                $quantity = $(this).parents('.form-row').find('.quantity').val();
                $total = $price * $quantity;
                $(this).parents('.form-row').find('.total').val($total);
            });
            $('.quantity').on('keyup', function () {
                $quantity = $(this).val();
                $price = $(this).parents('.form-row').find('.price_total').val();
                $total = $price * $quantity;
                $(this).parents('.form-row').find('.total').val($total);
            });


        }

        //choose grade
        $("#select_2").on("change", function () {
            let selctedValue1 = $(this).val();
            debugger;
            getValue2(selctedValue1);
        });


        $('.box-custom').addClass('d-none')
        $(document).ready(function () {
            $('.ui.dropdown').dropdown();

            $('#table_id').DataTable({
                'language': {
                    "url": "https://cdn.datatables.net/plug-ins/1.10.24/i18n/Arabic.json"
                }
            });
            $('.ui.checkbox')
                .checkbox({
                    onChecked() {
                        const options = $('#members_dropdown > option').toArray().map(
                            (obj) => obj.value
                        );

                        $('#members_dropdown').dropdown('set exactly', options);
                    },
                    onUnchecked() {
                        $('#members_dropdown').dropdown('clear');
                    },
                });

            $('.box-custom').hide();
            $("select").change(function () {
                $("select").find("option:selected").each(function () {
                    var optionValue = $(this).attr("value");
                    console.log('its' + optionValue);
                });

                $("select").find("option:selected").each(function () {
                    $(this).click(() => {
                        console.log('asdfsa');
                    })


                });

                allOptions = $(this).val();
                getProducts();
                console.log(allOptions);

                async function getProducts() {
                    debugger;
                    let result = await fetch('/shop_common/db_query.php', {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(allOptions),
                    });

                    let finalResponse = await result.json();
                }


                function test() {
                    {

                        if (allOptions !== null) {

                            if (allOptions.length > 0) {

                                $(`.box-custom`).hide();
                                for (let i = 0; i < allOptions.length; i++) {
                                    // :not(.${allOptions[i]})
                                    console.log($(`select option`));
                                    $(`.${allOptions[i]}`).show();

                                }
                            } else {
                                $(`.box-custom`).hide();
                            }

                        } else {
                            $(`.box-custom`).hide();
                        }

                    }

                }

                test();

            }).change();


        });
    </script>



@endsection






<!-- end of new one-->




