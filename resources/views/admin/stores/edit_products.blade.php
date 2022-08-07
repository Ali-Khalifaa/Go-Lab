@extends('layouts.main')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
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


                <!--<div style= "width : 50% ; margin : 30px auto " class="w-50 m-auto search-input">-->
                <!--    <input  dir="rtl" placeholder ="بحث" id="searchInput" class="form-control" type="text">-->
                <!--</div>-->


                <!--<div class="panel-body">-->
                <!--<div class="form-group">-->
                <!--    <lable>البحث </lable>-->
                <!--<input type="text" class="form-controller" id="search" name="search"></input>-->
                <!--</div>-->
                <!--</div>-->
                <script>
                    // var res = "success";
                    //     let searchInput =  document.getElementById('searchInput') ;
                    //     let allproducts = <?= $products ?> ;
                    //     let  mainProducts  =  JSON.parse(JSON.stringify(allproducts)) ;
                    //     console.log(mainProducts)

                    //     searchInput.onkeyup = function(){
                    //         console.log('run')
                    //         let searchTerm = this.value.trim().toUpperCase() ;
                    //         let filtreredArr =  mainProducts.filter((ele) => ele.name.toUpperCase().includes(searchTerm)) ;
                    //         allproducts = filtreredArr ;
                    //         console.log(typeof allproducts)
                    //     }
                </script>
                <!--$products = <script>allproducts</script> -->

                <div class="x_content">
                    <br>
                    <form method="POST" action="{{ url('admin/stores/product_info/'.$store->id) }}"
                          enctype="multipart/form-data" categories-parsley-validate=""
                          class="form-horizontal form-label-left">

                        {{ csrf_field() }}





                        <?php
                        //     function test($searchTerm)
                        //     {
                        //         array_filter($products,
                        //         function ($product) {
                        //     	return $product->name  == $searchTerm;
                        //     }
                        //         ) ;
                        //     }

                        ?>


                        <div class="clearfix"></div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_id">المنتجات
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="ui fluid search dropdown form-control select2-multiple"
                                        id="members_dropdown" multiple="" required
                                        id="exampleFormControlSelect1" class="form-control col-md-6 col-xs-12">
                                    @foreach ($products as $product)
                                        <option value="{{$product->id}}">{{$product->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="dtBox"></div>

                            <div class="ui toggle checkbox col-md-3 col-sm-3 col-xs-12">
                                <input type="checkbox" id="selectall">
                                <label>تحديد الكل</label>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        @foreach($products as $index => $product)
                            <div class="{{$product->id}} box-custom form-group">
                                <?php
                                $info = $product->infos()->wherePivot('store_id', '=', $store->id)->get()->first();
                                ?>
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">اسم المنتج
                                    : {{$product->name}}</label>
                                <input type="hidden" name="info[{{$product->id}}][product]" value="{{$product->id}}">
                                <input type="hidden" name="info[{{$product->id}}][id]" value="{{$info->id}}">
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <div class="form-row row">
                                        <div class=" col-md-3">
                                            <label for="inputEmail4">الحد الأدني</label>
                                            <input type="number" min="0" name="info[{{$product->id}}][lower_limit]"
                                                   value="{{$info->lower_limit}}" class="form-control" id="inputEmail4"
                                                   required>
                                        </div>
                                        <div class=" col-md-3">
                                            <label for="inputEmail4">حد اعادة الطلب</label>
                                            <input type="number" min="0" name="info[{{$product->id}}][reorder_limit]"
                                                   value="{{$info->reorder_limit}}" class="form-control"
                                                   id="inputEmail4" required>
                                        </div>
                                        <div class=" col-md-3">
                                            <label for="inputEmail4">الحد الاقصى</label>
                                            <input type="number" min="0" name="info[{{$product->id}}][max_limit]"
                                                   value="{{$info->max_limit}}" class="form-control" id="inputEmail4"
                                                   required>
                                        </div>
                                        <div class=" col-md-3">
                                            <label for="buyPrice">سعر الشراء</label>
                                            <input type="text" min="0" name="info[{{$product->id}}][buy_price]"
                                                   value="{{$info->buy_price}}" class="form-control buyPrice"
                                                   id="buyPrice" required>
                                            @if($info->quantity_unit!=0)

                                                <input type="hidden" min="0" name=""
                                                       value="{{$product->quantity_unit}}"
                                                       class="form-control quantityInShrink"
                                                       id="quantityInShrink">
                                            @endif
                                        </div>
                                        <!--<div class="form-group col-md-2">-->
                                        <!--    <label for="sellPrice">سعر البيع قطاعي</label>-->
                                        <!--    <input type="text" min="0" class="form-control sellPrice" id="sellPrice"-->
                                    <!--           value="{{$info->sell_unit_original}}">-->
                                        <!--</div>-->
                                        <!--<div class="form-group col-md-2">-->
                                        <!--    <label for="inputPassword4">سعر البيع جمله</label>-->
                                        <!--    <input type="text" min="0" class="form-control sellPriceTotal" id="inputPassword4"-->
                                    <!--           value="{{$info->sell_total}}">-->
                                        <!--</div>-->
                                        <!--<div class="form-group col-md-2">-->
                                        <!--    <label for="inputPassword4"> % نسبة المكسب قطاعي</label>-->
                                    <!--    <input type="number" min="0" name="info[{{$product->id}}][sp_unit_percentage]"-->
                                    <!--           readonly value="{{number_format($info->sp_unit_percentage,'2','.','')}}"-->
                                        <!--           class="form-control sellPercentage" id="sellPercentage" required>-->
                                        <!--</div>-->
                                        <!--<div class="form-group col-md-2">-->
                                        <!--    <label for="inputPassword4">% نسبة المكسب جملة</label>-->
                                    <!--    <input type="number" min="0" name="info[{{$product->id}}][sp_total_percentage]"-->
                                    <!--           readonly value="{{number_format($info->sp_total_percentage,'2','.','')}}"-->

                                        <!--           class="form-control sellPercentageTotal" id="inputPassword4" required>-->
                                        <!--</div>-->


                                        <!--<div class="form-group col-md-3">-->
                                        <!--    <label for="inputPassword4">  قيمة المكسب قطاعى بالجنيه   </label>-->
                                    <!--    <input type="number" min="0" style="background-color: gold;" name="info[{{$product->id}}][sp_unit_LE]"-->
                                    <!--           readonly value="{{$info->sp_unit_LE}}"-->
                                        <!--           class="form-control sp_unit_LE" id="sp_unit_LE" required>-->
                                        <!--</div>-->
                                        <!--<div class="form-group col-md-3">-->
                                        <!--    <label for="inputPassword4"> قيمة المكسب جمله بالجنيه</label>-->
                                    <!--    <input type="number" min="0" style="background-color: gold;" name="info[{{$product->id}}][sp_total_LE]"-->
                                    <!--           readonly value="{{$info->sp_total_LE}}"-->

                                        <!--           class="form-control sp_total_LE" id="inputPassword4" required>-->
                                        <!--</div>-->


                                        <!--<div class="form-group col-md-1">-->
                                        <!--    <label for="loss">خساره</label>-->
                                    <!--    <input type="number" min="0" name="info[{{$product->id}}][loss]"-->
                                    <!--           value="{{$info->loss}}" class="form-control buyPrice" id="buyPrice"-->
                                        <!--           required>-->
                                        <!--</div>-->
                                    </div>
                                </div>
                                <div class="clearfix"></div>
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

<!---->




<!---->

