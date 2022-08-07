@extends('layouts.main')
@section('content')


    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{url('/admin')}}">لوحة التحكم</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{{url('/admin/coupons')}}"> برومو كود </a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>ارسال البروموكود الى المستخدمين</span>
            </li>
        </ul>

    </div>

    @include('partials._errors')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <br>
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-bubble font-green-sharp"></i>
                            <span
                                class="caption-subject font-green-sharp sbold">ارسال اشعار للمستخدمين الاونلاين بالبرومو كود</span>
                        </div>
                    </div>
                    <br>
                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="form_control_1">أختر طريقة
                            الارسال</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control chose" id="form_control_1">
                                <option value="null">أختر</option>
                                <option value="0">جميع العملاء او عملاء محددين</option>
                                <option value="1">فئة معينة من العملاء</option>
                                <option value="2">تحديد عملاء خلال فترة زمنية محددة</option>
                                <option value="3">تحديد عملاء عن طريق سعر اخر طلب</option>
                            </select>
                            <div class="form-control-focus"></div>
                        </div>
                    </div>

                    <div class="row chose_order">
                        <div class="col-md-12">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">حدد السعر</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="col-md-12 col-sm-3 col-xs-12">
                                    <input name="from" id="orderInput" type="number" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <button type="submit" id="order_date" class="btn btn-success">تحديد</button>
                            </div>
                        </div>
                    </div>

                    <div class="row chose_date">
                        <div class="col-md-12">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">اختر الفترة الزمنية</label>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"> من</label>
                                <div class="col-md-9 col-sm-3 col-xs-12">
                                    <div class="input-group date date-picker"
                                         data-date-format="dd-mm-yyyy" data-date-start-date="+0d">
                                        <input name="from" id="fromDateInput" type="date" class="form-control">
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"> الى </label>
                                <div class="col-md-9 col-sm-3 col-xs-12">
                                    <div class="input-group date date-picker"
                                         data-date-format="dd-mm-yyyy" data-date-start-date="+0d">
                                        <input name="to" id="toDateInput" type="date" class="form-control">
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <button type="submit" id="limit_date" class="btn btn-success">تحديد</button>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-12 col-sm-12 col-xs-12 chose_category">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="form_control_1">اختر الفئة</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control chose_category" id="form_control_1">
                                <option value="0">أختر الفئة</option>
                                @foreach($activity_type as $type)
                                    <option value="{{$type->id}}">{{$type->title}}</option>
                                @endforeach
                            </select>
                            <div class="form-control-focus"></div>
                        </div>
                    </div>

                    <br>
                    <div class="chose_form form-group col-md-12 col-sm-12 col-xs-12"
                         style=" border: 5px #27a4b0 solid; padding: 10px;">
                        <form method="POST" action="{{ Route('coupons.notification') }}" enctype="multipart/form-data"
                              data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">

                            {{ csrf_field() }}

                            <input type="hidden" name="coupon_id" value="{{$coupon->id}}">

                            <div class="form-group form-md-line-input has-success">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">شكل الاشعار<span
                                        class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea type="text" id="name" name="message" required
                                          class="form-control col-md-6 col-xs-12">
                                    لأنك عميل مميز وبمناسبة {{$coupon->title}} ..
                                    خصم {{$coupon->percentage}} % على الطلب القادم
                                    صالح حتى تاريخ {{$coupon->end_date}}
                                    كود الخصم    {{$coupon->code}}
                                </textarea>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="category_id">المستخدمين<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control select2-multiple selectTests " id="members_dropdown"
                                            multiple=""
                                            required id="exampleFormControlSelect1"
                                            class="form-control col-md-6 col-xs-12"
                                            name="users[]">
                                        {{--                                        @foreach ( $users as $user)--}}
                                        {{--                                            <option value="{{$user->id}}">{{$user->name}}</option>--}}
                                        {{--                                        @endforeach--}}
                                    </select>
                                </div>
                                <div id="dtBox"></div>
                                <div class="ui toggle checkbox col-md-3 col-sm-3 col-xs-12">
                                    <input type="checkbox" id="selectall">
                                    <label>تحديد الكل</label>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button class="btn btn-primary" type="button"><a href="{{url('/')}}/admin/coupons"
                                                                                     style="color:white">إلغاء</a>
                                    </button>
                                    <button class="btn btn-primary" type="reset">إعاده</button>
                                    <button type="submit" class="btn btn-success">ارسال</button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>

        document.querySelector('.chose').onchange = function (e) {
            if (e.target.value == 0) {
                getOptions(0, true, 0, 0,false)
                document.querySelector('.chose_form').style.display = "block";
                document.querySelector('.chose_category').style.display = "none";
                document.querySelector('.chose_date').style.display = "none";
                document.querySelector('.chose_order').style.display = "none";

            } else if (e.target.value == 1) {
                document.querySelector('.chose_order').style.display = "none";
                document.querySelector('.chose_date').style.display = "none";
                document.querySelector('.chose_category').style.display = "block";

            } else if (e.target.value == 2) {
                document.querySelector('.chose_order').style.display = "none";
                document.querySelector('.chose_category').style.display = "none";
                document.querySelector('.chose_form').style.display = "block";
                document.querySelector('.chose_date').style.display = "block";
            } else if (e.target.value == 3) {
                document.querySelector('.chose_order').style.display = "block";
                document.querySelector('.chose_category').style.display = "none";
                document.querySelector('.chose_form').style.display = "block";
                document.querySelector('.chose_date').style.display = "none";
            } else {
                document.querySelector('.chose_order').style.display = "none";
                document.querySelector('.chose_category').style.display = "none";
                document.querySelector('.chose_form').style.display = "none";
                document.querySelector('.chose_date').style.display = "none";
            }
        }

        document.querySelector('.chose_category').onchange = function (e) {

            debugger
            if (e.target.value == 0) {
                document.querySelector('.chose_form').style.display = "none";
            } else {
                getOptions(e.target.value, false, 0, 0,false);
                // $('#dynamicSelect').fadeIn() ;
                document.querySelector('.chose_form').style.display = "block";
            }
        }

        //get users

        let allOptions = [];
        let baseUrl = location.href;
        let finalUrl = baseUrl.split('/').slice(0, -1).join('/');

        async function getOptions(number, isUser, fromDate, toDate,num) {
            debugger

            if (number > 0 && isUser == false && fromDate == 0 && toDate == 0 && num == false) {
                let response = await fetch(`${finalUrl}/getUserByActivety/${number}`);
                let finalResponse = await response.json()
                allOptions = finalResponse;
                displayOptions();
            } else if (number == 0 && isUser == true && fromDate == 0 && toDate == 0 && num == false) {
                let response = await fetch(`${finalUrl}/getAllUserBromoCode`);
                let finalResponse = await response.json()
                allOptions = finalResponse;
                displayOptions();
            } else if (number == 0 && isUser == true && (fromDate != 0 && fromDate != 1 && toDate != 0 && fromDate != 1 && num == false)) {
                let response = await fetch(`${finalUrl}/getAllUserDate?from=${fromDate}&to=${toDate}`);
                let finalResponse = await response.json()
                allOptions = finalResponse;
                displayOptions();
            } else if (number == 0 && isUser == true && fromDate == 0 && toDate == 0 && num > 0) {
                let response = await fetch(`${finalUrl}/getUserByOrder?num=${num}`);
                let finalResponse = await response.json()
                allOptions = finalResponse;
                console.log(allOptions);
                displayOptions();
            }

        }

        function displayOptions() {
            debugger
            let cartoona = ``;

            if (allOptions.length > 0) {
                allOptions.forEach((option) => {
                    cartoona += `<option value = "${option.id}" >
                        ${option.name}
                    </option>
`
                    document.querySelector('.selectTests').innerHTML = cartoona;
                })
            } else {
                document.querySelector('.selectTests').innerHTML = ''
            }

        }

        document.getElementById('limit_date').addEventListener('click', () => {
            let fromDate = document.getElementById('fromDateInput').value;
            let toDate = document.getElementById('toDateInput').value;

            getOptions(0, true, fromDate, toDate,false)

        })

        document.getElementById('order_date').addEventListener('click', () => {
            let orderPrice = document.getElementById('orderInput').value;

            getOptions(0, true, 0, 0,orderPrice)

        })

    </script>

@endsection
