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
        Route::group(['prefix' => 'users'], function (){
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
            Route::post('/delete', 'UserManagementController@deletePermission')->name('permission.delete');
        });
        Route::group(['prefix' => 'roles'], function (){
            Route::get('/','UserManagementController@roles')->name('role.index');
            Route::post('/store','UserManagementController@createRole')->name('role.store');
            Route::get('/edit/{id}','UserManagementController@editRole')->name('role.edit');
            Route::post('/update/{id}','UserManagementController@updateRoles')->name('role.update');
            Route::post('/delete','UserManagementController@deleteRole')->name('role.delete');
        });
        Route::group(['prefix' => 'customer'], function (){
            Route::get('/','CustomerController@customers')->name('customer.index');
            Route::get('/create','CustomerController@newCustomerCreate')->name('customer.newCustomerCreate');
            Route::post('/store','CustomerController@createCustomer')->name('customer.store');
            Route::get('/edit/{id}','CustomerController@editCustomer')->name('customer.customerEdit');
            Route::post('/update/{id}','CustomerController@updateCustomer')->name('customer.update');
            Route::get('/group','CustomerController@customerGroup')->name('customer.customerGroup');
            Route::get('/report','CustomerController@customerReport')->name('customer.customerReport');
            Route::delete('/customerDelete/{id}','CustomerController@deleteCustomer');
        });
        Route::group(['prefix' => 'distributor'], function (){
            Route::get('/','DistributorController@index')->name('distributor.index');
            Route::get('/create','DistributorController@create')->name('distributor.create');
            Route::post('/store','DistributorController@store')->name('distributor.store');
            Route::get('/edit/{id}','DistributorController@edit')->name('distributor.edit');
            Route::get('/detail/{id}','DistributorController@show')->name('distributor.detail');
            Route::post('/update/{id}','DistributorController@update')->name('distributor.update');
            Route::post('/status','DistributorController@status')->name('distributor.status');
            Route::post('/delete','DistributorController@destroy')->name('distributor.destroy');
        });
        Route::group(['prefix' => 'driver'], function (){
            Route::get('/','DriverController@index')->name('driver.index');
            Route::get('/create','DriverController@create')->name('driver.create');
            Route::post('/store','DriverController@store')->name('driver.store');
            Route::get('/edit/{id}','DriverController@edit')->name('driver.edit');
            Route::get('/detail/{id}','DriverController@show')->name('driver.detail');
            Route::post('/update/{id}','DriverController@update')->name('driver.update');
            Route::post('/status','DriverController@status')->name('driver.status');
            Route::post('/delete','DriverController@destroy')->name('driver.destroy');
        });
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
        Route::group(['prefix' => 'sale'], function (){
            Route::get('/','SaleController@reoccurring')->name('sale.index');
        });
    });

    Route::group(['prefix' => 'home'], function () {
        Route::get('/', 'HomeController@index')->name('index');
        Route::resource('customer-detail','CustomerDetailController');
        Route::post('/product-orders','HomeController@productOrders');
    }); 
    Route::post('get-states-by-country-user',[HomeController::class,'getState']);
    Route::post('get-cities-by-state-user',[HomeController::class,'getCity']);

});
Route::get('/', 'HomeController@index');
Auth::routes();