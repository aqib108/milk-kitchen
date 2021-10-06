<?php

use App\Http\Controllers\DistributorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;


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
Route::get('/migrate',function(){
    $data = Artisan::call('migrate');
    dd($data);
});
Route::get('/cache-clear', function(){
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/permission','RoleManagementController@permission');
    Route::get('/super','RoleManagementController@assign');

    Route::group(['prefix' => 'admin'], function (){
        Route::get('/', 'AdminController@index')->name('dashboard');
        
        Route::get('/manage-dashboard', 'AdminController@mangeDashBoard')->name('manage.dashboard');
        Route::get('/masterPicklist', 'AdminController@masterPicklist')->name('masterPicklist');
        Route::post('/getmasterPicklist','AdminController@getmasterPicklist')->name('getmasterPicklist');
        Route::get('/runPicklist','AdminController@runPicklist')->name('runPicklist');  
        Route::get('/getWarehouses','UserManagementController@getWarehouses')->name('getWarehouses');  
        Route::post('/getrunPicklist','AdminController@getrunPicklist')->name('getrunPicklist');  
        Route::group(['as' => 'admin.'], function () {
            Route::match(['get', 'post'], '/setting', 'AdminController@setting')->name('setting');
            Route::get('/reset-password', 'AdminController@resetPassword')->name('reset-password');
            Route::post('/check-password', 'AdminController@checkPassword')->name('check-password');
            Route::post('/update-password', 'AdminController@updatePassword')->name('update-password');
        });
        Route::group(['prefix' => 'users'], function (){
            Route::post('/checkEmail','UserManagementController@checkEmail')->name('user.checkEmail');
            Route::get('/','UserManagementController@users')->name('user.index');
            Route::get('/create','UserManagementController@addNewUser')->name('user.create');
            Route::post('/store','UserManagementController@createNewUser')->name('user.store');;
            Route::get('/edit/{id}','UserManagementController@editUser')->name('user.edit');
            Route::post('/update/{id}','UserManagementController@updateUser')->name('user.update');
            Route::post('/status', 'UserManagementController@status')->name('user.status');
        });
        Route::group(['prefix' => 'permissions'], function (){
            Route::get('/','UserManagementController@permissions')->name('permission.index');
            Route::post('/store','UserManagementController@createPermission')->name('permission.store');
            Route::get('/edit/{id}','UserManagementController@editPermission')->name('permission.edit');
            Route::post('/update/{id}','UserManagementController@updatePermission')->name('permission.update');
            Route::delete('/delete/{id}', 'UserManagementController@deletePermission');
        });
        Route::group(['prefix' => 'roles'], function (){
            Route::get('/','UserManagementController@roles')->name('role.index');
            Route::post('/store','UserManagementController@createRole')->name('role.store');
            Route::get('/edit/{id}','UserManagementController@editRole')->name('role.edit');
            Route::post('/update/{id}','UserManagementController@updateRoles')->name('role.update');
            Route::delete('/delete/{id}','UserManagementController@deleteRole');
        });
        Route::group(['prefix' => 'customer'], function (){
            Route::post('/checkEmail','CustomerController@checkEmail')->name('customer.checkEmail');
            Route::get('/','CustomerController@customers')->name('customer.index');
            Route::get('/create','CustomerController@newCustomerCreate')->name('customer.newCustomerCreate');
            Route::post('/store','CustomerController@createCustomer')->name('customer.store');
            Route::get('/view/{id}','CustomerController@viewCustomer')->name('customer.customerView');
            Route::get('/edit/{id}','CustomerController@editCustomer')->name('customer.customerEdit');
            Route::post('/update/{id}','CustomerController@updateCustomer')->name('customer.update');
            Route::get('/report','CustomerController@customerReport')->name('customer.customerReport');
            Route::delete('/customerDelete/{id}','CustomerController@deleteCustomer');
            Route::get('/customerReport','CustomerController@reports')->name('customer.customer-report');
            Route::get('generate-pdf/{id}', 'CustomerController@generatePDF');
            Route::post('/product-admin-orders/{id}','CustomerController@productOrderAdmin')->name('admin.customer-orders');
            Route::get('/past-orders/{id}','CustomerController@pastOrder')->name('customer.past-orders');
            Route::get('/packing-slip','CustomerController@packingslip')->name('customer.packing-slip');
            Route::get('/final-report/{id}','CustomerController@finalreport')->name('customer.final-report');
            Route::get('/statement/{id}','CustomerController@pastOrderStatement')->name('customer.week-statement');
            Route::post('/edit-delivery-orders/{id}','CustomerController@editDeliveryOrders')->name('customer.edit-delivery-orders');
            Route::get('/statement/pdf/{id}', 'CustomerController@statementPrint')->name('customer.statementPdf');
        });
        Route::group(['prefix' => 'customer-group'], function (){

            Route::get('/','CustomerGroupController@customerGroup')->name('customer-group.index');
            Route::post('/store','CustomerGroupController@store')->name('customer-group.storeGroup');
            Route::post('/status','CustomerGroupController@status')->name('customer-group.groupStatus');
            Route::delete('/delete/{id}','CustomerGroupController@delete');
            Route::get('/edit/{id}','CustomerGroupController@editGroup');
            Route::post('/update/{id}','CustomerGroupController@updateGroup');
        });
        Route::group(['prefix' => 'warehouse'], function (){
            Route::get('/','WareHouseController@index')->name('warehouse.index');
            Route::post('/store','WareHouseController@store')->name('warehouse.store');
            Route::get('/edit/{id}','WareHouseController@edit')->name('warehouse.edit');
            Route::post('/update/{id}','WareHouseController@update')->name('warehouse.update');
            Route::post('/status','WareHouseController@status')->name('warehouse.status');
            Route::get('/getWarehouse','WareHouseController@getWarehouse')->name('warehouse.getdata');
            Route::delete('/delete/{id}','WareHouseController@destroy');
        });
        Route::resource('region','RegionController');
        Route::delete('region/delete/{id}','RegionController@destroy');
        Route::post('/regionstatus','RegionController@regionstatus')->name('region.status');
        Route::get('/getRegion','RegionController@getRegion')->name('region.getdata');

        Route::resource('zone','ZoneController');
        Route::post('/zonestatus','ZoneController@zonestatus')->name('zone.status');
        Route::delete('zone/delete/{id}','ZoneController@destroy');
        Route::get('/getZone','ZoneController@getZone')->name('zone.getdata');
        Route::get('/shedule','ZoneController@sheduleZone')->name('zone.shedule');
        Route::post('/sheduleChange','ZoneController@sheduleChange')->name('zone.sheduleChange');
        
        Route::group(['prefix' => 'product'], function (){
            Route::get('/','ProductController@index')->name('product.index');
            Route::get('/create','ProductController@create')->name('product.create');
            Route::post('/store','ProductController@store')->name('product.store');
            Route::get('/edit/{id}','ProductController@edit')->name('product.edit');
            Route::get('/detail/{id}','ProductController@show')->name('product.detail');
            Route::post('/update/{id}','ProductController@update')->name('product.update');
            Route::post('/status','ProductController@status')->name('product.status');
            Route::post('/delete','ProductController@destroy')->name('product.destroy');
        });
        Route::group(['prefix' => 'attributes'], function (){
            Route::get('/','AttributesController@index')->name('attribute.index');
            Route::get('/create','AttributesController@create')->name('attribute.create');
            Route::post('/store','AttributesController@store')->name('attribute.store');
            Route::get('/edit/{id}','AttributesController@edit')->name('attribute.edit');
            Route::post('/update/{id}','AttributesController@update')->name('attribute.update');
            Route::post('/status','AttributesController@status')->name('attribute.status');
            Route::post('/delete','AttributesController@destroy')->name('attribute.destroy');
        });
        Route::group(['prefix' => 'order'], function (){
            Route::get('/','OrderController@index')->name('order.index');
            Route::get('/detail/{id}','OrderController@show')->name('order.detail');
        });
        Route::group(['prefix' => 'sale'], function (){
            Route::get('/','SaleController@reoccurring')->name('sale.index');
        });
    });

    Route::group(['prefix' => 'home'], function () {
        Route::get('/', 'HomeController@index')->name('index');
        Route::resource('customer-detail','CustomerDetailController');
        Route::get('/past/order/{id}','HomeController@pastOrder')->name('customer.pastOrder');
        Route::post('/product-orders','HomeController@productOrders');
        Route::get('/customer-delivery-details','HomeController@deliveryDetails')->name('customer.deliveryDetails');
    }); 
});
//// GENERAL ROUTES
Route::post('/get-regions','HomeController@getState')->name('getRegions');
Route::post('/get-cities','HomeController@getCity')->name('getCitiesByRegion');
Route::get('/', 'HomeController@index');
Auth::routes();