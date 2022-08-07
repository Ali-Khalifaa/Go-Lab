<!DOCTYPE html>
<html lang="ar" dir="rtl">
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ url('/') }}/public/images/logo.png" type="image/png"/>
    <title> GOLAB </title>
    <meta content="Preview page of Metronic Admin RTL Theme #1 for statistics, charts, recent events and reports"
          name="description"/>
    <meta content="" name="author"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="https://www.fontstatic.com/f=hanimation"/>
    <link href="{{ asset('/dashboard_files/global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('/dashboard_files/global/plugins/simple-line-icons/simple-line-icons.min.css') }}"
          rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/dashboard_files/global/plugins/bootstrap/css/bootstrap-rtl.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('/dashboard_files/global/plugins/bootstrap-switch/css/bootstrap-switch-rtl.min.css') }}"
          rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="{{ asset('/dashboard_files/global/plugins/bootstrap-select/css/bootstrap-select-rtl.min.css') }}"
          rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/dashboard_files/global/plugins/jquery-multi-select/css/multi-select-rtl.css') }}"
          rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/dashboard_files/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('/dashboard_files/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <!-- END PAGE LEVEL PLUGINS -->

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="{{ asset('/dashboard_files/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link
        href="{{ asset('/dashboard_files/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap-rtl.css') }}"
        rel="stylesheet" type="text/css"/>
    <!-- END PAGE LEVEL PLUGINS -->

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="{{ asset('/dashboard_files/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css') }}"
          rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/dashboard_files/global/plugins/morris/morris.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/dashboard_files/global/plugins/fullcalendar/fullcalendar.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('/dashboard_files/global/plugins/jqvmap/jqvmap/jqvmap.css') }}" rel="stylesheet"
          type="text/css"/>

    <link href="{{ asset('/dashboard_files/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}"
          rel="stylesheet" type="text/css"/>

    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{{ asset('/dashboard_files/global/css/components-rtl.min.css') }}" rel="stylesheet"
          id="style_components" type="text/css"/>
    <link href="{{ asset('/dashboard_files/global/css/plugins-rtl.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="{{ asset('/dashboard_files/layouts/layout/css/layout-rtl.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('/dashboard_files/layouts/layout/css/themes/darkblue-rtl.min.css') }}" rel="stylesheet"
          type="text/css" id="style_color"/>
    <link href="{{ asset('/dashboard_files/layouts/layout/css/custom-rtl.min.css') }}" rel="stylesheet"
          type="text/css"/>

{{-- new start --}}
<!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="{{ asset('/dashboard_files/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5-rtl.css') }}"
          rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/dashboard_files/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css') }}"
          rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/dashboard_files/global/plugins/bootstrap-summernote/summernote.css') }}" rel="stylesheet"
          type="text/css"/>
    <!-- END PAGE LEVEL PLUGINS -->
{{-- new end --}}
<!-- semantic ui  -->
{{--    <link href="{{asset('vendors/semantic/semantic.min.css')}}" rel="stylesheet">--}}
{{--    <!-- Custom Theme Style -->--}}
{{--    <link href="{{asset('build/css/custom.css')}}" rel="stylesheet">--}}
<!--  font     -->

    {{--noty--}}
    <link rel="stylesheet" href="{{ asset('/dashboard_files/noty/noty.css') }}">
    <script src="{{ asset('/dashboard_files/noty/noty.min.js') }}"></script>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: 'Tajawal', sans-serif;
        }
    </style>

</head>
<!-- END HEAD -->

<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
<div class="page-wrapper">
    <!-- BEGIN HEADER -->
    <div class="page-header navbar navbar-fixed-top">
        <!-- BEGIN HEADER INNER -->
        <div class="page-header-inner ">
            <!-- BEGIN LOGO -->
            <div class="page-logo">
                <a href="{{url('/')}}" style="margin-right: 60px ;">
                    <img src="{{url('/')}}/public/images/logo.png" alt="logo"
                         class="logo-default" style="width: 80px; margin-top: 0; height: 50px;"/> </a>
                <div class="menu-toggler sidebar-toggler" style="margin: 22px 0 0 !important;">
                    <span></span>
                </div>
            </div>
            <!-- END LOGO -->
            <!-- BEGIN RESPONSIVE MENU TOGGLER -->
            <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse"
               data-target=".navbar-collapse">
                <span></span>
            </a>
            <!-- END RESPONSIVE MENU TOGGLER -->
            <!-- BEGIN TOP NAVIGATION MENU -->


            <div class="top-menu">


                <ul class="nav navbar-nav pull-right">

                    <li class="dropdown dropdown-user">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                           data-close-others="true">
                            <img alt="" class="img-circle" src="{{url('/')}}/public/images/logo.png"/>
                            <span class="username username-hide-on-mobile"> admin</span>
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-default">
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                                    <i class="icon-key"></i> تسجيل خروج </a>
                                <form id="frm-logout" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                    <!-- END USER LOGIN DROPDOWN -->

                </ul>

            </div>

            <!-- END TOP NAVIGATION MENU -->

        </div>
        <!-- END HEADER INNER -->
    </div>
    <!-- END HEADER -->
    <!-- BEGIN HEADER & CONTENT DIVIDER -->
    <div class="clearfix"></div>
    <!-- END HEADER & CONTENT DIVIDER -->
    <!-- BEGIN CONTAINER -->
    <div class="page-container">
        <!-- BEGIN SIDEBAR -->
        <div class="page-sidebar-wrapper">
            <!-- BEGIN SIDEBAR -->
            <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
            <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        @include('layouts._aside')
        <!-- END SIDEBAR -->
        </div>
        <!-- END SIDEBAR -->
        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <!-- BEGIN CONTENT BODY -->
            <div class="page-content">
                <!-- BEGIN PAGE HEADER-->
                @yield('content')

                @include('partials._session')

            </div>
            <!-- END CONTENT BODY -->
        </div>
        <!-- END CONTENT -->

    </div>
    <!-- BEGIN FOOTER -->
    <div class="page-footer">

        <div class="page-footer-inner"> 2021 &copy; This Theme By
            &nbsp;|&nbsp;
            <a href="http://innovations-eg.com/"
               title="Purchase Metronic just for 27$ and get lifetime updates for free" target="_blank">Innovation</a>
        </div>
        <div class="scroll-to-top">
            <i class="icon-arrow-up"></i>
        </div>
    </div>
    <!-- END FOOTER -->
</div>

<div class="quick-nav-overlay"></div>
<!-- END QUICK NAV -->
<!-- END QUICK NAV -->
<!--[if lt IE 9]>
    <script src="{{ asset('/dashboard_files/global/plugins/respond.min.js') }}"></script>
    <script src="{{ asset('/dashboard_files/global/plugins/excanvas.min.js') }}"></script>
    <script src="{{ asset('/dashboard_files/global/plugins/ie8.fix.min.js') }}"></script>
    <![endif]-->
<!-- BEGIN CORE PLUGINS -->
<!-- BEGIN CORE PLUGINS -->
<script src="{{ asset('/dashboard_files/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{asset('vendors/datatables.net/js/jquery.dataTables.js')}}"></script>

<script src="{{ asset('/dashboard_files/global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript">
</script>
<script src="{{ asset('/dashboard_files/global/plugins/js.cookie.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/dashboard_files/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('/dashboard_files/global/plugins/jquery.blockui.min.js') }}" type="text/javascript">
</script>
<script src="{{ asset('/dashboard_files/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"
        type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- END CORE PLUGINS -->
<script src="{{ asset('dashboard_files/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}"
        type="text/javascript"></script>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{ asset('dashboard_files/global/plugins/bootstrap-select/js/bootstrap-select.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('dashboard_files/global/plugins/jquery-multi-select/js/jquery.multi-select.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('dashboard_files/global/plugins/select2/js/select2.full.min.js') }}"
        type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
{{-- start --}}
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{ asset('/dashboard_files/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('/dashboard_files/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('/dashboard_files/global/plugins/bootstrap-markdown/lib/markdown.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('/dashboard_files/global/plugins/bootstrap-markdown/js/bootstrap-markdown.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('/dashboard_files/global/plugins/bootstrap-summernote/summernote.min.js') }}"
        type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
{{-- end --}}



<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{ asset('/dashboard_files/global/plugins/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/dashboard_files/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js') }}"
        type="text/javascript">
</script>
<script src="{{ asset('/dashboard_files/global/plugins/morris/morris.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/dashboard_files/global/plugins/morris/raphael-min.js') }}" type="text/javascript">
</script>
<script src="{{ asset('/dashboard_files/global/plugins/counterup/jquery.waypoints.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('/dashboard_files/global/plugins/counterup/jquery.counterup.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('/dashboard_files/global/plugins/amcharts/amcharts/amcharts.js') }}" type="text/javascript">
</script>
<script src="{{ asset('/dashboard_files/global/plugins/amcharts/amcharts/serial.js') }}" type="text/javascript">
</script>
<script src="{{ asset('/dashboard_files/global/plugins/amcharts/amcharts/pie.js') }}" type="text/javascript">
</script>
<script src="{{ asset('/dashboard_files/global/plugins/amcharts/amcharts/radar.js') }}" type="text/javascript">
</script>
<script src="{{ asset('/dashboard_files/global/plugins/amcharts/amcharts/themes/light.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('/dashboard_files/global/plugins/amcharts/amcharts/themes/patterns.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('/dashboard_files/global/plugins/amcharts/amcharts/themes/chalk.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('/dashboard_files/global/plugins/amcharts/ammap/ammap.js') }}" type="text/javascript">
</script>
<script src="{{ asset('/dashboard_files/global/plugins/amcharts/ammap/maps/js/worldLow.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('/dashboard_files/global/plugins/amcharts/amstockcharts/amstock.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('/dashboard_files/global/plugins/fullcalendar/fullcalendar.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('/dashboard_files/global/plugins/horizontal-timeline/horizontal-timeline.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('/dashboard_files/global/plugins/flot/jquery.flot.min.js') }}" type="text/javascript">
</script>
<script src="{{ asset('/dashboard_files/global/plugins/flot/jquery.flot.resize.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('/dashboard_files/global/plugins/flot/jquery.flot.categories.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('/dashboard_files/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js') }}"
        type="text/javascript">
</script>
<script src="{{ asset('/dashboard_files/global/plugins/jquery.sparkline.min.js') }}" type="text/javascript">
</script>
<script src="{{ asset('/dashboard_files/global/plugins/jqvmap/jqvmap/jquery.vmap.js') }}" type="text/javascript">
</script>
<script src="{{ asset('/dashboard_files/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('/dashboard_files/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('/dashboard_files/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('/dashboard_files/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('/dashboard_files/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('/dashboard_files/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js') }}"
        type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{ asset('/dashboard_files/global/scripts/datatable.js') }}" type="text/javascript"></script>
<script src="{{ asset('/dashboard_files/global/plugins/datatables/datatables.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('/dashboard_files/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}"
        type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{ asset('dashboard_files/pages/scripts/table-datatables-responsive.min.js') }}"
        type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="{{ asset('/dashboard_files/global/scripts/app.min.js') }}" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->

<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="{{ asset('/dashboard_files/pages/scripts/components-multi-select.min.js') }}"
        type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{ asset('/dashboard_files/pages/scripts/components-select2.min.js') }}" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->

{{--    <!-- BEGIN PAGE LEVEL SCRIPTS -->--}}
{{--    <script src="{{ asset('/dashboard_files/pages/scripts/table-datatables-managed.min.js') }}" type="text/javascript"></script>--}}
{{--    <!-- END PAGE LEVEL SCRIPTS -->--}}

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{ asset('/dashboard_files/pages/scripts/components-editors.min.js') }}" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->


<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{ asset('/dashboard_files/pages/scripts/dashboard.min.js') }}" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->

<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="{{ asset('/dashboard_files/layouts/layout/scripts/layout.min.js') }}" type="text/javascript">
</script>
<script src="{{ asset('/dashboard_files/layouts/layout/scripts/demo.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/dashboard_files/layouts/global/scripts/quick-sidebar.min.js') }}" type="text/javascript">
</script>
<script src="{{ asset('/dashboard_files/layouts/global/scripts/quick-nav.min.js') }}" type="text/javascript">
</script>
<!-- semantic -->
<script src="{{asset('vendors/semantic/semantic.min.js')}}"></script>
<script src="{{asset('build/js/semantic.js')}}"></script>
<script src="{{asset('build/js/custom.min.js')}}"></script>
<!-- END THEME LAYOUT SCRIPTS -->
{{-- <script src="https://code.jquery.com/jquery-3.5.1.js" ></script> --}}
{{-- <script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js" ></script> --}}
<script type="text/javascript">
    $(document).ready(function () {
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
    $('#search').on('keyup', function () {
        $value = $(this).val();
        $.ajax({
            type: 'get',
            url: '{{URL::to('/admin/searchInEditProd')}}',
            data: {'search': $value},
            success: function (data) {
                $('tbody').html(data);
            }
        });
    })
</script>
<script type="text/javascript">
    $.ajaxSetup({headers: {'csrftoken': '{{ csrf_token() }}'}});
</script>
@yield('javascript1')


</body>

</html>
