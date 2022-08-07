<div class="page-sidebar navbar-collapse collapse">
    <!-- BEGIN SIDEBAR MENU -->
    <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
    <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
    <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
    <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true"
        data-slide-speed="200">
        <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
        <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
        <li class="sidebar-toggler-wrapper hide">
            <div class="sidebar-toggler">
                <span></span>
            </div>
        </li>
        <!-- END SIDEBAR TOGGLER BUTTON -->
        <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->


        <li class="nav-item {{ (request()->is('admin')) ? 'active' : '' }}">
            <a href="{{url('/admin')}}">
                <i class='fa fa-home'></i>
                <span class="title">الرئيسيه </span>
                @if(request()->is('admin'))
                    <span class="selected"></span>
                @endif

            </a>
        </li>
        @permission('create-options')
        <li class="nav-item {{ (request()->is('admin/options')) ? 'active' : '' }}">
            <a href="{{url('/admin/options')}}">
                <i class='fa fa-home'></i>
                <span class="title">اعدادات التطبيق</span>
                <span class="selected"></span>
            </a>
        </li>
        @endpermission

        @permission('read-mongez')
        <li class="nav-item {{ (request()->is('admin/mongez')) ? 'active' : '' }}">
            <a href="{{url('/admin/mongez')}}">
                <i class='fa fa-home'></i>
                <span class="title">خدمة طلب فى السريع</span>
                <span class="selected"></span>
            </a>
        </li>
        @endpermission

        @permission('read-defult_mongez')
        <li class="nav-item {{ (request()->is('admin/defult_mongez')) ? 'active' : '' }}">
            <a href="{{url('/admin/defult_mongez')}}">
                <i class='fa fa-home'></i>
                <span class="title">اعدادات خدمة طلب فى السريع</span>
                <span class="selected"></span>
            </a>
        </li>
        @endpermission
        @permission('read-activity_type')
        <li class="nav-item {{ (request()->is('admin/activity-type')) ? 'active' : '' }}">
            <a href="{{url('/admin/activity-type')}}">
                <i class='fa fa-home'></i>
                <span class="title">انواع الانشطة</span>
                <span class="selected"></span>
            </a>
        </li>
        @endpermission

        @permission('read-discount_type')
        <li class="nav-item {{ (request()->is('admin/discount_type')) ? 'active' : '' }}">
            <a href="{{url('/admin/discount_type')}}">
                <i class='fa fa-home'></i>
                <span class="title">انواع الخصومات</span>
                <span class="selected"></span>
            </a>
        </li>
        @endpermission

        @permission('read-coupons')
        <li class="nav-item {{ (request()->is('admin/coupons')) ? 'active' : '' }}">
            <a href="{{url('/admin/coupons')}}">
                <i class='fa fa-home'></i>
                <span class="title">برومو كود</span>
                <span class="selected"></span>
            </a>
        </li>
        @endpermission


        @permission('read-sliders')
        <li class="nav-item {{ (request()->is('admin/sliders')) ? 'active' : '' }}">
            <a href="{{url('/admin/sliders')}}">
                <i class='fa fa-home'></i>
                <span class="title">السلايدر </span>
                <span class="selected"></span>
            </a>
        </li>
        <li class="nav-item {{ (request()->is('admin/shoptypes')) ? 'active' : '' }}">
            <a href="{{url('/admin/shoptypes')}}">
                <i class='fa fa-home'></i>
                <span class="title">التخصصات </span>
                <span class="selected"></span>
            </a>
        </li>
        @endpermission

        {{--        @permission('read-complaint_type')--}}
        {{--        <li class="nav-item {{ (request()->is('admin/complaint_type')) ? 'active' : '' }}">--}}
        {{--            <a href="{{url('/admin/complaint_type')}}">--}}
        {{--                <i class='fa fa-home'></i>--}}
        {{--                <span class="title">انواع الشكاوى والمقترحات</span>--}}
        {{--                <span class="selected"></span>--}}
        {{--            </a>--}}
        {{--        </li>--}}
        {{--        @endpermission--}}

        @permission('read-users')
        <li class="nav-item {{ (request()->is('admin/users')) ? 'active' : '' }}">
            <a href="{{url('/admin/users')}}">
                <i class='fa fa-home'></i>
                <span class="title"> المستخدمين</span>
                <span class="selected"></span>
            </a>
        </li>
        <li class="nav-item {{ (request()->is('admin/finance_manager','admin/manager','admin/store-kepers','admin/seller')) ? 'active open' : '' }}">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="icon-settings"></i>
                <span class="title">المسئولين </span>
                <span class="selected"></span>
                <span
                    class="arrow {{ (request()->is('admin/finance_manager','admin/manager','admin/store-kepers','admin/seller')) ? ' open' : '' }}"></span>
            </a>
            <ul class="sub-menu">
                <!--<ul class="nav child_menu">-->
                <li class="nav-item {{ (request()->is('admin/finance_manager')) ? 'active open' : '' }}">
                    <a href="{{url('/admin/finance_manager')}}">
                        <i class='fa fa-home'></i>
                        <span class="title">مسئولى الماليه</span>
                        <span class="selected"></span>
                    </a>
                </li>
                <li class="nav-item {{ (request()->is('admin/manager')) ? 'active open' : '' }}">
                    <a href="{{url('/admin/manager')}}">
                        <i class='fa fa-home'></i>
                        <span class="title">مسئولى المشتريات</span>
                        <span class="selected"></span>
                    </a>
                </li>
                <li class="nav-item {{ (request()->is('admin/store-kepers')) ? 'active open' : '' }}">
                    <a href="{{url('/admin/store-kepers')}}">
                        <i class='fa fa-home'></i>
                        <span class="title">امناء المخزن</span>
                        <span class="selected"></span>
                    </a>
                </li>
                <li class="nav-item {{ (request()->is('admin/seller')) ? 'active open' : '' }}">
                    <a href="{{url('/admin/seller')}}">
                        <i class='fa fa-home'></i>
                        <span class="title">البائعين </span>
                        <span class="selected"></span>
                    </a>
                </li>

            </ul>
        </li>
        @endpermission

        @permission('read-clients')
        <li class="nav-item {{ (request()->is('admin/clients')) ? 'active' : '' }}">
            <a href="{{url('/admin/clients')}}">
                <i class='fa fa-home'></i>
                <span class="title">العملاء</span>
                <span class="selected"></span>
            </a>
        </li>
        @endpermission

        @permission('read-places')
        <li class="nav-item {{ (request()->is('admin/places')) ? 'active' : '' }}">
            <a href="{{url('/admin/places')}}">
                <i class='fa fa-home'></i>
                <span class="title">المناطق</span>
                <span class="selected"></span>
            </a>
        </li>
        @endpermission
        @permission('read-mandobs')
        <li class="nav-item {{ (request()->is('admin/mandoobs')) ? 'active' : '' }}">
            <a href="{{url('/admin/mandoobs')}}">
                <i class='fa fa-home'></i>
                <span class="title">المندوبين </span>
                <span class="selected"></span>
            </a>
        </li>
        @endpermission

        @permission('create-clients')
        <li class="nav-item {{ (request()->is('admin/create_client')) ? 'active' : '' }}">
            <a href="{{url('/admin/create_client')}}">
                <i class='fa fa-home'></i>
                <span class="title"> اضافة عميل بيع مباشر</span>
                <span class="selected"></span>
            </a>
        </li>
        @endpermission

        @role('super_administrator')
        <li class="nav-item {{ (request()->is('admin/create_notification')) ? 'active' : '' }}">
            <a href="{{url('/admin/create_notification')}}">
                <i class='fa fa-home'></i>
                <span class="title"> اضافة اشعار للتطبيق</span>
                <span class="selected"></span>
            </a>
        </li>
        @endrole

        @permission('read-suppliers')
        <li class="nav-item {{ (request()->is('admin/suppliers')) ? 'active' : '' }}">
            <a href="{{url('/admin/suppliers')}}">
                <i class='fa fa-home'></i>
                <span class="title">الموردين</span>
                <span class="selected"></span>
            </a>
        </li>
        @endpermission

        @permission('read-categories')
        <li class="nav-item {{ (request()->is('admin/categories')) ? 'active' : '' }}">
            <a href="{{url('/admin/categories')}}">
                <i class='fa fa-home'></i>
                <span class="title">الفئات</span>
                <span class="selected"></span>
            </a>
        </li>
        @endpermission

        @permission('read-companies')
        <li class="nav-item {{ (request()->is('admin/companies')) ? 'active' : '' }}">
            <a href="{{url('/admin/companies')}}">
                <i class='fa fa-home'></i>
                <span class="title">الشركات</span>
                <span class="selected"></span>
            </a>
        </li>
        @endpermission

        {{--        <li class="nav-item {{ (request()->is('admin/categories','admin/subcategories')) ? 'active open' : '' }}">--}}
        {{--            <a href="javascript:;" class="nav-link nav-toggle">--}}
        {{--                <i class="icon-settings"></i>--}}
        {{--                <span class="title">الفئات </span>--}}
        {{--                <span class="selected"></span>--}}
        {{--                <span class="arrow {{ (request()->is('admin/categories','admin/subcategories')) ? ' open' : '' }}"></span>--}}

        {{--            </a>--}}
        {{--            <ul class="sub-menu">--}}
        {{--                @permission('read-categories')--}}
        {{--                <li class="nav-item  {{ (request()->is('admin/categories')) ? 'active open' : '' }}">--}}
        {{--                    <a href="{{url('/admin/categories')}}">--}}
        {{--                        <i class='fa fa-home'></i>--}}
        {{--                        <span class="title">الفئات</span>--}}
        {{--                        <span class="selected"></span>--}}

        {{--                    </a>--}}
        {{--                </li>--}}
        {{--                @endpermission--}}

        {{--                @permission('read-subcategories')--}}
        {{--                <li class="nav-item  {{ (request()->is('admin/subcategories')) ? 'active open' : '' }}">--}}
        {{--                    <a href="{{url('/admin/subcategories')}}">--}}
        {{--                        <i class='fa fa-home'></i>--}}
        {{--                        <span class="title"> الفئات الفرعيه</span>--}}
        {{--                        <span class="selected"></span>--}}
        {{--                    </a>--}}
        {{--                </li>--}}
        {{--                @endpermission--}}
        {{--            </ul>--}}
        {{--        </li>--}}
        @permission('read-products')
        <li class="nav-item {{ (request()->is('admin/products')) ? 'active' : '' }}">
            <a href="{{url('/admin/products')}}">
                <i class='fa fa-home'></i>
                <span class="title">المنتجات</span>
                <span class="selected"></span>
            </a>
        </li>
        @endpermission
        @permission('read-min_prices')
        <li class="nav-item {{ (request()->is('admin/min-price')) ? 'active' : '' }}">
            <a href="{{url('/admin/min-price')}}">
                <i class='fa fa-home'></i>
                <span class="title">اقل سعر للطلب</span>
                <span class="selected"></span>
            </a>
        </li>
        @endpermission
        @permission('read-places')
        <li class="nav-item {{ (request()->is('admin/directions')) ? 'active' : '' }}">
            <a href="{{url('/admin/directions')}}">
                <i class='fa fa-home'></i>
                <span class="title">الاتجاهات للمندوبين</span>
                <span class="selected"></span>
            </a>
        </li>
        @endpermission

        @permission('read-receipt_status')
        <li class="nav-item {{ (request()->is('admin/receipt_statuses')) ? 'active' : '' }}">
            <a href="{{url('/admin/receipt_statuses')}}">
                <i class='fa fa-home'></i>
                <span class="title">حالات الاستلام</span>
                <span class="selected"></span>
            </a>
        </li>
        @endpermission

        @permission('read-return_reasons')
        <li class="nav-item {{ (request()->is('admin/return_reasons')) ? 'active' : '' }}">
            <a href="{{url('/admin/return_reasons')}}">
                <i class='fa fa-home'></i>
                <span class="title">اسباب الاسترجاع</span>
                <span class="selected"></span>
            </a>
        </li>
        @endpermission

        @permission('read-stores')
        <li class="nav-item {{ (request()->is('admin/stores')) ? 'active' : '' }}">
            <a href="{{url('/admin/stores')}}">
                <i class='fa fa-home'></i>
                <span class="title">المخزن</span>
                <span class="selected"></span>
            </a>
        </li>
        @endpermission

        <li class="nav-item {{ (request()->is('admin/lockers','admin/outgoings','admin/ingoings')) ? 'active open' : '' }}">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="icon-settings"></i>
                <span class="title">الخزينه </span>
                <span class="selected"></span>
                <span
                    class="arrow {{ (request()->is('admin/lockers','admin/outgoings','admin/ingoings')) ? ' open' : '' }}"></span>
            </a>
            <ul class="sub-menu">

                @permission('read-statistics')
                <li class="nav-item {{ (request()->is('admin/lockers')) ? 'active open' : '' }}">
                    <a href="{{url('/admin/lockers/')}}">
                        <i class="fa fa-home"></i>
                        <span class="title"> الخزينه</span>
                        <span class="selected"></span>
                    </a>
                </li>
                @endpermission
                @permission('read-expenses')
                <li class="nav-item {{ (request()->is('admin/outgoings')) ? 'active open' : '' }}">
                    <a href="{{url('/admin/outgoings/')}}">
                        <i class="fa fa-home"></i>
                        <span class="title">المصروفات</span>
                        <span class="selected"></span>
                    </a>
                </li>
                @endpermission

                @permission('read-revenues')
                <li class="nav-item {{ (request()->is('admin/ingoings')) ? 'active open' : '' }}">
                    <a href="{{url('/admin/ingoings/')}}">
                        <i class="fa fa-home"></i>
                        <span class="title"> الايرادات</span>
                        <span class="selected"></span>
                    </a>
                </li>
                @endpermission


            </ul>
        </li>

        @permission('read-edited_orders')
        <li class="nav-item {{ (request()->is('admin/edited_orders')) ? 'active' : '' }}">
            <a href="{{url('/admin/edited_orders')}}">
                <i class='fa fa-home'></i>
                <span class="title">الطلبات المعدله  </span>
                <span class="selected"></span>
            </a>
        </li>
        @endpermission
        @permission('read-reports')
        <li class="nav-item {{ (request()->is('admin/finance_managers-reports','admin/manager-reports','admin/seller-reports','admin/mandoobs','admin/keeper-reports','admin/orders-report','admin/report_net_profit_invoices','admin/direct_sells','admin/totals/in_out_total','admin/depts','admin/supplier_depts','admin/produts_expiration','admin/totals/order_product_total','admin/totals/income_product_total','admin/mostproducts','admin/user_notifies','admin/complaints','admin/complaintsproducts')) ? 'active open' : '' }}">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="icon-settings"></i>
                <span class="title">التقارير </span>
                <span class="selected"></span>
                <span
                    class="arrow {{ (request()->is('admin/finance_managers-reports','admin/manager-reports','admin/seller-reports','admin/mandoobs','admin/keeper-reports','admin/orders-report','admin/report_net_profit_invoices','admin/direct_sells','admin/totals/in_out_total','admin/depts','admin/supplier_depts','admin/produts_expiration','admin/totals/order_product_total','admin/totals/income_product_total','admin/mostproducts','admin/user_notifies','admin/complaints','admin/complaintsproducts')) ? ' open' : '' }}"></span>

            </a>
            <ul class="sub-menu">

                <!--<ul class="nav child_menu">-->

                <li class="nav-item {{ (request()->is('admin/finance_managers-reports')) ? 'active open' : '' }}">
                    <a href="{{url('/admin/finance_managers-reports')}}">
                        <i class='fa fa-home'></i>
                        <span class="title">تقارير الماليه  </span>
                        <span class="selected"></span>
                    </a>
                </li>
                <li class="nav-item {{ (request()->is('admin/manager-reports')) ? 'active open' : '' }}">
                    <a href="{{url('/admin/manager-reports')}}">
                        <i class='fa fa-home'></i>
                        <span class="title">تقارير مسئولى الشراء </span>
                        <span class="selected"></span>
                    </a>
                </li>
                <li class="nav-item {{ (request()->is('admin/seller-reports')) ? 'active open' : '' }}">
                    <a href="{{url('/admin/seller-reports')}}">
                        <i class='fa fa-home'></i>
                        <span class="title">تقاريرالبائعين </span>
                        <span class="selected"></span>
                    </a>
                </li>
{{--                @permission('read-mandobs')--}}
{{--                <li class="nav-item {{ (request()->is('admin/mandoobs')) ? 'active open' : '' }}">--}}
{{--                    <a href="{{url('/admin/mandoobs')}}">--}}
{{--                        <i class='fa fa-home'></i>--}}
{{--                        <span class="title">المندوبين</span>--}}
{{--                        <span class="selected"></span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                @endpermission--}}
                <li class="nav-item {{ (request()->is('admin/keeper-reports')) ? 'active open' : '' }}">
                    <a href="{{url('/admin/keeper-reports')}}">
                        <i class='fa fa-home'></i>
                        <span class="title">تقارير امناء المخازن </span>
                        <span class="selected"></span>
                    </a>
                </li>
                <li class="nav-item {{ (request()->is('admin/orders-report')) ? 'active open' : '' }}">
                    <a href="{{url('/admin/orders-report')}}">
                        <i class='fa fa-home'></i>
                        <span class="title">تقارير جميع الطلبات </span>
                        <span class="selected"></span>
                    </a>
                </li>

                <li class="nav-item {{ (request()->is('admin/report_net_profit_invoices')) ? 'active open' : '' }}">
                    <a href="{{url('/admin/report_net_profit_invoices')}}">
                        <i class='fa fa-home'></i>
                        <span class="title">تقارير ارباح فواتير البيع المباشر</span>
                        <span class="selected"></span>
                    </a>
                </li>


{{--                <li class="nav-item {{ (request()->is('admin/direct_sells')) ? 'active open' : '' }}">--}}
{{--                    <a href="{{url('/admin/direct_sells')}}">--}}
{{--                        <i class='fa fa-home'></i>--}}
{{--                        <span class="title">تقارير ارباح فواتير الاونلاين</span>--}}
{{--                        <span class="selected"></span>--}}
{{--                    </a>--}}
{{--                </li>--}}

                @permission('read-statistics')
                <li class="nav-item {{ (request()->is('admin/totals/in_out_total')) ? 'active open' : '' }}">
                    <a href="{{url('/admin/totals/in_out_total')}}">
                        <i class="fa fa-home"></i>
                        <span class="title">صافي الارباح</span>
                        <span class="selected"></span>
                    </a>
                </li>
                @endpermission

                @permission('read-depts')
                <li class="nav-item {{ (request()->is('admin/depts')) ? 'active open' : '' }}">
                    <a href="{{url('/admin/depts')}}">
                        <i class='fa fa-home'></i>
                        <span class="title">مديونيات العملاء</span>
                        <span class="selected"></span>
                    </a>
                </li>
                <li class="nav-item {{ (request()->is('admin/supplier_depts')) ? 'active open' : '' }}">
                    <a href="{{url('/admin/supplier_depts')}}">
                        <i class='fa fa-home'></i>
                        <span class="title"> مديونيات الموردين</span>
                        <span class="selected"></span>
                    </a>
                </li>
                @endpermission

                <li class="nav-item {{ (request()->is('admin/produts_expiration')) ? 'active open' : '' }}">
                    <a href="{{url('/admin/produts_expiration')}}">
                        <i class='fa fa-home'></i>
                        <span class="title">صلاحيات المنتجات</span>
                        <span class="selected"></span>
                    </a>
                </li>

                @permission('read-statistics')
                <li class="nav-item {{ (request()->is('admin/totals/order_product_total')) ? 'active open' : '' }}">
                    <a href="{{url('/admin/totals/order_product_total')}}">
                        <i class="fa fa-home"></i>
                        <span class="title">اجمالي الطلب على المنتجات</span>
                        <span class="selected"></span>
                    </a>
                </li>
                @endpermission

                @permission('read-statistics')
                <li class="nav-item {{ (request()->is('admin/totals/income_product_total')) ? 'active open' : '' }}">
                    <a href="{{url('/admin/totals/income_product_total')}}">
                        <i class="fa fa-home"></i>
                        <span class="title"> الدخل الناتج عن بيع المنتجات</span>
                        <span class="selected"></span>
                    </a>
                </li>
                @endpermission

                @permission('read-statistics')
            <!--<li class="nav-item"><a href="{{url('/admin/totals/paid_users_total')}}"><i class="fa fa-home"></i>القوه الاتمانيه لكل عميل</a></li>-->
                @endpermission

                @permission('read-most_products')
                <li class="nav-item {{ (request()->is('admin/mostproducts')) ? 'active open' : '' }}">
                    <a href="{{url('/admin/mostproducts')}}">
                        <i class='fa fa-home'></i>
                        <span class="title"> المنتجات الاكثر مبيعا</span>
                        <span class="selected"></span>
                    </a>
                </li>
                @endpermission

                {{--                @permission('read-notify_users')--}}
                {{--                <li class="nav-item {{ (request()->is('admin/user_notifies')) ? 'active open' : '' }}">--}}
                {{--                    <a href="{{url('/admin/user_notifies')}}">--}}
                {{--                        <i class='fa fa-home'></i>--}}
                {{--                        <span class="title">العملاء المميزين</span>--}}
                {{--                        <span class="selected"></span>--}}
                {{--                    </a>--}}
                {{--                </li>--}}
                {{--                @endpermission--}}

                @permission('read-complaints')
                <li class="nav-item {{ (request()->is('admin/complaints')) ? 'active open' : '' }}">
                    <a href="{{url('/admin/complaints')}}">
                        <i class='fa fa-home'></i>
                        <span class="title">الشكاوي </span>
                        <span class="selected"></span>
                    </a>
                </li>
                @endpermission

                @permission('read-complaint_products')
                <li class="nav-item {{ (request()->is('admin/complaintsproducts')) ? 'active open' : '' }}">
                    <a href="{{url('/admin/complaintsproducts')}}">
                        <i class='fa fa-home'></i>
                        <span class="title"> شكاوي المنتجات</span>
                        <span class="selected"></span>
                    </a>
                </li>
                @endpermission

                @permission('read-complaints')
                <li class="nav-item {{ (request()->is('admin/contact_message')) ? 'active open' : '' }}">
                    <a href="{{url('/admin/contact_message')}}">
                        <i class='fa fa-home'></i>
                        <span class="title">رسائل العملاء </span>
                        <span class="selected"></span>
                    </a>
                </li>
                @endpermission

            </ul>
        </li>
        @endpermission


        <li class="nav-item {{ (request()->is('admin/invoices')) ? 'active' : '' }}">
            <a href="{{url('/admin/invoices')}}">
                <i class='fa fa-home'></i>
                <span class="title"> انشاء فواتير البيع المباشر</span>
                <span class="selected"></span>
            </a>
        </li>


        {{--        @permission('read-notifies')--}}
        {{--        <li class="nav-item {{ (request()->is('admin/global_notify')) ? 'active' : '' }}">--}}
        {{--            <a href="{{url('/admin/global_notify')}}">--}}
        {{--                <i class='fa fa-home'></i>--}}
        {{--                <span class="title">المكافأه العام </span>--}}
        {{--                <span class="selected"></span>--}}
        {{--            </a>--}}
        {{--        </li>--}}
        {{--        @endpermission--}}

        {{--        @permission('read-offer_points')--}}
        {{--        <li class="nav-item {{ (request()->is('admin/offer_points')) ? 'active' : '' }}">--}}
        {{--            <a href="{{url('/admin/offer_points')}}">--}}
        {{--                <i class='fa fa-home'></i>--}}
        {{--                <span class="title">عروض النقاط </span>--}}
        {{--                <span class="selected"></span>--}}
        {{--            </a>--}}
        {{--        </li>--}}
        {{--        @endpermission--}}


        @if(!empty(Auth::user()->seller_store()->get()->first()))
            <li class="nav-item {{ (request()->is('admin/show/store')) ? 'active' : '' }}">
                <a href="{{url('/admin/show/store')}}">
                    <i class='fa fa-home'></i>
                    <span class="title">المخزن الخاص بالبائع</span>
                    <span class="selected"></span>
                </a>
            </li>
            @permission('read-orders')
            <li class="nav-item {{ (request()->is('admin/store/orders')) ? 'active' : '' }}">
                <a href="{{url('/admin/store/orders')}}">
                    <i class='fa fa-home'></i>
                    <span class="title"> طلبات المخزن للبائع</span>
                    <span class="selected"></span>
                </a>
            </li>
            @endpermission
        @endif
        @if(!empty(Auth::user()->keeper_store))
            <li class="nav-item {{ (request()->is('admin/show/store')) ? 'active' : '' }}">
                <a href="{{url('/admin/show/store')}}">
                    <i class='fa fa-home'></i>
                    <span class="title"> المخزن الخاص بامين المخزن</span>
                    <span class="selected"></span>
                </a>
            </li>
            @permission('read-examinations')
            <!--<li class="nav-item">-->
        <!--    <a href="{{url('/admin/store/examination_units', Auth::user()->id)}}"><i class='fa fa-home'></i> استلام البضاعه </a>-->
            <!--</li>-->

            @endpermission
{{--            @permission('read-transfers')--}}
{{--            <li class="nav-item {{ (request()->is('admin/store/transfers')) ? 'active' : '' }}">--}}
{{--                <a href="{{url('/admin/store/transfers')}}">--}}
{{--                    <i class='fa fa-home'></i>--}}
{{--                    <span class="title"> نقل البضائع </span>--}}
{{--                    <span class="selected"></span>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            @endpermission--}}
            @permission('read-examinations')
            <li class="nav-item {{ (request()->is('admin/examinations')) ? 'active' : '' }}">
                <a href="{{url('/admin/examinations')}}">
                    <i class='fa fa-home'></i>
                    <span class="title"> فواتير الشراء</span>
                    <span class="selected"></span>
                </a>
            </li>
            @endpermission

            @permission('read-orders')
            <li class="nav-item {{ (request()->is('admin/store/orders')) ? 'active' : '' }}">
                <a href="{{url('/admin/store/orders')}}">
                    <i class='fa fa-home'></i>
                    <span class="title"> طلبات المخزن</span>
                    <span class="selected"></span>
                </a>
            </li>
            @endpermission

        @endif
        @if(!empty(Auth::user()->manager_store()->get()->first()))
            <li class="nav-item {{ (request()->is('admin/show/store')) ? 'active' : '' }}">
                <a href="{{url('/admin/show/store')}}">
                    <i class='fa fa-home'></i>
                    <span class="title">المخزن الخاص بالمسئول</span>
                    <span class="selected"></span>
                </a>
            </li>
            @permission('read-examinations')
            <li class="nav-item {{ (request()->is('admin/examinations')) ? 'active' : '' }}">
                <a href="{{url('/admin/examinations')}}">
                    <i class='fa fa-home'></i>
                    <span class="title">فواتير الشراء</span>
                    <span class="selected"></span>
                </a>
            </li>
            @endpermission
{{--            @permission('read-transfers')--}}
{{--            <li class="nav-item {{ (request()->is('admin/store/transfers')) ? 'active' : '' }}">--}}
{{--                <a href="{{url('/admin/store/transfers')}}">--}}
{{--                    <i class='fa fa-home'></i>--}}
{{--                    <span class="title"> نقل البضائع</span>--}}
{{--                    <span class="selected"></span>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            @endpermission--}}

            @permission('read-orders')
            <li class="nav-item {{ (request()->is('admin/store/orders')) ? 'active' : '' }}">
                <a href="{{url('/admin/store/orders')}}">
                    <i class='fa fa-home'></i>
                    <span class="title">طلبات المخزن</span>
                    <span class="selected"></span>
                </a>
            </li>
            @endpermission
        @endif
        @permission('read-examinations')
        <li class="nav-item {{ (request()->is('admin/examinations')) ? 'active' : '' }}">
            <a href="{{url('/admin/examinations')}}">
                <i class='fa fa-home'></i>
                <span class="title"> فواتير الشراء</span>
                <span class="selected"></span>
            </a>
        </li>
        @endpermission
        @if(!empty(Auth::user()->store_accountant()->get()->first()))
            <li class="nav-item {{ (request()->is('admin/show/store')) ? 'active' : '' }}">
                <a href="{{url('/admin/show/store')}}">
                    <i class='fa fa-home'></i>
                    <span class="title"> المخزن الخاص بالمحاسب</span>
                    <span class="selected"></span>
                </a>
            </li>
            @permission('read-examinations')
            <li class="nav-item {{ (request()->is('admin/examinations')) ? 'active' : '' }}">
                <a href="{{url('/admin/examinations')}}">
                    <i class='fa fa-home'></i>
                    <span class="title"> فواتير الشراء</span>
                    <span class="selected"></span>
                </a>
            </li>
            @endpermission

{{--            @permission('read-transfers')--}}
{{--            <li class="nav-item {{ (request()->is('admin/store/transfers')) ? 'active' : '' }}">--}}
{{--                <a href="{{url('/admin/store/transfers')}}">--}}
{{--                    <i class='fa fa-home'></i>--}}
{{--                    <span class="title"> نقل البضائع</span>--}}
{{--                    <span class="selected"></span>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            @endpermission--}}

            @permission('read-orders')
            <li class="nav-item {{ (request()->is('admin/store/orders')) ? 'active' : '' }}">
                <a href="{{url('/admin/store/orders')}}">
                    <i class='fa fa-home'></i>
                    <span class="title"> طلبات المخزن</span>
                    <span class="selected"></span>
                </a>
            </li>
            @endpermission
        @endif


        @permission('read-orders')
        <li class="nav-item {{ (request()->is('admin/orders')) ? 'active' : '' }}">
            <a href="{{url('/admin/orders')}}">
                <i class='fa fa-home'></i>
                <span class="title"> جميع الطلبات</span>
                <span class="selected"></span>
            </a>
        </li>
        <li class="nav-item {{ (request()->is('admin/orders-with-recalls')) ? 'active' : '' }}">
            <a href="{{url('/admin/orders-with-recalls')}}">
                <i class='fa fa-home'></i>
                <span class="title"> المرتجعات</span>
                <span class="selected"></span>
            </a>
        </li>
        @endpermission

        @permission('read-orders')
        <li class="nav-item {{ (request()->is('admin/direct_sells')) ? 'active' : '' }}">
            <a href="{{url('/admin/direct_sells')}}">
                <i class='fa fa-home'></i>
                <span class="title">طلبات البيع المباشر</span>
                <span class="selected"></span>
            </a>
        </li>
        @endpermission

        @permission('read-ads')
        <li class="nav-item {{ (request()->is('admin/ads')) ? 'active' : '' }}">
            <a href="{{url('/admin/ads')}}">
                <i class='fa fa-home'></i>
                <span class="title">المساحة الاعلانية</span>
                <span class="selected"></span>
            </a>
        </li>
        @endpermission

        @permission('read-contacts')
        <li class="nav-item {{ (request()->is('admin/contacts')) ? 'active' : '' }}">
            <a href="{{url('/admin/contacts')}}">
                <i class='fa fa-home'></i>
                <span class="title"> معلومات التواصل </span>
                <span class="selected"></span>
            </a>
        </li>
        @endpermission

        <li class="nav-item {{ (request()->is('passwords/'.Auth::user()->id)) ? 'active' : '' }}">
            <a href="{{url('/passwords/'.Auth::user()->id)}}">
                <i class='fa fa-home'></i>
                <span class="title">تعديل كلمة السر </span>
                <span class="selected"></span>
            </a>
        </li>
         <li class="nav-item">
            <a href="{{route('download')}}">
                <i class='fa fa-download'></i>
                <span class="title">تحميل نسخة المندوب </span>
            </a>
        </li>

        <li class="nav-item">
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('frm-logout').submit();"> <i
                    class="fa fa-sign-out"></i>
                <span class="title"> {{ __('الخروج') }}</span>
            </a>
        </li>

    </ul>

</div>
