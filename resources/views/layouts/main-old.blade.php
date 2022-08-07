<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'AppDashboard') }}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/favicon.ico" type="image/ico"/>
    <!-- Table -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
    <!-- Bootstrap -->
    <link href="{{asset('vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://www.fontstatic.com/f=hanimation"/>

    <!-- NProgress -->
    <link href="{{asset('vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{asset('vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="{{asset('vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{asset('vendors/jqvmap/dist/jqvmap.min.css')}}" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="{{asset('vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">
    <!-- semantic ui  -->
    <link href="{{asset('vendors/semantic/semantic.min.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{asset('build/css/custom.css')}}" rel="stylesheet">
    <!--  font     -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: 'Tajawal', sans-serif;
        }
    </style>
</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title">
                    <a href="{{url('/')}}" class="site_title"><i class='fa fa-camera'></i><span>اداره الموقع</span></a>
                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <div class="clearfix"></div>

                <!-- menu profile quick info -->
                <div class="profile clearfix">
                    <div class="profile_pic">
                        <img src="{{asset('images/user1.png')}}" alt="..." class="img-circle profile_img">
                    </div>
                    <div class="profile_info">
                        <span>,مرحبا</span>
                        <h2>{{ ucfirst(Auth::user()->name) }}</h2>
                    </div>
                </div>
                <!-- /menu profile quick info -->

                <br/>

                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu noPrint">
                    <div class="menu_section">
                        <h3>عام</h3>
                        <ul class="nav side-menu">
                            <li><a href="{{url('/admin')}}"><i class='fa fa-home'></i> الرئيسيه</a></li>
                            @permission('create-options')
                            <li><a href="{{url('/admin/options')}}"><i class='fa fa-home'></i> اخرى</a></li>
                            @endpermission

                            @permission('read-users')
                            <li><a href="{{url('/admin/users')}}"><i class='fa fa-home'></i> المستخدمين</a></li>
                            <li style=""><a ><span class="fa fa-chevron-down"> </span> المسئولين </a>
                            <ul class="nav child_menu">
                            <li><a href="{{url('/admin/finance_manager')}}"><i class='fa fa-home'></i> مسئولى الماليه </a></li>
                            <li><a href="{{url('/admin/manager')}}"><i class='fa fa-home'></i> مسئولى المشتريات </a></li>
                            <li><a href="{{url('/admin/store-kepers')}}"><i class='fa fa-home'></i> امناء المخزن  </a></li>
                            <li><a href="{{url('/admin/seller')}}"><i class='fa fa-home'></i>  البائعين  </a></li>
                            </ul>
                            </li>
                            @endpermission
                            @permission('read-clients')
                            <li><a href="{{url('/admin/clients')}}"><i class='fa fa-home'></i> العملاء</a></li>
                            @endpermission
                            
                            @permission('read-mandobs')
                            <li><a href="{{url('/admin/mandoobs')}}"><i class='fa fa-home'></i> المندوبين</a></li>
                            @endpermission
                            
                            @permission('create-clients')
                            <li><a href="{{url('/admin/create_client')}}"><i class='fa fa-home'></i> اضافة عميل بيع مباشر
                                </a></li>
                            @endpermission

                            @role('super_administrator')
                            <li><a href="{{url('/admin/create_notification')}}"><i class='fa fa-home'></i> اضافة اشعار للتطبيق
                                </a></li>
                            @endrole

                            @permission('read-suppliers')
                            <li><a href="{{url('/admin/suppliers')}}"><i class='fa fa-home'></i> الموردين</a></li>
                            @endpermission

                            @permission('read-companies')
                            <li><a href="{{url('/admin/companies')}}"><i class='fa fa-home'></i> الشركات</a></li>
                            @endpermission
                            <li style=""><a ><span class="fa fa-chevron-down"> </span> الفئات </a>
                            <ul class="nav child_menu">
                            @permission('read-categories')
                            <li><a href="{{url('/admin/categories')}}"><i class='fa fa-home'></i> الفئات</a></li>
                            @endpermission

                            @permission('read-subcategories')
                            <li><a href="{{url('/admin/subcategories')}}"><i class='fa fa-home'></i> الفئات الفرعيه</a>
                            </li>
                            @endpermission
                            </ul>
                            </li>
                            @permission('read-products')
                            <li><a href="{{url('/admin/products')}}"><i class='fa fa-home'></i> المنتجات</a></li>
                            @endpermission
                            @permission('read-min_prices')
                            <li><a href="{{url('/admin/min-price')}}"><i class='fa fa-home'></i> اقل سعر للطلب</a></li>
                            @endpermission
                            @permission('read-places')
                            <li><a href="{{url('/admin/places')}}"><i class='fa fa-home'></i> المناطق</a></li>
                            <li><a href="{{url('/admin/directions')}}"><i class='fa fa-home'></i> الاتجاهات للمندوبين</a></li>
                            @endpermission

                            @permission('read-receipt_status')
                            <li><a href="{{url('/admin/receipt_statuses')}}"><i class='fa fa-home'></i> حالات
                                    الاستلام</a></li>
                            @endpermission

                            @permission('read-return_reasons')
                            <li><a href="{{url('/admin/return_reasons')}}"><i class='fa fa-home'></i> اسباب
                                    الاسترجاع</a></li>
                            @endpermission

                            @permission('read-stores')
                            <li><a href="{{url('/admin/stores')}}"><i class='fa fa-home'></i> اضافة مخزن جديد </a></li>
                            @endpermission
                            
                            <li style=""><a ><span class="fa fa-chevron-down"> </span> الخزينه </a>
                            <ul class="nav child_menu">
                            
                            @permission('read-statistics')
                            <li><a href="{{url('/admin/lockers/')}}"><i class="fa fa-home"></i>الخزينه</a></li>
                            @endpermission
                            @permission('read-expenses')
                            <li><a href="{{url('/admin/outgoings/')}}"><i class="fa fa-home"></i>المصروفات</a></li>
                            @endpermission

                            @permission('read-revenues')
                            <li><a href="{{url('/admin/ingoings/')}}"><i class="fa fa-home"></i>الايرادات</a></li>
                            @endpermission
                            
                            @permission('read-depts')
                            <!--<li><a href="{{url('/admin/depts')}}"><i class='fa fa-home'></i> المديونيات</a></li>-->
                            @endpermission

                            </ul>
                            </li>
                            	
                            @permission('read-edited_orders')
                            <li><a href="{{url('/admin/edited_orders')}}"><i class='fa fa-home'></i> الطلبات المعدله </a></li>
                            @endpermission
                             @permission('read-reports')   
                            <li style=""><a ><span class="fa fa-chevron-down"> </span> التقارير </a>
                            <ul class="nav child_menu">

                             <li><a href="{{url('/admin/finance_managers-reports')}}"><i class='fa fa-home'></i> تقارير الماليه   </a></li>
                            <li><a href="{{url('/admin/manager-reports')}}"><i class='fa fa-home'></i> تقارير مسئولى الشراء   </a><li>
                             <li><a href="{{url('/admin/seller-reports')}}"><i class='fa fa-home'></i> تقارير البائعين   </a></li>
                             @permission('read-mandobs')
                            <li><a href="{{url('/admin/mandoobs')}}"><i class='fa fa-home'></i> المندوبين</a></li>
                            @endpermission
                            <li><a href="{{url('/admin/keeper-reports')}}"><i class='fa fa-home'></i> تقارير امناء المخازن   </a></li>
                            <li><a href="{{url('/admin/orders-report')}}"><i class='fa fa-home'></i> تقارير جميع الطلبات  </a></li>
                            
                            <li><a href="{{url('/admin/direct_sells')}}"><i class='fa fa-home'></i>   تقارير طلبات البيع المباشر
                            </a></li>
                            
                               
                            @permission('read-statistics')
                            <li><a href="{{url('/admin/totals/in_out_total')}}"><i class="fa fa-home"></i>صافي الارباح</a></li>
                            @endpermission

                            @permission('read-statistics')
                            <li><a href="{{url('/admin/totals/order_product_total')}}"><i class="fa fa-home"></i>احمالي الطلب على المنتجات</a></li>
                            @endpermission

                            @permission('read-statistics')
                            <li><a href="{{url('/admin/totals/income_product_total')}}"><i class="fa fa-home"></i>الدخل الناتج عن بيع المنتجات</a></li>
                            @endpermission

                            @permission('read-statistics')
                            <!--<li><a href="{{url('/admin/totals/paid_users_total')}}"><i class="fa fa-home"></i>القوه الاتمانيه لكل عميل</a></li>-->
                            @endpermission
                            
                            @permission('read-most_products')
                            <li><a href="{{url('/admin/mostproducts')}}"><i class='fa fa-home'></i> المنتجات الاكثر مبيعا</a></li>
                            @endpermission
                            
                            @permission('read-notify_users')
                            <li><a href="{{url('/admin/user_notifies')}}"><i class='fa fa-home'></i> العملاء المميزين
                                </a></li>
                            @endpermission
                            
                            @permission('read-complaints')
                            <li><a href="{{url('/admin/complaints')}}"><i class='fa fa-home'></i> الشكاوي </a></li>
                            @endpermission

                            @permission('read-complaint_products')
                            <li><a href="{{url('/admin/complaintsproducts')}}"><i class='fa fa-home'></i> شكاوي المنتجات
                                </a></li>
                            @endpermission
                            
                            </ul>
                            </li>
                            @endpermission 
                            @permission('read-notifies')
                            <li><a href="{{url('/admin/global_notify')}}"><i class='fa fa-home'></i> المكافأه العام </a>
                            </li>
                            @endpermission

                            @permission('read-offer_points')
                            <li><a href="{{url('/admin/offer_points')}}"><i class='fa fa-home'></i> عروض النقاط </a>
                            </li>
                            @endpermission


                            
                            @if(!empty(Auth::user()->seller_store()->get()->first()))
                                <li>
                                    <a href="{{url('/admin/show/store')}}"><i class='fa fa-home'></i> المخزن الخاص بالبائع</a>
                                </li>
                                @permission('read-orders')
                                <li><a href="{{url('/admin/store/orders')}}"><i class='fa fa-home'></i> طلبات المخزن للبائع
                                    </a></li>
                                @endpermission
                            @endif
                            @if(!empty(Auth::user()->keeper_store))
                                <li>
                                    <a href="{{url('/admin/show/store')}}"><i class='fa fa-home'></i> المخزن الخاص بامين المخزن</a>
                                </li>
                                @permission('read-examinations')
                                <!--<li>-->
                                <!--    <a href="{{url('/admin/store/examination_units', Auth::user()->id)}}"><i class='fa fa-home'></i> استلام البضاعه </a>-->
                                <!--</li>-->
                                
                                @endpermission
                                @permission('read-transfers')
                                <li><a href="{{url('/admin/store/transfers')}}"><i class='fa fa-home'></i> نقل البضائع </a></li>
                                @endpermission
                                @permission('read-examinations')
                                <li><a href="{{url('/admin/examinations')}}"><i class='fa fa-home'></i> فواتير الشراء
                                    </a></li>
                                @endpermission
                                @permission('read-orders')
                                
                                <li><a href="{{url('/admin/store/orders')}}"><i class='fa fa-home'></i> طلبات المخزن
                                    </a></li>
                                    
                                 
                                    
                                @endpermission
                            @endif
                            @if(!empty(Auth::user()->manager_store()->get()->first()))
                                <li>
                                    <a href="{{url('/admin/show/store')}}"><i class='fa fa-home'></i> المخزن الخاص بالمسئول</a>
                                </li>
                                @permission('read-examinations')
                                <li><a href="{{url('/admin/examinations')}}"><i class='fa fa-home'></i> فواتير الشراء
                                    </a></li>
                                @endpermission
                                @permission('read-transfers')
                                <li><a href="{{url('/admin/store/transfers')}}"><i class='fa fa-home'></i> نقل البضائع
                                    </a></li>
                                @endpermission

                                @permission('read-orders')
                                <li><a href="{{url('/admin/store/orders')}}"><i class='fa fa-home'></i> طلبات المخزن
                                    </a></li>
                                @endpermission
                            @endif
                            @permission('read-examinations')
                                <li><a href="{{url('/admin/examinations')}}"><i class='fa fa-home'></i> فواتير الشراء
                                    </a></li>
                                @endpermission
                            @if(!empty(Auth::user()->store_accountant()->get()->first()))
                                <li>
                                    <a href="{{url('/admin/show/store')}}"><i class='fa fa-home'></i> المخزن الخاص بالمحاسب</a>
                                </li>
                                @permission('read-examinations')
                                <li><a href="{{url('/admin/examinations')}}"><i class='fa fa-home'></i> فواتير الشراء
                                    </a></li>
                                @endpermission

                                @permission('read-transfers')
                                <li><a href="{{url('/admin/store/transfers')}}"><i class='fa fa-home'></i> نقل البضائع
                                    </a></li>
                                @endpermission

                                @permission('read-orders')
                                <li><a href="{{url('/admin/store/orders')}}"><i class='fa fa-home'></i> طلبات المخزن
                                    </a>
                                </li>
                                @endpermission
                            @endif


                            @permission('read-orders')
                            <li><a href="{{url('/admin/orders')}}"><i class='fa fa-home'></i> جميع الطلبات</a></li>
                            <li><a href="{{url('/admin/orders-with-recalls')}}"><i class='fa fa-home'></i>  المرتجعات
                                    </a></li>  
                            @endpermission

                            @permission('read-orders')
                            <li><a href="{{url('/admin/direct_sells')}}"><i class='fa fa-home'></i> طلبات البيع المباشر
                                </a></li>
                                
                            @endpermission

                            





                            @permission('read-sliders')
                            <li><a href="{{url('/admin/sliders')}}"><i class='fa fa-home'></i> السلايدر </a></li>
                            <li><a href="{{url('/admin/shoptypes')}}"><i class='fa fa-home'></i> انواع المحلات </a></li>
                            @endpermission

                            @permission('read-contacts')
                            <li><a href="{{url('/admin/contacts')}}"><i class='fa fa-home'></i> معلومات التواصل </a>
                            </li>
                            @endpermission
                            
                            
                            
                            <li><a href="{{url('/passwords/'.Auth::user()->id)}}"><i class='fa fa-home'></i>  تعديل كلمة السر </a>
                            </li>
                            
                            
                            
                            
                        </ul>
                    </div>


                    <div class="menu_section">
                        <ul class="nav side-menu">
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"> <i
                                        class="fa fa-sign-out"></i> {{ __('الخروج') }}
                                </a>

                            </li>
                        </ul>
                    </div>


                </div>
                <!-- /sidebar menu -->

                <!-- /menu footer buttons -->
                <div class="sidebar-footer hidden-small">
                    <a data-toggle="tooltip" data-placement="top" title="Settings">
                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="Lock">
                        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                    </a>
                </div>
                <!-- /menu footer buttons -->
            </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav noPrint">
            <div class="nav_menu noPrint">
                <nav>
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="">
                            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown"
                               aria-expanded="false">
                                <img src="{{asset('images/user1.png')}}" alt="">
                                {{ ucfirst(Auth::user()->name) }}
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu pull-right">

                                <li><a href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                                        الخروج </a>
                                    <form id="frm-logout" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>

                        <li role="presentation" class="dropdown">

                            <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                                <li>
                                    <a>
                                        <span class="image"><img src="{{asset('images/user1.png')}}"
                                                                 alt="Profile Image"/></span>
                                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <span class="image"><img src="{{asset('images/img.jpg')}}" alt="Profile Image"/></span>
                                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <span class="image"><img src="images/img.jpg" alt="Profile Image"/></span>
                                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <span class="image"><img src="images/img.jpg" alt="Profile Image"/></span>
                                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                                    </a>
                                </li>
                                <li>
                                    <div class="text-center">
                                        <a>
                                            <strong>See All Alerts</strong>
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @yield('content')

        </div>
        <!-- /page content -->


        <!-- /footer content -->
    </div>
</div>

<!-- jQuery -->
<script src="{{asset('vendors/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('vendors/datatables.net/js/jquery.dataTables.js')}}"></script>

<!-- Bootstrap -->
<script src="{{asset('vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('vendors/fastclick/lib/fastclick.js')}}"></script>
<!-- NProgress -->
<script src="{{asset('vendors/nprogress/nprogress.js')}}"></script>
<!-- Chart.js -->
<script src="{{asset('vendors/Chart.js/dist/Chart.min.js')}}"></script>
<!-- gauge.js -->
<script src="{{asset('vendors/gauge.js/dist/gauge.min.js')}}"></script>
<!-- bootstrap-progressbar -->
<script src="{{asset('vendors/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"></script>
<!-- iCheck -->
<script src="{{asset('vendors/iCheck/icheck.min.js')}}"></script>
<!-- Skycons -->
<script src="{{asset('vendors/skycons/skycons.js')}}"></script>
<!-- Flot -->
<script src="{{asset('vendors/Flot/jquery.flot.js')}}"></script>
<script src="{{asset('vendors/Flot/jquery.flot.pie.js')}}"></script>
<script src="{{asset('vendors/Flot/jquery.flot.time.js')}}"></script>
<script src="{{asset('vendors/Flot/jquery.flot.stack.js')}}"></script>
<script src="{{asset('vendors/Flot/jquery.flot.resize.js')}}"></script>
<!-- Flot plugins -->
<script src="{{asset('vendors/flot.orderbars/js/jquery.flot.orderBars.js')}}"></script>
<script src="{{asset('vendors/flot-spline/js/jquery.flot.spline.min.js')}}"></script>
<script src="{{asset('vendors/flot.curvedlines/curvedLines.js')}}"></script>
<!-- DateJS -->
<script src="{{asset('vendors/DateJS/build/date.js')}}"></script>
<!-- JQVMap -->
<script src="{{asset('vendors/jqvmap/dist/jquery.vmap.js')}}"></script>
<script src="{{asset('vendors/jqvmap/dist/maps/jquery.vmap.world.js')}}"></script>
<script src="{{asset('vendors/jqvmap/examples/js/jquery.vmap.sampledata.js')}}"></script>
<!-- bootstrap-daterangepicker -->
<script src="{{asset('vendors/moment/min/moment.min.js')}}"></script>
<script src="{{asset('vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<!-- semantic -->
<script src="{{asset('vendors/semantic/semantic.min.js')}}"></script>
<!-- Table -->
{{--    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>--}}

<!-- Custom Theme Scripts -->
<script src="{{asset('build/js/custom.min.js')}}"></script>
<script src="{{asset('build/js/semantic.js')}}"></script>
<script>
    $(document).ready(function () {
        $('.sellPrice').on('keyup', function () {
            $sell_price = $(this).val();
            $buy_price = $(this).parents('.form-row').find('.buyPrice').val();
            $quantity_in_shrink = $(this).parents('.form-row').find('.quantityInShrink').val();
            if($quantity_in_shrink!=null)
            {
            $percentage = (($sell_price - ($buy_price/$quantity_in_shrink)) / ($buy_price/$quantity_in_shrink))* 100 ;
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
                        if($quantity_in_shrink!=null)
            {
            $percentage = ($sell_price - ($buy_price/$quantity_in_shrink))  ;
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
        
        
            $('.gomlaQuantity').on('keyup', function () {
            $gomlaQuantity = $(this).val();
            
            $baseGomlaPrice = $(this).parents('.form-row').find('.baseGomlaPrice').val();
            if($gomlaQuantity==0)
            {
            $percentage = 0 ;
            }
            else{
            $percentage = ($baseGomlaPrice * $gomlaQuantity) ;
            }
            $(this).parents('.form-row').find('.gomlaPrice').val($percentage);
        });
        
        
        $('.unitQuantity').on('keyup', function () {
            $gomlaQuantity = $(this).val();
            
            $baseGomlaPrice = $(this).parents('.form-row').find('.baseUnitPrice').val();
            if($gomlaQuantity==0)
            {
            $percentage = 0 ;
            }
            else{
            $percentage = ($baseGomlaPrice * $gomlaQuantity) ;
            }
            $(this).parents('.form-row').find('.unitPrice').val($percentage);
        });
        
        
        
    });
    
    
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


<script type="text/javascript">
$('#search').on('keyup',function(){
$value=$(this).val();
$.ajax({
type : 'get',
url : '{{URL::to('/admin/searchInEditProd')}}',
data:{'search':$value},
success:function(data){
$('tbody').html(data);
}
});
})
</script>
<script type="text/javascript">
$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>
@yield('javascript1')
</body>
</html>
