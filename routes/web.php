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
Route::get('/autoload',function(){
    $data = Artisan::call('dump:autoload');
    dd("Autoloaded successfully");
});
Route::get('/storage-link',function(){
    $data = Artisan::call('storage:link');
    dd($data);
});
Route::get('/version',function(){
    $data = Artisan::call('--version');
    dd($data);
});

Route::get('/cache-clear', function(){
    // Artisan::call('cache:clear');
    // Artisan::call('route:clear');
    // $data =Artisan::call('view:clear');
    dd("jkdxkj");
});

Route::get('/every-day', function(){
    Artisan::call('assign_driver_status');
});
Route::get('/duepayments', function(){
    Artisan::call('duepayments');
});
Route::get('/weekend', function(){
    $command = Artisan::call('weekly_standing_order');
    dd($command);
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/permission','RoleManagementController@permission');
    Route::get('/super','RoleManagementController@assign');

    Route::group(['prefix' => 'admin'], function (){
        Route::get('/', 'AdminController@index')->name('dashboard');
        Route::get('/script-settings', 'AdminController@scriptSetting')->name('scriptSetting');
        Route::post('/save-settings', 'AdminController@saveSetting')->name('update-scriptSetting');
        Route::get('/manage-dashboard', 'AdminController@mangeDashBoard')->name('manage.dashboard');
        Route::get('/masterPicklist', 'AdminController@masterPicklist')->name('masterPicklist');
        Route::match(['GET','POST'],'/getmasterPicklist','AdminController@getmasterPicklist')->name('getmasterPicklist');
        Route::get('/runPicklist','AdminController@runPicklist')->name('runPicklist');  
        Route::get('/batchPickists/{zoneName?}','AdminController@batchPickists')->name('batchPickists');  
        Route::get('/getWarehouses','UserManagementController@getWarehouses')->name('getWarehouses');  
        Route::match(['GET','POST'],'/getrunPicklist','AdminController@getrunPicklist')->name('getrunPicklist');
        Route::get('/runPicklistPrint/{zoneName?}','AdminController@runPicklistPrint')->name('runPicklistPrint');
        Route::get('/runPicklistView/{zoneName?}','AdminController@runPicklistView')->name('runPicklistView');
        Route::get('/deliverySchedulePrint/{zoneName?}','AdminController@deliverySchedulePrint')->name('deliverySchedulePrint');
        Route::any('/select-customer', 'AdminController@selectCustomer')->name('selectCustomer');  
        Route::get('/customer-purchasing/{id}','AdminController@purchasingHistory')->name('customerPurchasing');
        Route::get('/allocate-payment/{id}/{name}/{qnty}/{start}/{end}','AdminController@allocatePayment')->name('allocatePayment');
        Route::post('/saveAllocatePayment','AdminController@saveAllocatePayment')->name('saveAllocatePayment');
        Route::group(['as' => 'admin.','middleware' => ['role:Admin']], function () {
            Route::match(['get', 'post'], '/setting', 'AdminController@setting')->name('setting');
            Route::get('/reset-password', 'AdminController@resetPassword')->name('reset-password');
            Route::post('/check-password', 'AdminController@checkPassword')->name('check-password');
            Route::post('/update-password', 'AdminController@updatePassword')->name('update-password');
        });
        Route::group(['prefix' => 'users','middleware' => ['role:Admin']], function (){
            Route::post('/checkEmail','UserManagementController@checkEmail')->name('user.checkEmail');
            Route::get('/','UserManagementController@users')->name('user.index');
            Route::get('/create','UserManagementController@addNewUser')->name('user.create');
            Route::post('/store','UserManagementController@createNewUser')->name('user.store');;
            Route::get('/edit/{id}','UserManagementController@editUser')->name('user.edit');
            Route::post('/update/{id}','UserManagementController@updateUser')->name('user.update');
            Route::post('/status', 'UserManagementController@status')->name('user.status');
        });
        Route::group(['prefix' => 'permissions','middleware' => ['role:Admin']], function (){
            Route::get('/','UserManagementController@permissions')->name('permission.index');
            Route::post('/store','UserManagementController@createPermission')->name('permission.store');
            Route::get('/edit/{id}','UserManagementController@editPermission')->name('permission.edit');
            Route::post('/update/{id}','UserManagementController@updatePermission')->name('permission.update');
            Route::delete('/delete/{id}', 'UserManagementController@deletePermission');
        });
        Route::group(['prefix' => 'roles','middleware' => ['role:Admin']], function (){
            Route::get('/','UserManagementController@roles')->name('role.index');
            Route::post('/store','UserManagementController@createRole')->name('role.store');
            Route::get('/edit/{id}','UserManagementController@editRole')->name('role.edit');
            Route::post('/update/{id}','UserManagementController@updateRoles')->name('role.update');
            Route::delete('/delete/{id}','UserManagementController@deleteRole');
        });
        Route::group(['prefix' => 'customer'], function (){
            Route::post('/checkEmail','CustomerController@checkEmail')->name('customer.checkEmail');
            Route::group(['middleware' => ['role:Admin']], function (){
            Route::get('/','CustomerController@customers')->name('customer.index');
            Route::get('/create','CustomerController@newCustomerCreate')->name('customer.newCustomerCreate');
            Route::post('/store','CustomerController@createCustomer')->name('customer.store');
            Route::get('/view/{id}','CustomerController@viewCustomer')->name('customer.customerView');
            Route::get('/edit/{id}','CustomerController@editCustomer')->name('customer.customerEdit');
            Route::post('/update/{id}','CustomerController@updateCustomer')->name('customer.update');
            });
            Route::get('/report','CustomerController@customerReport')->name('customer.customerReport');
            Route::delete('/customerDelete/{id}','CustomerController@deleteCustomer');
            Route::get('/customerReport','CustomerController@reports')->name('customer.customer-report');
            Route::get('generate-pdf/{id}', 'CustomerController@generatePDF');
            Route::post('/product-admin-orders/{id}','CustomerController@productOrderAdmin')->name('admin.customer-orders');
            Route::post('/standing-orders/{id}','CustomerController@StandingOrderAdmin')->name('admin.standing-orders');
            Route::get('/past-orders/{id}','CustomerController@pastOrder')->name('customer.past-orders');
            Route::get('/packing-slip','CustomerController@packingslip')->name('customer.packing-slip');
            Route::get('/final-report/{id}/{customerId}/{startDate?}/{endDate?}','CustomerController@finalreport')->name('customer.final-report');
            Route::get('/statement/{id}/{start}/{end}/{region?}','CustomerController@pastOrderStatement')->name('customer.week-statement');
            Route::get('/financial-statement/{id}/{total}/{start}/{end}','CustomerController@financialStatement')->name('customer.financial-statement');
            Route::post('/edit-delivery-orders/{id}','CustomerController@editDeliveryOrders')->name('customer.edit-delivery-orders');
            Route::get('/statement2/pdf/{id}/{start}/{end}/{region}', 'CustomerController@statementPrint')->name('customer.statementPdf');
        });
        Route::group(['prefix' => 'customer-group','middleware' => ['role:Admin']], function (){

            Route::get('/','CustomerGroupController@customerGroup')->name('customer-group.index');
            Route::post('/store','CustomerGroupController@store')->name('customer-group.storeGroup');
            Route::post('/status','CustomerGroupController@status')->name('customer-group.groupStatus');
            Route::delete('/delete/{id}','CustomerGroupController@delete');
            Route::get('/edit/{id}','CustomerGroupController@editGroup');
            Route::post('/update/{id}','CustomerGroupController@updateGroup');
        });
        Route::group(['prefix' => 'warehouse','middleware' => ['role:Admin']], function (){
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
        
        Route::group(['prefix' => 'product','middleware' => ['role:Admin']], function (){
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
        Route::group(['prefix' => 'weekelySales','middleware' => ['role:Admin']], function (){
            Route::get('/','SaleController@weekelySales')->name('sale.index');
            Route::get('/getplannedPayments','SaleController@getplannedPayments')->name('getplannedPayments');
            Route::get('/getplannedcsv','SaleController@getplannedcsv')->name('getplannedcsv');
            Route::get('/get-csv/{start}/{end}','SaleController@getCsv')->name('sale.csv');
            Route::get('/get-csv-blade','SaleController@index')->name('sale.csvblade');
            Route::get('/reverse_payment/{customer?}/{date?}','SaleController@reverse_payment')->name('reverse_payment');
            Route::post('/planned_payment','SaleController@planned_payment')->name('planned_payment');
            Route::post('/importExcelCSV','SaleController@importExcelCSV')->name('sale.import-csv');
            Route::get('/get-import-txt','SaleController@getCsv')->name('sale.import-txt');
            Route::get('/customer-owing-report','SaleController@customerOwingReport')->name('sale.customer-owing-report');
        });
        Route::group(['prefix' => 'driver'], function (){
            Route::get('/printDeliveryDocket/{id}','NotificationController@printDeliveryDocket')->name('printDeliveryDocket');
            Route::post('/get-products','NotificationController@getProducts')->name('getProducts');
            Route::get('/casual-orders','NotificationController@casualOrder')->name('casualOrders');
            Route::post('/deliveredProducts','NotificationController@deliveredProducts')->name('deliveredProducts');
            Route::get('/{id?}','NotificationController@driverPicklistIndex')->name('driverPicklist.index');
            Route::get('/picklist/detail/{id}','NotificationController@picklistDetail')->name('picklist.detail');
         
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
    Route::get('/notification', 'NotificationController@checkDriverNotification')->name('checkDriverNotification');
    Route::group(['prefix' => 'driver'], function () {

        Route::get('/brCode/{id}/{type?}{productId?}', 'QrController@driverScan')->name('qr.driverScan');
        Route::post('/code', 'QrController@driverCode')->name('qr.driverCode');
        Route::get('/upload/view/{id}/{driverId}', 'QrController@driverUploadView')->name('qr.upload');
        Route::post('/upload/pic', 'QrController@driverUploadViewCap')->name('qr.uploadCap');
    });
    Route::post('/get-regions','HomeController@getState')->name('getRegions');
    Route::post('/get-cities','HomeController@getCity')->name('getCitiesByRegion');
    Route::get('/', 'HomeController@index');
    Auth::routes();