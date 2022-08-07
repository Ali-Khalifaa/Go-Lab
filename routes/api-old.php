<?php

use App\Http\Controllers\api\users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:man')->get('/mandobs', function (Request $request) {
    return $request->mandobs();
});
Config::set('auth.man', App\Mandob::class);
Route::post('register', 'api\users@register');
Route::post('login', 'api\users@login');
Route::post('mandob/signin','api\mandobs@signIn');



Route::apiResources(['categories' => 'api\categories']);
Route::get('categories/{category}/get_subcategories','api\categories@getSubCategories');
Route::get('products/company/{company}/subcategory/{subcategory}/store/{store}','api\products@getProductsByCompanySubCategoryStore');
Route::get('products/company/{company}/store/{store}','api\products@getProductsByCompany');
Route::get('productsV1/company/{company}/subcategory/{subcategory}/store/{store}','api\products@getProductsByCompanySubCategoryStoreApple');

Route::get('products/company/{company}/category/{category}/store/{store}','api\products@getProductsByCompanyCategoryStore');
Route::get('companies/{company}/get_available_categories','api\categories@getAvailableCategories');
Route::get('companies/{company}/get_available_sub_categories','api\subcategories@getAvailableSubCategories');
Route::get('sub_categories/{sub_category}/get_available_companies','api\subcategories@getAvailableCompanies');


Route::get('options','api\products@options');

Route::apiResources(['places' => 'api\places']);
//Route::apiResources(['options' => 'api\options']);
Route::apiResources(['orders' => 'api\orders']);
Route::apiResources(['packages' => 'api\Packages']);
Route::apiResources(['subcategories' => 'api\subcategories']);
Route::apiResources(['products' => 'api\products']);
Route::apiResources(['companies' => 'api\companies']);
Route::apiResources(['previousorders' => 'api\previousorders']);
Route::apiResources(['companysubcategory' => 'api\companysubcategory']);
Route::apiResources(['complaints' => 'api\complaints']);
Route::apiResources(['complaintsproducts' => 'api\complaintsproducts']);
Route::apiResources(['users' => 'api\users']);
Route::post('users/signin',[users::class,'signIn']);
Route::post('users/{user}/upload_image',[users::class,'userUploadImage']);
Route::post('users/change_password/{user}',[users::class,'userChangePassword']);
Route::get('users/{user_id}/get_token_last_updated_in_days',[users::class,'calculateTokenLastUpdatedDate']);

Route::apiResources(['sliders' => 'api\sliders']);
Route::get('sliders/category/{category_id}', 'api\sliders@getByCategory');

Route::apiResources(['discounts' => 'api\discounts']);
Route::apiResources(['contacts' => 'api\contacts']);
Route::apiResources(['min_prices' => 'api\min_prices']);
Route::apiResources(['mandobs' => 'api\mandobs']);
Route::apiResources(['deliveries' => 'api\deliveries']);
//Route::apiResources(['stores' => 'api\stores']);
Route::apiResources(['depts' => 'api\depts']);
// Route::get('/api/users/{id}', 'api\users@show');
Route::put('mostproducts', 'api\mostproducts@update');
Route::put('orders', 'api\orders@update');
Route::put('users', 'api\users@update');
Route::get('get_shop_type', 'api\users@getShopType');
Route::put('products', 'api\products@update');
Route::delete('orders/{id}', 'api\orders@destroy');
Route::get('orders/user/{id}', 'api\orders@show');
Route::get('orders/check_notify/{id}', 'api\orders@checkNotifyOrder');
//Route::get('orders/{id}', 'api\orders@show');
Route::get('stages', 'api\orders@getAllStages');
Route::post('orders/{id}/complete', 'api\orders@completeOrder');
Route::get('orders/user_depts/{id}', 'api\orders@userDepts');
Route::post ('orders/{id}/deliver', 'api\orders@deliverOrder');
Route::get ('orders/{id}/confirm', 'api\orders@confirmOrder');
Route::get ('orders/{id}/see_bill', 'api\orders@seeBill');
Route::post ('orders/{id}/rate_mandob', 'api\orders@rateMandob');
Route::post ('orders/{id}/rate_user', 'api\orders@rateUser');
Route::get ('transfers/mandobs/{id}', 'api\orders@getTransfers');



Route::get('user/{id}/orders/{is_complete?}', 'api\orders@getOrdersByUser');
Route::get('user/wallet/{id}', 'api\orders@userWallet');
Route::get('products/{id}', 'api\products@show');
Route::get('users/{id}', 'api\users@show');
Route::post('users/getname', 'api\users@search');
Route::get('offers', 'api\products@offers');
Route::get('stores', 'api\stores@index');
Route::get('stores/{id}', 'api\stores@getByPlace');



Route::get('products/store/{store_id}/company/{company_id}', 'api\products@getProducts');
Route::get('products/store/{store_id}/user/{user_id}', 'api\products@getStoreProducts');
// Route::get('productsV1/store/{store_id}/user/{user_id}', 'api\products@getStoreProductsV1');
// Route::get('productsApple', 'api\products@getStoreProductsApple');



Route::get('productsV1/store/{store_id}/user/{user_id}/{serach}', 'api\products@getStoreProductsV1');
Route::get('productsV1/store/{store_id}', 'api\products@storeNotify');

Route::get('productsV1', 'api\products@getStoreProductsApple');

Route::get('mostproducts/{store}', 'api\mostproducts@index');
Route::get('mostproductsV1/{store}', 'api\mostproducts@indexApple');



/*
 * Mandob Routes
 */
Route::post('mandob/signin','api\mandobs@signIn');
Route::get('mandob/orders/{mandob_id}', 'api\mandobs@getOrders');
Route::get('mandob/orders/{mandob_id}/receive/{order_id}', 'api\mandobs@receiveOrder');
Route::get('mandob/orders/{mandob_id}/deliver/{order_id}', 'api\mandobs@deliverOrder');
Route::get('mandob/backorders/{mandob_id}', 'api\mandobs@getBackOrders');
Route::get('mandob/backorders/{mandob_id}/deliver/{order_id}/paid/{paid}', 'api\mandobs@deliverBackOrder');
Route::get('mandob/complete-orders/{mandob_id}/deliver/{order_id}/paid/{paid}', 'api\mandobs@deliverReceivedMoneyFromOrder');


Route::post('orders/{id}/mandobs', 'api\orders@mandobOrderStatus');


// Route::get('productsV1/company/{company}/subcategory/{subcategory}/store/{store}','api\products@getProductsByCompanySubCategoryStoreApple');
// Route::get('products/company/{company}/store/{store}','api\products@getProductsByCompany');
// Route::get('productsV1/store/{store_id}/user/{user_id}/{serach}', 'api\products@getStoreProductsV1');
// Route::get('productsV1/store/{store_id}', 'api\products@storeNotify');
// Route::get('productsV1', 'api\products@getStoreProductsApple');
// Route::get('mostproductsV1/{store}', 'api\mostproducts@indexApple');
