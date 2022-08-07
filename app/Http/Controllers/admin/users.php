<?php

namespace App\Http\Controllers\admin;

use App\Permission;
use App\Product;
use App\Place;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Shop_Type;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class users extends Controller
{
    use barcode;

    public function printBarcode($id)
    {
        $product=User::find($id);
        $quantity=10;
        $barcode=$this->bar128(stripcslashes($product->id));
        return view('admin.clients.barcode',compact('product','quantity','barcode'));
    }

    public function index()
    {
        $users = User::where('id', '!=', auth()->user()->id)->where('type', 'employee')->get();
        $permissions = [
            'users' => 'المستخدمين',
            'categories' => 'الاقسام',
            'reports' => 'التقارير',
            'companies' => 'الشركات',
            'complaint_products' => 'شكاوي المنتجات',
            'complaints' => 'الشكاوي',
            'depts' => 'المديونيات',
            'examinations' => 'فواتير الشراء',
            'infos' => 'اسعار المنتجات',
            'mandobs' => 'المندوبين',
            'mandob_rates' => 'تقييمات المندوبين',
            'user_rates' => 'تقييمات العملاء',
            'notifies' => 'المكافئات',
            'notify_users' => 'العملاء المميزين',
            'orders' => 'الطلبات',
            'direct_sells' => 'البيع المباشر',
            'places' => 'المناطق',
            'products' => 'المنتجات',
            'receipt_status' => 'حالات الاستلام',
            'return_reasons' => 'اسباب الاسترجاع',
            'sliders' => 'السلايدر',
            'stores' => 'المخازن',
            'subcategories' => 'الفئات الفرعيه',
            'clients' => 'العملاء',
            'statistics' => 'الاحصائيات',
            'transfers' => 'نقل البضائع',
            'contacts' => 'وسائل التواصل',
            'suppliers' => 'الموردين',
            'offer_points' => 'عروض النقاط',
            'options'=>'أخرى',
            'directions'=>'الاتجاهات',
            'add_notifications'=>'اضافة اشعارات',
            'kinds_of_shops'=>'أنواع المحلات',
            'expenses'=>' المصروفات',
            'slider'=>'السلايدر',
            'best_selling_products'=>'المنتجات الاكثر مبيعا',
            'total_demand_for_products'=>'اجمالى الطلب على المنتجات',
            'income_generated_from_the_sale_of_products'=>'الدخل الناتج على بيع المنتجات',
            'revenues'=>'الايرادات',
            'the_credit_strenght_of_each_customer'=>'القوه الائتمانيه لكل عميل ',
            'edited_orders'=>'الطلبات المعدله',
            'min_prices'=>'اقل سعر للطلب',
            'activity_type'=>'أنواع الانشطة',
            'complaint_type'=>'انواع الشكاوى والمقترحات',
            'discount_type'=>'انواع الخصومات',
            'ads'=>'الصور الاعلانية',
            'coupons'=>'كوبونات الخصم',
            'mongez'=>'طلب فى السريع',
            'defult_mongez'=>'اعدادات طلب فى السريع',
        ];

        $maps = [
            'create' => 'انشاء',
            'read' => 'قراءه',
            'update' => 'تعديل',
            'delete' => 'حذف',
        ];

        return view('admin.users.index', compact('users', 'permissions', 'maps'));
    }

    public function indexOfStoreKepper()
    {
        $users = User::where('id', '!=', auth()->user()->id)->where('type', 'employee')->where('keeper_id','!=',null)->get();

        $permissions = [
            'users' => 'المستخدمين',
            'categories' => 'الاقسام',
            'reports' => 'التقارير',
            'companies' => 'الشركات',
            'complaint_products' => 'شكاوي المنتجات',
            'complaints' => 'الشكاوي',
            'depts' => 'المديونيات',
            'examinations' => 'فواتير الشراء',
            'infos' => 'اسعار المنتجات',
            'mandobs' => 'المندوبين',
            'mandob_rates' => 'تقييمات المندوبين',
            'user_rates' => 'تقييمات العملاء',
            'notifies' => 'المكافئات',
            'notify_users' => 'العملاء المميزين',
            'orders' => 'الطلبات',
            'direct_sells' => 'البيع المباشر',
            'places' => 'المناطق',
            'products' => 'المنتجات',
            'receipt_status' => 'حالات الاستلام',
            'return_reasons' => 'اسباب الاسترجاع',
            'sliders' => 'السلايدر',
            'stores' => 'المخازن',
            'subcategories' => 'الفئات الفرعيه',
            'clients' => 'العملاء',
            'statistics' => 'الاحصائيات',
            'transfers' => 'نقل البضائع',
            'contacts' => 'وسائل التواصل',
            'suppliers' => 'الموردين',
            'offer_points' => 'عروض النقاط',
            'options'=>'أخرى',
            'directions'=>'الاتجاهات',
            'add_notifications'=>'اضافة اشعارات',
            'kinds_of_shops'=>'أنواع المحلات',
            'expenses'=>' المصروفات',
            'slider'=>'السلايدر',
            'best_selling_products'=>'المنتجات الاكثر مبيعا',
            'total_demand_for_products'=>'اجمالى الطلب على المنتجات',
            'income_generated_from_the_sale_of_products'=>'الدخل الناتج على بيع المنتجات',
            'revenues'=>'الايرادات',
            'the_credit_strenght_of_each_customer'=>'القوه الائتمانيه لكل عميل ',
            'edited_orders'=>'الطلبات المعدله',
            'min_prices'=>'اقل سعر طلب ',
            'activity_type'=>'أنواع الانشطة',
            'complaint_type'=>'انواع الشكاوى والمقترحات',
            'discount_type'=>'انواع الخصومات',
            'ads'=>'الصور الاعلانية',
            'coupons'=>'كوبونات الخصم',
            'mongez'=>'طلب فى السريع',
            'defult_mongez'=>'اعدادات طلب فى السريع',
        ];

        $maps = [
            'create' => 'انشاء',
            'read' => 'قراءه',
            'update' => 'تعديل',
            'delete' => 'حذف',
        ];
        return view('admin.users.index-of-users', compact('users','maps','permissions'));
    }

    public function indexOfFinanceManager()
    {
        $users = User::where('id', '!=', auth()->user()->id)->where('type', 'employee')->where('finance_manager','!=',null)->get();

        $permissions = [
            'users' => 'المستخدمين',
            'categories' => 'الاقسام',
            'reports' => 'التقارير',
            'companies' => 'الشركات',
            'complaint_products' => 'شكاوي المنتجات',
            'complaints' => 'الشكاوي',
            'depts' => 'المديونيات',
            'examinations' => 'فواتير الشراء',
            'infos' => 'اسعار المنتجات',
            'mandobs' => 'المندوبين',
            'mandob_rates' => 'تقييمات المندوبين',
            'user_rates' => 'تقييمات العملاء',
            'notifies' => 'المكافئات',
            'notify_users' => 'العملاء المميزين',
            'orders' => 'الطلبات',
            'direct_sells' => 'البيع المباشر',
            'places' => 'المناطق',
            'products' => 'المنتجات',
            'receipt_status' => 'حالات الاستلام',
            'return_reasons' => 'اسباب الاسترجاع',
            'sliders' => 'السلايدر',
            'stores' => 'المخازن',
            'subcategories' => 'الفئات الفرعيه',
            'clients' => 'العملاء',
            'statistics' => 'الاحصائيات',
            'transfers' => 'نقل البضائع',
            'contacts' => 'وسائل التواصل',
            'suppliers' => 'الموردين',
            'offer_points' => 'عروض النقاط',
            'options'=>'أخرى',
            'directions'=>'الاتجاهات',
            'add_notifications'=>'اضافة اشعارات',
            'kinds_of_shops'=>'أنواع المحلات',
            'expenses'=>' المصروفات',
            'slider'=>'السلايدر',
            'best_selling_products'=>'المنتجات الاكثر مبيعا',
            'total_demand_for_products'=>'اجمالى الطلب على المنتجات',
            'income_generated_from_the_sale_of_products'=>'الدخل الناتج على بيع المنتجات',
            'revenues'=>'الايرادات',
            'the_credit_strenght_of_each_customer'=>'القوه الائتمانيه لكل عميل ',
            'edited_orders'=>'الطلبات المعدله',
            'min_prices'=>'اقل سعر طلب ',
            'activity_type'=>'أنواع الانشطة',
            'complaint_type'=>'انواع الشكاوى والمقترحات',
            'discount_type'=>'انواع الخصومات',
            'ads'=>'الصور الاعلانية',
            'coupons'=>'كوبونات الخصم',
            'mongez'=>'طلب فى السريع',
            'defult_mongez'=>'اعدادات طلب فى السريع',
        ];

        $maps = [
            'create' => 'انشاء',
            'read' => 'قراءه',
            'update' => 'تعديل',
            'delete' => 'حذف',
        ];
        return view('admin.users.index-of-users', compact('users','maps','permissions'));
    }

    public function ReportOfFinanceManager()
    {
        $users = User::where('id', '!=', auth()->user()->id)->where('type', 'employee')->where('finance_manager','!=',null)->get();
        return view('admin.users.index-of-finance-managers', compact('users'));
    }

    public function ReportOfSeller()
    {
        $users = User::where('id', '!=', auth()->user()->id)->where('type', 'employee')->where('seller_id','!=',null)->get();
        return view('admin.users.index-of-seller', compact('users'));
    }


    public function ReportOfKeeper()
    {
        $users = User::where('id', '!=', auth()->user()->id)->where('type', 'employee')->where('keeper_id','!=',null)->get();
        return view('admin.users.index-of-keeper', compact('users'));
    }


    public function ReportOfManager()
    {
        $users = User::where('id', '!=', auth()->user()->id)->where('type', 'employee')->where('manager_id','!=',null)->get();
        return view('admin.users.index-of-manager', compact('users'));
    }

    public function  indexOfManager()
    {
        $users = User::where('id', '!=', auth()->user()->id)->where('type', 'employee')->where('manager_id','!=',null)->get();

        $permissions = [
            'users' => 'المستخدمين',
            'categories' => 'الاقسام',
            'reports' => 'التقارير',
            'companies' => 'الشركات',
            'complaint_products' => 'شكاوي المنتجات',
            'complaints' => 'الشكاوي',
            'depts' => 'المديونيات',
            'examinations' => 'فواتير الشراء',
            'infos' => 'اسعار المنتجات',
            'mandobs' => 'المندوبين',
            'mandob_rates' => 'تقييمات المندوبين',
            'user_rates' => 'تقييمات العملاء',
            'notifies' => 'المكافئات',
            'notify_users' => 'العملاء المميزين',
            'orders' => 'الطلبات',
            'direct_sells' => 'البيع المباشر',
            'places' => 'المناطق',
            'products' => 'المنتجات',
            'receipt_status' => 'حالات الاستلام',
            'return_reasons' => 'اسباب الاسترجاع',
            'sliders' => 'السلايدر',
            'stores' => 'المخازن',
            'subcategories' => 'الفئات الفرعيه',
            'clients' => 'العملاء',
            'statistics' => 'الاحصائيات',
            'transfers' => 'نقل البضائع',
            'contacts' => 'وسائل التواصل',
            'suppliers' => 'الموردين',
            'offer_points' => 'عروض النقاط',
            'options'=>'أخرى',
            'directions'=>'الاتجاهات',
            'add_notifications'=>'اضافة اشعارات',
            'kinds_of_shops'=>'أنواع المحلات',
            'expenses'=>' المصروفات',
            'slider'=>'السلايدر',
            'best_selling_products'=>'المنتجات الاكثر مبيعا',
            'total_demand_for_products'=>'اجمالى الطلب على المنتجات',
            'income_generated_from_the_sale_of_products'=>'الدخل الناتج على بيع المنتجات',
            'revenues'=>'الايرادات',
            'the_credit_strenght_of_each_customer'=>'القوه الائتمانيه لكل عميل ',
            'edited_orders'=>'الطلبات المعدله',
            'min_prices'=>'اقل سعر طلب ',
            'activity_type'=>'أنواع الانشطة',
            'complaint_type'=>'انواع الشكاوى والمقترحات',
            'discount_type'=>'انواع الخصومات',
            'ads'=>'الصور الاعلانية',
            'coupons'=>'كوبونات الخصم',
            'mongez'=>'طلب فى السريع',
            'defult_mongez'=>'اعدادات طلب فى السريع',
        ];

        $maps = [
            'create' => 'انشاء',
            'read' => 'قراءه',
            'update' => 'تعديل',
            'delete' => 'حذف',
        ];
        return view('admin.users.index-of-users', compact('users','maps','permissions'));
    }


    public function  indexOfSeller()
    {
        $users = User::where('id', '!=', auth()->user()->id)->where('type', 'employee')->where('seller_id','!=',null)->get();

        $permissions = [
            'users' => 'المستخدمين',
            'categories' => 'الاقسام',
            'reports' => 'التقارير',
            'companies' => 'الشركات',
            'complaint_products' => 'شكاوي المنتجات',
            'complaints' => 'الشكاوي',
            'depts' => 'المديونيات',
            'examinations' => 'فواتير الشراء',
            'infos' => 'اسعار المنتجات',
            'mandobs' => 'المندوبين',
            'mandob_rates' => 'تقييمات المندوبين',
            'user_rates' => 'تقييمات العملاء',
            'notifies' => 'المكافئات',
            'notify_users' => 'العملاء المميزين',
            'orders' => 'الطلبات',
            'direct_sells' => 'البيع المباشر',
            'places' => 'المناطق',
            'products' => 'المنتجات',
            'receipt_status' => 'حالات الاستلام',
            'return_reasons' => 'اسباب الاسترجاع',
            'sliders' => 'السلايدر',
            'stores' => 'المخازن',
            'subcategories' => 'الفئات الفرعيه',
            'clients' => 'العملاء',
            'statistics' => 'الاحصائيات',
            'transfers' => 'نقل البضائع',
            'contacts' => 'وسائل التواصل',
            'suppliers' => 'الموردين',
            'offer_points' => 'عروض النقاط',
            'options'=>'أخرى',
            'directions'=>'الاتجاهات',
            'add_notifications'=>'اضافة اشعارات',
            'kinds_of_shops'=>'أنواع المحلات',
            'expenses'=>' المصروفات',
            'slider'=>'السلايدر',
            'best_selling_products'=>'المنتجات الاكثر مبيعا',
            'total_demand_for_products'=>'اجمالى الطلب على المنتجات',
            'income_generated_from_the_sale_of_products'=>'الدخل الناتج على بيع المنتجات',
            'revenues'=>'الايرادات',
            'the_credit_strenght_of_each_customer'=>'القوه الائتمانيه لكل عميل ',
            'edited_orders'=>'الطلبات المعدله',
            'min_prices'=>'اقل سعر طلب ',
            'activity_type'=>'أنواع الانشطة',
            'complaint_type'=>'انواع الشكاوى والمقترحات',
            'discount_type'=>'انواع الخصومات',
            'ads'=>'الصور الاعلانية',
            'coupons'=>'كوبونات الخصم',
            'mongez'=>'طلب فى السريع',
            'defult_mongez'=>'اعدادات طلب فى السريع',
        ];

        $maps = [
            'create' => 'انشاء',
            'read' => 'قراءه',
            'update' => 'تعديل',
            'delete' => 'حذف',
        ];
        return view('admin.users.index-of-users', compact('users','maps','permissions'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = [
            'users' => 'المستخدمين',
            'categories' => 'الاقسام',
            'reports' => 'التقارير',
            'companies' => 'الشركات',
            'complaint_products' => 'شكاوي المنتجات',
            'complaints' => 'الشكاوي',
            'depts' => 'المديونيات',
            'examinations' => 'فواتير الشراء',
            'infos' => 'اسعار المنتجات',
            'mandobs' => 'المندوبين',
            'mandob_rates' => 'تقييمات المندوبين',
            'user_rates' => 'تقييمات العملاء',
            'notifies' => 'المكافئات',
            'notify_users' => 'العملاء المميزين',
            'orders' => 'الطلبات',
            'direct_sells' => 'البيع المباشر',
            'places' => 'المناطق',
            'products' => 'المنتجات',
            'receipt_status' => 'حالات الاستلام',
            'return_reasons' => 'اسباب الاسترجاع',
            'sliders' => 'السلايدر',
            'stores' => 'المخازن',
            'subcategories' => 'الفئات الفرعيه',
            'clients' => 'العملاء',
            'statistics' => 'الاحصائيات',
            'transfers' => 'نقل البضائع',
            'contacts' => 'وسائل التواصل',
            'suppliers' => 'الموردين',
            'offer_points' => 'عروض النقاط',
            'options'=>'أخرى',
            'directions'=>'الاتجاهات',
            'add_notifications'=>'اضافة اشعارات',
            'kinds_of_shops'=>'أنواع المحلات',
            'expenses'=>' المصروفات',
            'slider'=>'السلايدر',
            'best_selling_products'=>'المنتجات الاكثر مبيعا',
            'total_demand_for_products'=>'اجمالى الطلب على المنتجات',
            'income_generated_from_the_sale_of_products'=>'الدخل الناتج على بيع المنتجات',
            'revenues'=>'الايرادات',
            'the_credit_strenght_of_each_customer'=>'القوه الائتمانيه لكل عميل ',
            'edited_orders'=>'الطلبات المعدله',
            'min_prices'=>'اقل سعر طلب ',
            'activity_type'=>'أنواع الانشطة',
            'complaint_type'=>'انواع الشكاوى والمقترحات',
            'discount_type'=>'انواع الخصومات',
            'ads'=>'الصور الاعلانية',
            'coupons'=>'كوبونات الخصم',
            'mongez'=>'طلب فى السريع',
            'defult_mongez'=>'اعدادات طلب فى السريع',
        ];

        $maps = [
            'create' => 'انشاء',
            'read' => 'قراءه',
            'update' => 'تعديل',
            'delete' => 'حذف',
        ];

        return view('admin.users.create', compact('permissions', 'maps'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->all());
        $request['id'] = (int)$request->id;

        if ($request->all_permission)
        {
            $validator = Validator::make($request->all(),[
                'id' => "unique:users,id|required",
                'name' => "required",
                'email' => "email|unique:users,email|required",
                'password' => "required|min:8",
                'permissions' => "required|array|min:1"
            ]);


            if ($validator->fails()) {
                $errors = $validator->errors();
                return back()->with('errors', $errors);
            }

            $password = Hash::make($request->password);

            $user = new User($request->except('permissions'));
            $user->id = $request->id;
            $user->password = $password;
            $user->type = 'employee';
            $user->adder_id = Auth::user()->id;
            $user->save();
            $all_permission = Permission::select('id')->get('id')->pluck('id');
            $user->attachPermissions($all_permission);
        }else{
            $validator = Validator::make($request->all(),[
                'id' => "unique:users,id|required",
                'name' => "required",
                'email' => "email|unique:users,email|required",
                'password' => "required|min:8",
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return back()->with('errors', $errors);
            }

            $password = Hash::make($request->password);

            $user = new User($request->except('permissions'));
            $user->id = $request->id;
            $user->password = $password;
            $user->type = 'employee';
            $user->adder_id = Auth::user()->id;
            $user->save();
//            $user->attachPermissions($request->permissions);
        }

        session()->flash('success',' تمت الأضافة بنجاح ');
        return redirect('admin/users');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $permissions = [
            'users' => 'المستخدمين',
            'categories' => 'الاقسام',
            'reports' => 'التقارير',
            'companies' => 'الشركات',
            'complaint_products' => 'شكاوي المنتجات',
            'complaints' => 'الشكاوي',
            'depts' => 'المديونيات',
            'examinations' => 'فواتير الشراء',
            'infos' => 'اسعار المنتجات',
            'mandobs' => 'المندوبين',
            'mandob_stages' => 'مراحل المندوب',
            'order_stages' => 'مراحل الاوردر',
            'most_products' => 'اهم المنتجات',
            'mandob_rates' => 'تقييمات المندوبين',
            'user_rates' => 'تقييمات العملاء',
            'notifies' => 'المكافئات',
            'notify_users' => 'العملاء المميزين',
            'orders' => 'الطلبات',
            'direct_sells' => 'البيع المباشر',
            'places' => 'المناطق',
            'products' => 'المنتجات',
            'receipt_status' => 'حالات الاستلام',
            'return_reasons' => 'اسباب الاسترجاع',
            'sliders' => 'السلايدر',
            'stores' => 'المخازن',
            'subcategories' => 'الفئات الفرعيه',
            'clients' => 'العملاء',
            'statistics' => 'الاحصائيات',
            'transfers' => 'نقل البضائع',
            'contacts' => 'وسائل التواصل',
            'suppliers' => 'الموردين',
            'offer_points' => 'عروض النقاط',
            'options'=>'أخرى',
            'directions'=>'الاتجاهات',
            'add_notifications'=>'اضافة اشعارات',
            'kinds_of_shops'=>'أنواع المحلات',
            'expenses'=>' المصروفات',
            'slider'=>'السلايدر',
            'best_selling_products'=>'المنتجات الاكثر مبيعا',
            'total_demand_for_products'=>'اجمالى الطلب على المنتجات',
            'income_generated_from_the_sale_of_products'=>'الدخل الناتج على بيع المنتجات',
            'revenues'=>'الايرادات',
            'the_credit_strenght_of_each_customer'=>'القوه الائتمانيه لكل عميل ',
            'edited_orders'=>'الطلبات المعدله',
            'min_prices'=>'اقل سعر طلب ',
            'activity_type'=>'أنواع الانشطة',
            'complaint_type'=>'انواع الشكاوى والمقترحات',
            'discount_type'=>'انواع الخصومات',
            'ads'=>'الصور الاعلانية',
            'coupons'=>'كوبونات الخصم',
            'mongez'=>'طلب فى السريع',
            'defult_mongez'=>'اعدادات طلب فى السريع',
        ];

        $maps = [
            'create' => 'انشاء',
            'read' => 'قراءه',
            'update' => 'تعديل',
            'delete' => 'حذف',
        ];
        return view('admin.users.show', compact('user','permissions','maps'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permissions = [
            'users' => 'المستخدمين',
            'categories' => 'الاقسام',
            'reports' => 'التقارير',
            'companies' => 'الشركات',
            'complaint_products' => 'شكاوي المنتجات',
            'complaints' => 'الشكاوي',
            'depts' => 'المديونيات',
            'examinations' => 'فواتير الشراء',
            'infos' => 'اسعار المنتجات',
            'mandobs' => 'المندوبين',
            'mandob_rates' => 'تقييمات المندوبين',
            'user_rates' => 'تقييمات العملاء',
            'notifies' => 'المكافئات',
            'notify_users' => 'العملاء المميزين',
            'orders' => 'الطلبات',
            'direct_sells' => 'البيع المباشر',
            'places' => 'المناطق',
            'products' => 'المنتجات',
            'receipt_status' => 'حالات الاستلام',
            'return_reasons' => 'اسباب الاسترجاع',
            'sliders' => 'السلايدر',
            'stores' => 'المخازن',
            'subcategories' => 'الفئات الفرعيه',
            'clients' => 'العملاء',
            'statistics' => 'الاحصائيات',
            'transfers' => 'نقل البضائع',
            'contacts' => 'وسائل التواصل',
            'suppliers' => 'الموردين',
            'offer_points' => 'عروض النقاط',
            'options'=>'أخرى',
            'directions'=>'الاتجاهات',
            'add_notifications'=>'اضافة اشعارات',
            'kinds_of_shops'=>'أنواع المحلات',
            'expenses'=>' المصروفات',
            'slider'=>'السلايدر',
            'best_selling_products'=>'المنتجات الاكثر مبيعا',
            'total_demand_for_products'=>'اجمالى الطلب على المنتجات',
            'income_generated_from_the_sale_of_products'=>'الدخل الناتج على بيع المنتجات',
            'revenues'=>'الايرادات',
            'the_credit_strenght_of_each_customer'=>'القوه الائتمانيه لكل عميل ',
            'edited_orders'=>'الطلبات المعدله',
            'min_prices'=>'اقل سعر طلب ',
            'activity_type'=>'أنواع الانشطة',
            'complaint_type'=>'انواع الشكاوى والمقترحات',
            'discount_type'=>'انواع الخصومات',
            'ads'=>'الصور الاعلانية',
            'coupons'=>'كوبونات الخصم',
            'mongez'=>'طلب فى السريع',
            'defult_mongez'=>'اعدادات طلب فى السريع',
        ];

        $maps = [
            'create' => 'انشاء',
            'read' => 'قراءه',
            'update' => 'تعديل',
            'delete' => 'حذف',
        ];

        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user', 'permissions', 'maps'));
    }


    public function update(Request $request, $id)
    {
        if ($request->all_permission)
        {
            $validator = Validator::make($request->all(),[
                'name' => 'required|string|max:100|unique:users,name' . ($id ? ",$id" : ''),
                'email' => 'required|email|max:100|unique:users,email' . ($id ? ",$id" : ''),
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return back()->with('errors', $errors);
            }

            $user = User::findOrFail($id);
            $user->update($request->all());

            $user->save();
            $all_permission = Permission::select('id')->get('id')->pluck('id');
            $user->attachPermissions($all_permission);

        }else{

            $validator = Validator::make($request->all(),[
                'name' => 'required|string|max:100|unique:users,name' . ($id ? ",$id" : ''),
                'email' => 'required|email|max:100|unique:users,email' . ($id ? ",$id" : ''),
                'permissions' => "required|array|min:1"
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return back()->with('errors', $errors);
            }

            $user = User::findOrFail($id);
            $user->update($request->all());
            $user->save();
            $user->syncPermissions($request->permissions);
        }

        session()->flash('success',' تم التعديل بنجاح ');

        return redirect('admin/users');
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if (is_null($user->store) && is_null($user->store_accountant)) {
            $user = User::destroy($id);
            return back();
        } else {
            return back()->withErrors('لا يمكن حذف المستخدم لانة مربوط بمخزن');
        }
    }

    public function status($id)
    {
        $users = User::findOrFail($id);
        $users->status = 1;
        $users->save();
        $SERVER_API_KEY = 'AAAALUzsKi4:APA91bEV9A-d9ri5jjPSa-W5FgjBahD9B3GwuqhrvcNcqSZ5N4m4tf0hFmoFogLEDlyGYdhL8-dagpbMsKBz2fvm2O0GhHkwpwS6G_g0DNR33a-32cjCxylTioGV9sBMC3jFith1V46u';

        $token_1 = $users->token;

        $data = [

            "registration_ids" => [
                $token_1
            ],
            "data" => ['type' => 'activition'],
            "notification" => [

                "title" => 'التفعيل',

                "body" => 'لقد تم تفعيلك بنجاح من قبل احد المسؤلين',

                "sound" => "default",// required for sound on ios

                "image" => asset('images/logo.png'),

                "click_action"=> "FLUTTER_NOTIFICATION_CLICK"

            ],

        ];

        $dataString = json_encode($data);

        $headers = [

            'Authorization: key=' . $SERVER_API_KEY,

            'Content-Type: application/json',

        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');

        curl_setopt($ch, CURLOPT_POST, true);

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);
        session()->flash('success',' تم التفعيل بنجاح ');

        return redirect('admin/clients');
    }

    public function block($id)
    {
        $users = User::findOrFail($id);
        $users->status = 2;
        $users->save();
        session()->flash('success',' تم ايقاف التفعيل بنجاح ');
        return redirect('admin/clients');
    }

    /*
     * Create Users For Direct Sell
     */
    public function createClient()
    {
        $places = Place::all();
        $shope_types=Shop_Type::all();
        return view('admin.users.create_client', compact('places','shope_types'));
    }

    /*
     * Store Users For Direct Sell
     */
    public function storeClient(Request $request)
    {
        $request['id'] = (int)$request->number;

        $validator = Validator::make($request->all(), [
            'id' => "unique:users",
            'name' => "required",
            'shop_name' => "required",
            'shop_type' => "required",
            'address' => "required",
            'place_id' => "required"
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }

        $user = new User($request->all());
        $user->id = $request->id;
        $user->adder_id = Auth::user()->id;
        $user->save();
        $user->attachRole('user');
        session()->flash('success',' تمت الأضافة بنجاح ');

        if (!empty(Auth::user()->store()->get()->first())) {
            return redirect(route('store_keeper.show_store'));
        } else {
            return redirect('admin/clients');
        }
    }

    public function createNotification(){
        $products = Product::all();
        return view('admin.users.create_notification', compact('products'));
    }

    public function storeNotification(Request $request){
        $validator = Validator::make($request->all(), [
            'title'  =>  'required',
            'description'  =>  'required',
            'product_id'  =>  'required',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }

        $product = Product::with('productImages')->findOrFail($request->product_id);

        $users = User::all();
        $SERVER_API_KEY = 'AAAALUzsKi4:APA91bEV9A-d9ri5jjPSa-W5FgjBahD9B3GwuqhrvcNcqSZ5N4m4tf0hFmoFogLEDlyGYdhL8-dagpbMsKBz2fvm2O0GhHkwpwS6G_g0DNR33a-32cjCxylTioGV9sBMC3jFith1V46u';

        foreach ($users as $user)
        {
            $token_1 = $user->token;

            $data = [

                "registration_ids" => [
                    $token_1
                ],
                "data" => [
                    'type' => 'product',
                    'productData' => json_encode($product),
                ],

                "notification" => [

                    "title" => $request->title,

                    "body" => $request->description,

                    "sound" => "default",// required for sound on ios


                    "image" =>asset('uploads/products/'.$product -> image),

                    "click_action"=> "FLUTTER_NOTIFICATION_CLICK"

                ],

            ];

            $dataString = json_encode($data);

            $headers = [

                'Authorization: key=' . $SERVER_API_KEY,

                'Content-Type: application/json',

            ];

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');

            curl_setopt($ch, CURLOPT_POST, true);

            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

            $response = curl_exec($ch);
        }

        session()->flash('success',' تمت الارسال بنجاح بنجاح ');

        return redirect('admin');
    }
}
