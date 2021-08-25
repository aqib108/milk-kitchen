<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => 'auth'], function () {
    Route::get('/permission','RoleManagementController@permission');
    Route::get('/super','RoleManagementController@assign');

    Route::group(['prefix' => 'admin'], function (){
        Route::get('/', 'AdminController@index')->name('dashboard');
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
    });

    Route::group(['prefix' => 'home'], function () {
        Route::get('/', 'HomeController@index')->name('index');
        Route::resource('customer-detail','CustomerDetailController');
    }); 
});
Route::get('/', 'HomeController@index');
Auth::routes();
