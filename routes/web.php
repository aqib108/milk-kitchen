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
Auth::routes();

Route::group(['prefix' =>'admin','middleware' => 'auth'],function()
{
    Route::get('/dashboard','HomeController@index')->name('dashboard');
Route::get('/users','UserManagement@users')->name('Users');
Route::get('/add-new-user','UserManagement@addNewUser');
Route::post('/create-new-user','UserManagement@createNewUser');
Route::get('/edit-User/{id}','UserManagement@editUser');
Route::post('/updateUser/{id}','UserManagement@updateUser');
Route::get('/delete-user/{id}','UserManagement@deleteUser');

Route::get('/roles','UserManagement@roles');
Route::post('/create-role','UserManagement@createRole');
Route::get('/edit-role/{id}','UserManagement@editRole');
Route::post('/updateRoles/{id}','UserManagement@updateRoles');
Route::get('/delete-role/{id}','UserManagement@deleteRole');

Route::get('/permissions','UserManagement@permissions');
Route::post('/create-permission','UserManagement@createPermission');
Route::get('/editPermission/{id}','UserManagement@editPermission');
Route::post('updatePermission/{id}','UserManagement@updatePermission');
Route::get('/delete-permission/{id}','UserManagement@deletePermission');
}
);

