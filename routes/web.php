<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/config-cache', function() {
//     $exitCode = Artisan::call('opti');
//     // return what you want
//     return 'config-cache';
// });

Route::post('/admin/searchInEditProd','admin\stores@search');
Route::get('/getsub/{id}','admin\stores@getSubProd');
Route::get('/prod-info/{id}/{store_id}','admin\stores@getProdInfo');
Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    Route::get('/passwords/{id}','HomeController@passwords');
    Route::post('/password/{id}','HomeController@password');
    Route::get('/admin', 'HomeController@index')->name('admin');
    Route::get('/admin/options', 'HomeController@option');
    Route::get('/admin/products/{product_id}/print_barcode', 'admin\products@printBarcode');
    Route::get('/admin/user/{user_id}/print_barcode', 'admin\users@printBarcode');
    Route::get('/admin/products/{product_id}/add_recently_arrived', 'admin\products@addRecentlyArrived');
    Route::get('/admin/products/{product_id}/remove_recently_arrived', 'admin\products@removeRecentlyArrived');
    // Route::get('/admin/searchInEditProd','admin\stores@search');

    Route::post('/admin/options/deactive/{id}', 'HomeController@deActiveOption');
    Route::post('/admin/options/active/{id}', 'HomeController@activeOption');

    Route::post('/admin/products/deactive/{id}', 'admin\products@deActiveProduct');
    Route::post('/admin/products/active/{id}', 'admin\products@activeProduct');

    Route::post('/admin/company/deactive/{id}', 'admin\companies@deActiveProduct');
    Route::post('/admin/company/active/{id}', 'admin\companies@activeProduct');

    Route::post('/admin/category/deactive/{id}', 'admin\categories@deActiveProduct');
    Route::post('/admin/category/active/{id}', 'admin\categories@activeProduct');

    Route::post('/admin/subcategory/deactive/{id}', 'admin\subcategories@deActiveProduct');
    Route::post('/admin/subcategory/active/{id}', 'admin\subcategories@activeProduct');
    Route::get('admin/invoices', 'admin\orders@indexOfInvoices');
    Route::get('admin/report_net_profit_invoices', 'admin\orders@indexNetProfitOfInvoices');
    Route::get('admin/orders/create/invoices/{store_id}', 'admin\orders@createOfInvoices');

    /*
     * Super Admin
     */

    Route::resource('/admin/outgoings','admin\outgoings')->middleware('permission:read-expenses');
    Route::get('/admin/outgoings_item/create/{id}','admin\outgoings@createItem')->middleware('permission:read-expenses');
    Route::post('/admin/outgoings_item/store/{id}','admin\outgoings@storeItem');
    Route::resource('/admin/items','admin\items')->middleware('permission:read-expenses');
    Route::get('/admin/items/create/{id}','admin\items@create')->middleware('permission:read-expenses');
    Route::resource('/admin/ingoings','admin\ingoings')->middleware('permission:read-revenues');
    Route::get('/admin/ingoings_item/create/{id}','admin\ingoings@createItem')->middleware('permission:read-revenues');
    Route::post('/admin/ingoings_item/store/{id}','admin\ingoings@storeItem');
    Route::resource('/admin/in_items','admin\in_items')->middleware('permission:read-revenues');
    Route::get('/admin/in_items/create/{id}','admin\in_items@create')->middleware('permission:read-revenues');
    Route::resource('/admin/directions','admin\directions')->middleware('permission:read-places');
    Route::resource('/admin/companies','admin\companies')->middleware('permission:read-companies');
    Route::resource('/admin/mandoobs','admin\mandobs')->middleware('permission:read-mandobs');
    Route::resource('/admin/packages','admin\Packages');
    Route::resource('/admin/categories','admin\categories')->middleware('permission:read-categories');
    Route::resource('/admin/places','admin\places')->middleware('permission:read-places');
    Route::resource('/admin/receipt_statuses','admin\receipt_statuses')->middleware('permission:read-receipt_status');
    Route::resource('/admin/return_reasons','admin\return_reasons')->middleware('permission:read-return_reasons');
    Route::resource('/admin/subcategories','admin\subcategories')->middleware('permission:read-subcategories');
    Route::resource('/admin/products','admin\products')->middleware('permission:read-products');
    // product images routes
    Route::get('/admin/productImg/{id}', 'admin\ProductImgController@index')->name('productImg.index');
    Route::get('/admin/productImg/create/{id}', 'admin\ProductImgController@create')->name('productImg.create');
    Route::post('/admin/productImg/store', 'admin\ProductImgController@store')->name('productImg.store');
    Route::get('/admin/productImg/edit/{id}', 'admin\ProductImgController@edit')->name('productImg.edit');
    Route::put('/admin/productImg/update/{id}', 'admin\ProductImgController@update')->name('productImg.update');
    Route::delete('/admin/productImg/destroy/{id}', 'admin\ProductImgController@destroy')->name('productImg.destroy');

    // product discount routes
    Route::get('/admin/productDiscount/edit/{id}', 'admin\DiscountProductController@edit')->name('productDiscount.edit');
    Route::put('/admin/productDiscount/update/{id}', 'admin\DiscountProductController@update')->name('productDiscount.update');

    // company discount routes
    Route::get('/admin/companyDiscount/edit/{id}', 'admin\DiscountCompanyController@edit')->name('companyDiscount.edit');
    Route::put('/admin/companyDiscount/update/{id}', 'admin\DiscountCompanyController@update')->name('companyDiscount.update');

    Route::resource('/admin/mostproducts','admin\mostproducts')->middleware('permission:read-statistics');
    Route::resource('/admin/previousorders','admin\previousorders')->middleware('permission:read-statistics');
    Route::resource('/admin/complaints','admin\complaints')->middleware('permission:read-complaints');
    Route::resource('/admin/lockers','admin\lockers');
    Route::resource('/admin/complaintsproducts','admin\complaintsproducts')->middleware('permission:read-complaint_products');
    Route::resource('/admin/sliders','admin\sliders')->middleware('permission:read-sliders');
    Route::resource('/admin/shoptypes','admin\Shop_TypeController')->middleware('permission:read-sliders');
    Route::resource('/admin/discounts','admin\discounts')->middleware('permission:read-discounts');
    Route::resource('/admin/contacts','admin\contacts')->middleware('permission:read-contacts');
    Route::resource('/admin/activity-type','admin\ActivityType')->middleware('permission:read-activity_type');
    Route::resource('/admin/discount_type','admin\DiscountType')->middleware('permission:read-discount_type');
    Route::get('/admin/coupons/getUserByActivety/{id}', 'admin\CouponeController@getUserByActivety');
    Route::get('/admin/coupons/getAllUserBromoCode', 'admin\CouponeController@getAllUserBromoCode');
    Route::get('/admin/coupons/getAllUserDate', 'admin\CouponeController@getAllUserDate');
    Route::get('/admin/coupons/getUserByOrder', 'admin\CouponeController@getUserByOrder');
    Route::resource('/admin/coupons','admin\CouponeController')->middleware('permission:read-coupons');
    Route::post('/admin/coupons/notification','admin\CouponeController@notification')->name('coupons.notification');

    Route::resource('/admin/ads','admin\ads')->middleware('permission:read-ads');

    Route::resource('/admin/mongez','admin\MongezController')->middleware('permission:read-mongez');

    Route::resource('/admin/defult_mongez','admin\DefultMongezController')->middleware('permission:read-defult_mongez');

    Route::resource('/admin/contact_message','admin\ContactMessage')->middleware('permission:read-complaints');


    Route::resource('/admin/complaint_type','admin\ComplaintType')->middleware('permission:read-complaint_type');


    Route::resource('/admin/users','admin\users')->middleware('permission:read-users');

    Route::get('/admin/min-price','admin\orders@indexOfMinPrice');
    Route::post('/admin/min-price/change','admin\orders@changeMinPrice');
    Route::get('/admin/orders/create/{id}','admin\orders@create')->middleware('permission:read-orders');
    Route::get('/admin/store-kepers','admin\users@indexOfStoreKepper')->middleware('permission:read-users');
    Route::get('/admin/finance_manager','admin\users@indexOfFinanceManager')->middleware('permission:read-users');
    Route::get('/admin/finance_managers-reports','admin\users@ReportOfFinanceManager')->middleware('permission:read-reports');
    Route::get('/admin/seller-reports','admin\users@ReportOfSeller')->middleware('permission:read-reports');
    Route::get('/admin/keeper-reports','admin\users@ReportOfKeeper')->middleware('permission:read-reports');
    Route::get('/admin/manager-reports','admin\users@ReportOfManager')->middleware('permission:read-reports');
    Route::get('/admin/manager','admin\users@indexOfManager')->middleware('permission:read-users');
    Route::get('/admin/seller','admin\users@indexOfSeller')->middleware('permission:read-users');

    Route::resource('/admin/clients','admin\clients')->middleware('permission:read-clients');
    Route::get('/admin/clients/orders/{id}','admin\clients@userOreders')->middleware('permission:read-clients');
    Route::resource('/admin/suppliers','admin\suppliers')->middleware('permission:read-suppliers');
    Route::resource('/admin/offer_points','admin\offerpoints')->middleware('permission:read-offer_points');
    Route::get('/admin/users/status/{id}', 'admin\users@status')->middleware('permission:update-users');
    Route::get('/admin/users/block/{id}', 'admin\users@block')->middleware('permission:update-users');
    Route::get('/admin/mandoobs/status/{id}', 'admin\mandobs@status')->middleware('permission:update-mandobs');
    Route::get('/admin/mandoobs/block/{id}', 'admin\mandobs@block')->middleware('permission:update-mandobs');
    Route::get('/admin/direct_sells', 'admin\orders@directSells')->middleware('permission:read-direct_sells');


    // User Notifies
    Route::resource('/admin/user_notifies','admin\user_notifies')->middleware('permission:read-notify_users');
    Route::get('/admin/select_create/user_notifies','admin\user_notifies@selectToCreate')->middleware('permission:update-notify_users');

    // Notifies

    Route::get('/admin/stores/create_notify/{store}', 'admin\stores@createNotify')->middleware('permission:create-notifies');
    Route::get('/admin/stores/create_notify_total/{store}', 'admin\stores@createNotifyTotal')->middleware('permission:create-notifies');
    Route::get('/admin/global_notify', 'admin\stores@indexGlobalNotify')->middleware('permission:read-notifies');
    Route::get('/admin/create_global_notify', 'admin\stores@createGlobalNotify')->middleware('permission:create-notifies');
    Route::post('/admin/global_notify', 'admin\stores@storeGlobalNotify')->middleware('permission:create-notifies');
    Route::get('/admin/edit_global_notify', 'admin\stores@editGlobalNotify')->middleware('permission:update-notifies');
    Route::put('/admin/update_global_notify', 'admin\stores@updateGlobalNotify')->middleware('permission:update-notifies');
    Route::delete('/admin/delete_global_notify', 'admin\stores@deleteGlobalNotify')->middleware('permission:delete-notifies');
    Route::get('/admin/stores/edit_notify/{notify}', 'admin\stores@editNotify')->middleware('permission:update-notifies');
    Route::get('/admin/stores/edit_notify_total/{notify_total}', 'admin\stores@editNotifyTotal')->middleware('permission:update-notifies');
    Route::put('/admin/stores/update_notify/{notify}', 'admin\stores@updateNotify')->middleware('permission:update-notifies');
    Route::put('/admin/stores/update_notify_total/{notify_total}', 'admin\stores@updateNotifyTotal')->middleware('permission:update-notifies');
    Route::get('/admin/stores/delete_notify/{notify}', 'admin\stores@deleteNotify')->middleware('permission:delete-notifies');
    Route::get('/admin/stores/delete_notify_total/{notify_total}', 'admin\stores@deleteNotifyTotal')->middleware('permission:delete-notifies');
    Route::post('/admin/stores/store_notify', 'admin\stores@storeNotify')->middleware('permission:create-notifies');
    Route::post('/admin/stores/store_notify_total', 'admin\stores@storeNotifyTotal')->middleware('permission:create-notifies');



    /*
     * Super Admin & Supervisor
     */
    Route::resource('/admin/stores','admin\stores')->middleware('permission:read-stores');
    Route::get('/admin/store/{store}/store_keepers','admin\stores@getStoreKeepers')->middleware('permission:read-stores');
    Route::get('/admin/store_keeper/{user}/edit_products','admin\stores@editKeeperProducts')->name('store_keeper.edit_products')->middleware('permission:read-stores');
    Route::post('/admin/store_keeper/{user}/store_products','admin\stores@storeKeeperProducts')->name('store_keeper.store_products')->middleware('permission:read-stores');
    Route::get('/admin/store/examination_units/{user}','admin\stores@storeExaminationUnits')->middleware('permission:read-stores');
    Route::get('/admin/store/examination_units/{examination_unit}/receive','admin\stores@receiveExamination')->name('store_keeper.receive_unit')->middleware('permission:read-stores');

    Route::get('/admin/store/finance/mandobs/{store}','admin\finances@getFinanceMandobs')->name('store.finance_mandobs')->middleware('permission:read-stores');
    Route::get('/admin/store/{store}/finance_out/','admin\finances@getOutStore')->name('store.finance_out')->middleware('permission:read-stores');
    Route::get('/admin/stores/product_needed/{id}', 'admin\orders@needed');
    Route::get('/admin/finance/confirm_out/{item}','admin\finances@confirmOut')->name('finance.confirm_out')->middleware('permission:read-stores');
    Route::get('/admin/store/{store}/finance_in/','admin\finances@getInStore')->name('store.finance_in')->middleware('permission:read-stores');
    Route::get('/admin/finance/confirm_in/{in_item}','admin\finances@confirmIn')->name('finance.confirm_in')->middleware('permission:read-stores');
    Route::get('/admin/store/{store}/finance/mandobs/{mandob}','admin\finances@mandob_zero')->name('finance.mandob_zero')->middleware('permission:read-stores');
//    Route::resource('/admin/stores','admin\stores')->middleware('permission:read-stores');

    Route::resource('/admin/orders','admin\orders')->middleware('permission:read-orders');
    Route::get('/admin/orders-report','admin\orders@orderReport')->middleware('permission:read-orders');
    Route::get('/admin/orders-with-recalls','admin\orders@ordersWithRecalls')->middleware('permission:read-orders');

    Route::get('/admin/mandob-orders/{id}','admin\orders@indexOfMandopsOrder')->middleware('permission:read-orders');
    Route::get('/admin/confirm_received_money/{id}','admin\orders@confirmReceivedMoneyOfOrder');
    Route::get('/admin/confirm_direct_sell_received_money/{id}','admin\orders@confirmReceivedMoneyOfDirectSellOrder');

    Route::get('/admin/online-orders-of-finance_managers/{id}','admin\orders@indexOfOrderOfFinance_managers');
    Route::get('/admin/online-orders-of-seller/{id}','admin\orders@indexOfOrderOfSeller');
    Route::get('/admin/online-orders-of-keeper/{id}','admin\orders@indexOfOrderOfKeeper');
    Route::get('/admin/direct-sell-orders-of-finance_managers/{id}','admin\orders@indexOfDirectSellOrderOfFinance_managers');
    Route::get('/admin/direct-selle-of-seller/{id}','admin\orders@indexOfDirectSellOrderOfSeller');
    Route::get('/admin/direct-selle-of-keeper/{id}','admin\orders@indexOfDirectSellOrderOfKeeper');


    Route::post('/admin/confirm_received_money/{id}','admin\orders@yesConfirmReceivedMoneyOfOrder');
    Route::get('/admin/confirm_delivery_receipt/{id}','admin\orders@yesConfirmDeliveryReceiptOfOrder');
    Route::get('/admin/direct_selle_confirm_delivery_receipt/{id}','admin\orders@yesConfirmDirectSelleDeliveryReceiptOfOrder');
    Route::post('/admin/confirm_direct_sell_received_money/{id}','admin\orders@yesConfirmReceivedMoneyOfDirectSellOrder');
    Route::resource('/admin/depts','admin\depts')->middleware('permission:read-depts');
    Route::get('/admin/user_depts/{user_id}','admin\depts@userDept');
    Route::get('/admin/totals/in_out_total', 'admin\statistics@getTotalInOut')->middleware('permission:read-statistics');
    Route::get('/admin/totals/order_product_total', 'admin\statistics@getTotalOrderProduct')->middleware('permission:read-statistics');
    Route::get('/admin/totals/income_product_total', 'admin\statistics@getIncomeProductTotal')->middleware('permission:read-statistics');
    Route::get('/admin/totals/paid_users_total', 'admin\statistics@getTotalPaidUsers')->middleware('permission:read-statistics');
    Route::get('/admin/totals/income_store_total/{id}', 'admin\statistics@getTotalIncomeStore')->middleware('permission:read-statistics');

    /*
     * Super_admin & Store_Keeper & Accountant & Supervisor
     */
    Route::get('/admin/orders/show/{order_id}', 'admin\orders@show')->middleware('permission:read-orders');;
    //see bill
    Route::get('/admin/store/see_bill/{order_id}','admin\store_keepers@seeBill')->name('seeBill')->middleware('permission:read-orders');;
    /*
     * Super_admin & Store_Keeper & Accountant
     */

    // Create Client
    Route::get('/admin/create_client','admin\users@createClient')->middleware('permission:create-clients');
    Route::get('/admin/create_notification','admin\users@createNotification')->middleware('role:super_administrator');
    Route::post('/admin/store_client','admin\users@storeClient')->name('store_client.store')->middleware('permission:create-clients');
    Route::post('/admin/store_notification','admin\users@storeNotification')->name('store_notification.store')->middleware('role:super_administrator');

    /*
     * Super_admin & Accountant
     */
    Route::get('/admin/stores/product_info/{store}', 'admin\stores@editProductsInfo')->middleware('permission:update-infos');
    Route::post('/admin/stores/product_info/{store}', 'admin\stores@updateProductsInfo')->middleware('permission:update-infos');
    /*
     * Store_Keeper & Accountant
     */
    // Store
    Route::get('/admin/show/store', 'admin\store_keepers@showStore')->name('store_keeper.show_store')->middleware('permission:read-stores');
    Route::get('/admin/examinations/', 'admin\store_keepers@index')->name('examinations.index')->middleware('permission:read-examinations');
    Route::get('/admin/examination-of-finance_managers/{id}', 'admin\store_keepers@indexOfExaminationOfFinance_managers')->middleware('permission:read-examinations');
    Route::get('/admin/examination-of-seller/{id}', 'admin\store_keepers@indexOfExaminationOfSeller')->middleware('permission:read-examinations');
    Route::get('/admin/examination-of-manager/{id}', 'admin\store_keepers@indexOfExaminationOfManager')->middleware('permission:read-examinations');
    Route::get('/admin/examination-of-keeper/{id}', 'admin\store_keepers@indexOfExaminationOfKeeper')->middleware('permission:read-examinations');

    Route::get('/admin/store/transfers', 'admin\store_keepers@getTransfers')->name('get_transfers')->middleware('permission:read-transfers');
    Route::get('/admin/store/orders', 'admin\store_keepers@getOrders')->name('get_orders')->middleware('permission:read-orders');
    Route::get('/admin/store/supplier_depts/{store}', 'admin\store_keepers@getSupplierDepts')->name('get_supplier_depts');
    Route::get('/admin/supplier_depts','admin\store_keepers@supplierDepts');
    Route::get('/admin/supplier_depts/{supplier_id}','admin\store_keepers@supplierDeptsById');
    Route::get('/admin/supplier_depts/{dept_id}/edit','admin\store_keepers@editSupplierDepts');
    Route::post('/admin/supplier_depts/{supplier_id}','admin\store_keepers@updateSupplierDepts');


    Route::get('/admin/produts_expiration','admin\store_keepers@expiration');



    Route::get('/admin/store/supplier_depts/{store}/settle/{supplier_dept}', 'admin\store_keepers@settleDept')->name('supplier_depts_settle');


    Route::post('/is_paid', 'admin\store_keepers@is_paid')->name('is_paid');
    Route::post('/is_recived', 'admin\store_keepers@is_recived')->name('is_recived');
    Route::post('/is-recived/{id}/{keeper_id}', 'admin\store_keepers@AddExaminationQuantitiesToInfo')->name('is_recived_from_keeper');

    /*
     * Store Keeper
     */
    // Store_keeper [Examination & view store]
    Route::get('/admin/examinations/create', 'admin\store_keepers@createExamination')->name('examinations.create')->middleware('permission:create-examinations');
    Route::post('/admin/examinations/create-step-2', 'admin\store_keepers@createStepTwoExamination')->name('examinations.create_step_two')->middleware('permission:create-examinations');
    Route::post('/admin/examinations/store', 'admin\store_keepers@storeExamination')->name('examinations.store')->middleware('permission:create-examinations');
    Route::get('/admin/examination/{id}/bill', 'admin\store_keepers@makeExaminationOutBill');
    Route::get('/admin/examination/{id}/fatora', 'admin\store_keepers@showFatora');
    Route::get('/admin/store/create_transfer', 'admin\store_keepers@createTransfer')->name('create_transfer')->middleware('permission:create-transfers');
    Route::post('/admin/store/create_transfer', 'admin\store_keepers@storeTransfer')->name('store_transfer')->middleware('permission:create-transfers');
    Route::get('/admin/store/out_transfer/{id}', 'admin\store_keepers@outTransfer')->name('out_transfer')->middleware('permission:create-transfers');
    Route::get('/admin/store/in_transfer/{id}', 'admin\store_keepers@inTransfer')->name('in_transfer')->middleware('permission:create-transfers');
    Route::get('/admin/orders/{id}/bill', 'admin\orders@makeOutPermission')->middleware('permission:create-orders');
    Route::get('/admin/orders/{id}/fatora', 'admin\orders@showFatora')->middleware('permission:create-orders');

    Route::get('admin/orders/store/select/{id}', 'admin\orders@selectStore')->middleware('permission:update-stores');
    Route::post('admin/orders/store/post_select', 'admin\orders@postSelect')->name('orders.select')->middleware('permission:update-stores');

    Route::get('/admin/orders/{id}/track', 'admin\orders@tracks')->middleware('permission:update-orders');
    Route::get('/admin/orders/{order_id}/stage/{stage_id}', 'admin\orders@changeStage');
    Route::get('/admin/orders/cancel/{order_id}', 'admin\orders@cancelOrder');
    Route::post('/admin/orders/{id}/{user_id}/track', 'admin\orders@track')->middleware('permission:update-orders');
    Route::get('/admin/orders/{id}/mandobs', 'admin\orders@mandobs')->middleware('permission:update-orders');
    Route::get('/admin/store/switch', 'admin\store_keepers@preShift')->middleware('permission:read-stores');
    Route::post('/admin/store/switch', 'admin\store_keepers@shift')->middleware('permission:read-stores');
    Route::get('/admin/store/receive', 'admin\store_keepers@receive')->middleware('permission:read-stores');
    Route::get('/admin/store/switch_finance', 'admin\store_keepers@preShift_finance')->middleware('permission:read-stores');
    Route::post('/admin/store/switch_finance', 'admin\store_keepers@shift_finance')->middleware('permission:read-stores');
    Route::get('/admin/store/receive_finance', 'admin\store_keepers@receive_finance')->middleware('permission:read-stores');
    Route::get('/admin/stores/shift_logs/{store}', 'admin\stores@getShiftLogs')->middleware('permission:read-statistics');
    Route::get('/admin/stores/shift_finance_logs/{store}', 'admin\stores@getShiftFinanceLogs')->middleware('permission:read-statistics');
    Route::post('/admin/orders/{id}/set_mandob', 'admin\orders@mandob')->middleware('permission:update-orders');

    // Direct Sell
    Route::get('/admin/store/direct_sell','admin\store_keepers@createSell')->name('createSell')->middleware('permission:create-direct_sells');
    Route::post('/admin/store/store_sell','admin\store_keepers@storeSell')->name('store_sell')->middleware('permission:create-direct_sells');
    Route::get('/admin/store/edit_sell/{id}','admin\store_keepers@editSell')->middleware('permission:update-direct_sells');
    Route::post('/admin/store/edit_sell/{id}/update','admin\store_keepers@updateSell')->middleware('permission:update-direct_sells');
    Route::get('/admin/edited_orders/','admin\store_keepers@editedOrders');
    Route::post('/admin/store/delete_sell/{id}','admin\store_keepers@deleteSell')->middleware('permission:delete-direct_sells');
    Route::get('/admin/store/complete_sell/{order_id}','admin\store_keepers@completeSell')->name('completeSell')->middleware('permission:create-direct_sells');
    Route::get('/admin/store/cancel_sell/{order_id}','admin\store_keepers@cancelSell')->name('cancelSell')->middleware('permission:create-direct_sells');
    Route::post('/admin/store/final_sell/{order_id}','admin\store_keepers@finalSell')->name('finalSell')->middleware('permission:create-direct_sells');







    Route::prefix('store')->group(function(){

        Route::get('/login', 'Auth\StoreLoginController@showLoginForm')->name('store.login');
        Route::get('/logout', 'Auth\StoreLoginController@logout')->name('store.logout');

        Route::get('/', 'Users\Store\StoreController@index')->name('store.dashboard');
        Route::post('/login', 'Auth\StoreLoginController@login')->name('store.login.submit');

        Route::group(['middleware' => ['store']], function () {

            Route::get('/', 'Users\Store\StoreController@index')->name('store.dashboard');
            Route::resource('/storecategories', 'stores\CategoriesController');
            Route::resource('/storesubcategories', 'stores\StoreSubcategoryController');
            Route::resource('/storeproducts', 'stores\StoreProductsController');
            //        Route::resource('/categories', 'stores\CategoriesController@index')->name('store.categories');
        });


    });
});
//download
Route::get('/download', 'admin\mandobs@getDownload')->name('download');
