@extends('layouts.main')
@section('content')


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
                    <form method="POST" action="{{ Route('orders.store') }}" enctype="multipart/form-data"
                          data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">

                        {{ csrf_field() }}


                        <input type="hidden" name="store_id" value="{{ $store->id }}">

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_id">العميل </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="ui fluid search selection dropdown">
                                    <input type="hidden" name="user_id">
                                    <i class="dropdown icon"></i>
                                    <div class="default text">العميل</div>
                                    <div class="menu">
                                        @foreach ($users as $user)

                                            <div class="item" data-value="{{ $user->id }}">{{ $user->name }}</div>

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
                                        id="exampleFormControlSelect1" class="form-control col-md-6 col-xs-12">
                                    @foreach ($products as $product)
                                        <option value="{{$product->id}}">{{$product->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                        <!-- gemy-->
                        <div class="clearfix"></div>
                        @foreach($products as $index => $product)
                            @if($product->infos()->wherePivot('store_id','=',$store->id)->get()->first()!=null)
                                <div class="clearfix"></div>
                                <div class="{{$product->id}} box-custom">
                                    <label> <span style="color: red;"> اسم المنتج </span> : {{$product->name}}
                                        <br>
                                        <span style="color: red;"> اسم الشركه </span> :{{$product->company->name}}
                                    </label>
                                    <input type="hidden" name="products[{{$product->id}}][product]"
                                           value="{{$product->id}}">
                                    <div class="form-row">


                                        <div class="form-group col-md-2">
                                            <label for="inputEmail4"> الخصم الاضافى قطاعى </label>
                                            <input type="number"
                                                   name="products[{{$product->id}}][additional_discount_unit]" value="0"
                                                   min="0"
                                                   step="0.01" class="form-control  " id="">
                                        </div>


                                        <div class="form-group col-md-2">
                                            <label for="inputEmail4"> الكميه قطاعى</label>
                                            <input type="number" name="products[{{$product->id}}][quantity_unit]"
                                                   value="0" min="0"
                                                   class="form-control unitQuantity unitQuantityGemyi" id="inputEmail4"
                                                   required>
                                        </div>


                                        <div class="form-group col-md-2">
                                            <label for="inputEmail4"> الخصم الاضافى جمله </label>
                                            <input type="number"
                                                   name="products[{{$product->id}}][additional_discount_total]"
                                                   value="0"
                                                   min="0" step="0.01" class="form-control" id="">
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label for="inputEmail4"> الكميه جمله </label>
                                            <input type="number" name="products[{{$product->id}}][quantity]" value="0"
                                                   min="0" class="form-control gomlaQuantity gomlaQuantityGemyi"
                                                   id="inputEmail4" required>
                                        </div>


                                        <?php
                                        $product_info = $product->infos()->wherePivot('store_id', '=', $store->id)->get()->first();
                                        $price_total = $product_info->sell_total;
                                        $price_total_sum = $product->quantity_total * ($product_info->sell_total);
                                        $price_unit = $product_info->sell_unit_original / $product->quantity_unit;
                                        $price_unit_sum = $product->quantity_unit * ($product->sell_unit_original / $product->quantity_unit);
                                        $total_price_for_item = $price_total_sum + $price_unit_sum;
                                        ?>

                                        <div class="form-group col-md-2">
                                            <label for="inputPassword4"> الخصم جمله</label>
                                            <input type="number" readonly class="form-control  "
                                                   value="{{$product->discount_total}}" id="gomlaPrice">
                                        <!--<input type="hidden"  @if($product->discount_total==0) value="{{$product->price_total}}"  @else value="{{$product->price_total - $product->discount_total }}"  @endif class="form-control baseGomlaPrice " id="baseGomlaPrice" >-->
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label for="inputPassword4"> السعر جمله</label>
                                            <input type="number" readonly name="products[{{$product->id}}][price]"
                                                   class="form-control gomlaPrice gomlaYousri" id="gomlaPrice">
                                            <input type="hidden"
                                                   @if($product->discount_total==0) value="{{$product->price_total}}"
                                                   @else value="{{$product->price_total - $product->discount_total }}"
                                                   @endif class="form-control baseGomlaPrice " id="baseGomlaPrice">
                                        </div>


                                        <div class="form-group col-md-2">
                                            <label for="inputPassword4">الخصم قطاعى</label>
                                            <input type="number" readonly class="form-control  "
                                                   value="{{$product->discount_unit}}" id="unitPrice">
                                        <!--<input type="hidden" @if($product->discount_unit==0) value="{{$product->price_unit}}"  @else value="{{$product->price_unit - $product->discount_unit }}"  @endif class="form-control baseUnitPrice" id="baseUnitPrice" >-->
                                        </div>


                                        <div class="form-group col-md-2">
                                            <label for="inputPassword4">السعر قطاعى</label>
                                            <input type="number" readonly name="products[{{$product->id}}][price_unit]"
                                                   class="form-control unitPrice unitYousri" id="unitPrice">
                                            <input type="hidden"
                                                   @if($product->discount_unit==0) value="{{$product->price_unit}}"
                                                   @else value="{{$product->price_unit - $product->discount_unit }}"
                                                   @endif class="form-control baseUnitPrice" id="baseUnitPrice">
                                        </div>


                                        <hr style="height: 1px;color: #123455;background-color: #123455;border: none;background: black;margin: 5px;">
                                    </div>

                                </div>

                            @endif

                        <!--<div class="clearfix"></div>-->

                        @endforeach
                        <div class="clearfix"></div>
                        <!-- gemy-->


                        <div class="form-group col-md-2">
                            <label for="inputPassword4"> الاجمالى جمله</label>
                            <input type="text" readonly value="0" class="form-control unitPrice" id="totalGomlaPrice">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputPassword4"> الاجمالى قطاعى</label>
                            <input type="text" readonly value="0" class="form-control unitPrice" id="totalUnitPrice">
                        </div>


                        <div class="ln_solid"></div>

                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button class="btn btn-primary" type="button"><a href="{{url('/admin/direct_sells')}}"
                                                                                 style="color:white">إلغاء</a></button>
                                <button class="btn btn-primary" type="reset">إعاده</button>
                                <button type="submit" class="btn btn-success">اضافه</button>
                                <button type="button" class="btn btn-danger" id="showTotal" class="btn btn-success">عرض
                                    الاجمالي
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>




@endsection
@section('javascript1')


    <script type="text/javascript">
        // $(document).ready(function () {
        $('.sellPrice').on('keyup', function () {
            $sell_price = $(this).val();
            $buy_price = $(this).parents('.form-row').find('.buyPrice').val();
            $quantity_in_shrink = $(this).parents('.form-row').find('.quantityInShrink').val();
            if ($quantity_in_shrink != null) {
                $percentage = (($sell_price - ($buy_price / $quantity_in_shrink)) / ($buy_price / $quantity_in_shrink)) * 100;
                // $percentage=$percentage.toFixed(2);
                $(this).parents('.form-row').find('.sellPercentage').val($percentage);
            }
        });
        $('.sellPriceTotal').on('keyup', function () {
            $sell_price = $(this).val();
            $buy_price = $(this).parents('.form-row').find('.buyPrice').val();
            $percentage = (($sell_price - $buy_price) / $buy_price) * 100;
            // $percentage=$percentage.toFixed(2);
            $(this).parents('.form-row').find('.sellPercentageTotal').val($percentage);
        });


        $('.sellPrice').on('keyup', function () {
            $sell_price = $(this).val();
            $buy_price = $(this).parents('.form-row').find('.buyPrice').val();
            $quantity_in_shrink = $(this).parents('.form-row').find('.quantityInShrink').val();
            if ($quantity_in_shrink != null) {
                $percentage = ($sell_price - ($buy_price / $quantity_in_shrink));
                // $percentage=$percentage.toFixed(2);
                $(this).parents('.form-row').find('.sp_unit_LE').val($percentage);
            }
        });
        $('.sellPriceTotal').on('keyup', function () {
            $sell_price = $(this).val();
            $buy_price = $(this).parents('.form-row').find('.buyPrice').val();
            $percentage = ($sell_price - $buy_price);
            // $percentage=$percentage.toFixed(2);
            $(this).parents('.form-row').find('.sp_total_LE').val($percentage);
        });

        console.log("hello from main ");
        $('.gomlaQuantity').on('keyup', function () {
            $gomlaQuantity = $(this).val();

            $baseGomlaPrice = $(this).parents('.form-row').find('.baseGomlaPrice').val();
            if ($gomlaQuantity == 0) {
                $percentage = 0;
            } else {
                $percentage = ($baseGomlaPrice * $gomlaQuantity);
            }
            console.log("hello from main ");
            $(this).parents('.form-row').find('.gomlaPrice').val($percentage);
        });


        $('.unitQuantity').on('keyup', function () {
            $gomlaQuantity = $(this).val();

            $baseGomlaPrice = $(this).parents('.form-row').find('.baseUnitPrice').val();
            if ($gomlaQuantity == 0) {
                $percentage = 0;
            } else {
                $percentage = ($baseGomlaPrice * $gomlaQuantity);
            }
            $(this).parents('.form-row').find('.unitPrice').val($percentage);
        });


        // });


        //     $(document).ready(function () {

        //     $('.unitQuantity').on('keyup', function () {
        //         $sell_price = $(this).val();
        //         $baseUnitPrice = $(this).parents('.form-row').find('.baseUnitPrice').val();
        //         $percentage = (($sell_price - $buy_price) / $buy_price) * 100;
        //         // $percentage=$percentage.toFixed(2);
        //         $(this).parents('.form-row').find('.unitPrice').val($percentage);
        //     });


        // });

    </script>

    <script>
        console.log('asdad')
        let allProducts = [];
        allProducts = <?php echo $products ?>
            let
        totalGomla = 0;

        function getAllGomlaAndCalculate() {
            totalGomla = 0;
            console.log($('.gomlaQuantityGemyi:visible'))

            $('.gomlaYousri:visible').each(function () {
                totalGomla = Number($(this).val()) + totalGomla;
            })


            return totalGomla;
        }


        let totalAta3y = 0;

        function getAllAta3yAndCalculate() {
            totalAta3y = 0;
            console.log($('.unitYousri:visible'))


            $('.unitYousri:visible').each(function () {
                totalAta3y = Number($(this).val()) + totalAta3y;
            })


            return totalAta3y;
        }


        $('#showTotal').on('click', function () {
            getAllGomlaAndCalculate();
            getAllAta3yAndCalculate()
            document.getElementById('totalGomlaPrice').setAttribute('value', getAllGomlaAndCalculate())
            $('#totalGomlaPrice').css('display', 'block');
            document.getElementById('totalUnitPrice').setAttribute('value', getAllAta3yAndCalculate())
            $('#totalUnitPrice').css('display', 'block');
        })


    </script>
@endsection
