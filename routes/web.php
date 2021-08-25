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
            Route::post('/create-new-user','UserManagementController@createNewUser');
            Route::get('/edit/{id}','UserManagementController@editUser');
            Route::post('/update/{id}','UserManagementController@updateUser');
            Route::get('/delete/{id}','UserManagementController@deleteUser');

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
            Route::post('/create-role','UserManagementController@createRole');
            Route::get('/edit-role/{id}','UserManagementController@editRole');
            Route::post('/updateRoles/{id}','UserManagementController@updateRoles');
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
