<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

//认证
// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

//重置密码
// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');



//Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'auth'], function () {
//    Route::get('/', 'IndexController@index');
//});
Route::group(['namespace' => 'Admin', 'prefix' => 'admin','middleware' => 'auth'], function () {
    Route::get('/', 'IndexController@index');
    //品牌管理
//    Route::resource('brand', 'BrandController');
    Route::group(['prefix' => 'brand'], function () {
        Route::get('/search', 'BrandController@search');
        Route::patch('/sort', 'BrandController@sort');
        Route::patch('/is-show', 'BrandController@is_show');
    });
    Route::resource('brand', 'BrandController', ['except' => ['show']]);

    //商品类型
    Route::resource('type', 'TypeController');
});

//上传
Route::post('upload', 'UploadController@store');

