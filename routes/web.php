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

// Route::get('/', function () {
//     return view('welcome');
// });
// foreach (File::allFiles(__DIR__ . DIRECTORY_SEPARATOR . "web") as $partial) {
// 	require_once $partial->getPathname();
// }
Route::get('/linkstorage', function () {
    Artisan::call('storage:link'); // thay php artisan storage:link
});
// auth
Route::group(['namespace' => 'App\Http\Controllers\Admin'], function() {
	Route::get('login', 'AdminLoginController@getLogin')->name('login');
	Route::post('login','AdminLoginController@postLogin');
	Route::get('logout','AdminLoginController@getLogout');
});
// role
Route::group(['middleware' => 'auth','namespace' => 'App\Http\Controllers'], function() {
	Route::get('generate','RoleController@generate');
    Route::group(['middleware' => ['role:super-admin'],'prefix' => 'modelroles'],function(){
		Route::get('/','RoleController@get_model');
		Route::post('/','RoleController@post_model');
	});
	Route::group(['middleware' => ['role:super-admin'],'prefix' => 'role_permission'],function(){
		Route::get('/','RoleController@get_role_permission');
		Route::post('/','RoleController@post_role_permission');
	});
});
// language
Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\LanguageController@switchLang']);

Route::group(['middleware' => 'auth','namespace' => 'App\Http\Controllers\Admin'], function() {
    Route::get('/','HomeController@index');
    Route::post('setup/{name}','HomeController@setup');
    Route::group(['prefix' => 'account'],function(){
        Route::get('/','AccountController@index');//->middleware(['permission:list-super']);
        Route::get('create','AccountController@create');
        Route::post('store', 'AccountController@store');
        Route::get('edit/{id}', 'AccountController@edit');
        Route::post('{id}/update', 'AccountController@update');
        Route::post('status','AccountController@status');
        Route::post('remove_img','AccountController@remove_img');
        Route::post('destroy', 'AccountController@destroy');
    });

    Route::group(['prefix' => 'suppliers'],function(){
        Route::get('/','VhnSupplierController@index');
        Route::get('create','VhnSupplierController@create');
        Route::post('store', 'VhnSupplierController@store');
        Route::get('edit/{id}', 'VhnSupplierController@edit');
        Route::post('{id}/update', 'VhnSupplierController@update');
        Route::post('status','VhnSupplierController@status');
        Route::post('remove_img','VhnSupplierController@remove_img');
        Route::post('destroy', 'VhnSupplierController@destroy');
        Route::post('congno', 'VhnSupplierController@congno');
    });

    Route::group(['prefix' => 'congnos'],function(){
        Route::get('/','VhnCongnoController@index');
        Route::get('create','VhnCongnoController@create');
        Route::post('store', 'VhnCongnoController@store');
        Route::get('edit/{id}', 'VhnCongnoController@edit');
        Route::post('{id}/update', 'VhnCongnoController@update');
        Route::post('status','VhnCongnoController@status');
        Route::post('remove_img','VhnCongnoController@remove_img');
        Route::post('destroy', 'VhnCongnoController@destroy');
        Route::post('congno', 'VhnCongnoController@congno');
        Route::get('list/{id}/{date}/{loai}','VhnCongnoController@list');
    });

    Route::group(['prefix' => 'giamgias'],function(){
        Route::get('/','VhnGiamgiaController@index');
        Route::get('create','VhnGiamgiaController@create');
        Route::post('store', 'VhnGiamgiaController@store');
        Route::get('edit/{id}', 'VhnGiamgiaController@edit');
        Route::post('{id}/update', 'VhnGiamgiaController@update');
        Route::post('status','VhnGiamgiaController@status');
        // Route::post('destroy', 'VhnCongnoController@destroy');
    });

    Route::group(['prefix' => 'products'],function(){
        Route::get('/','VhnProductController@index');
        Route::get('create','VhnProductController@create');
        Route::post('store', 'VhnProductController@store');
        Route::get('edit/{id}', 'VhnProductController@edit');
        Route::post('{id}/update', 'VhnProductController@update');
        Route::post('status','VhnProductController@status');
        Route::post('sort','VhnProductController@sort');
        Route::post('remove_img','VhnProductController@remove_img');
        Route::post('remove_img_location','VhnProductController@remove_img_location');
        Route::post('destroy', 'VhnProductController@destroy');
        Route::post('viewhd', 'VhnProductController@viewhd');
    });

    Route::group(['prefix' => 'phieus'],function(){
        Route::get('/','VhnPhieuController@index');
        Route::get('create','VhnPhieuController@create');
        Route::post('store', 'VhnPhieuController@store');
        Route::get('edit/{id}', 'VhnPhieuController@edit');
        Route::post('{id}/update', 'VhnPhieuController@update');
        Route::post('status','VhnPhieuController@status');
        Route::post('sort','VhnPhieuController@sort');
        Route::post('remove_img','VhnPhieuController@remove_img');
        Route::post('destroy', 'VhnPhieuController@destroy');
    });

    Route::group(['prefix' => 'hoadonpros'],function(){
        Route::get('/','VhnHoadonProController@index');
        Route::get('create','VhnHoadonProController@create');
        Route::post('store', 'VhnHoadonProController@store');
        Route::get('edit/{id}', 'VhnHoadonProController@edit');
        Route::post('{id}/update', 'VhnHoadonProController@update');
        Route::get('show/{id}','VhnHoadonProController@show');
        Route::post('status','VhnHoadonProController@status');
        Route::post('sort','VhnHoadonProController@sort');
        Route::post('destroy', 'VhnHoadonProController@destroy');
        Route::get('ajax/{id}','VhnHoadonProController@ajax');
    });
    Route::group(['prefix' => 'hoadonscs'],function(){
        Route::get('/','VhnHoadonScController@index');
        Route::get('create','VhnHoadonScController@create');
        Route::post('store', 'VhnHoadonScController@store');
        Route::get('edit/{id}', 'VhnHoadonScController@edit');
        Route::post('{id}/update', 'VhnHoadonScController@update');
        Route::get('show/{id}','VhnHoadonScController@show');
        Route::post('status','VhnHoadonScController@status');
        Route::post('sort','VhnHoadonScController@sort');
        Route::post('loinhuan/{id}','VhnHoadonScController@loinhuan');
        Route::post('ghichu/{id}','VhnHoadonScController@ghichu');
        Route::post('destroy', 'VhnHoadonScController@destroy');
    });
});

Route::group(['middleware' => 'auth','namespace' => 'App\Http\Controllers\Admin'], function() {
    Route::get('user','DatatablesController@user');
    Route::get('product','DatatablesController@product');
    Route::get('phieu','DatatablesController@phieu');
    Route::get('hoadonpro','DatatablesController@hoadonpro');
    Route::get('hoadonsc','DatatablesController@hoadonsc');
});
Route::group(['namespace' => 'App\Http\Controllers'], function() {
    Route::get('export/', 'ExportController@export');
    Route::get('import/', 'ImportController@getImport');
    Route::post('import/', 'ImportController@postImport');
});

Route::group(['prefix' => 'hoadonscs','namespace' => 'App\Http\Controllers\Admin'],function(){
    Route::get('showkh/{id}','VhnHoadonScController@showkh');
});

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});
