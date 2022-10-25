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

/*laravel router*/
Route::get('admin-login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('admin-login', 'Auth\LoginController@login')->name('admin-login');
Route::get('logout', 'Auth\LoginController@logout')->name('admin-logout');
Route::group(['prefix' =>'admin' ,'middleware' => 'checkAdmin'],function(){
    Route::get('/dashboard', 'AdminController@index')->name('admin-dashboard');
    // Route::get('users', 'AdminController@providerList');
    Route::get('users/{type}', 'UserController@list');
    Route::post('create-user', 'UserController@createOrUpdate')->name('create-user');
    Route::post('change-user-status', 'UserController@changeUserStatus')->name('change-user-status');
    Route::group(['namespace' => 'Api'],function()
    {
        Route::post('create-category', 'BusinessController@CreateOrUpdateBusinessCategory')->name('create-category');
        Route::get('user-businesses', 'UserBusinessController@getAllBusinesses')->name('user-businesses');
        Route::post('change-business-status', 'UserBusinessController@changeBusinessStatus')->name('change-business-status');
    });
    Route::get('categories', 'AdminController@getCategories')->name('categories');
    Route::get('services', 'AdminController@getServices')->name('services');
    Route::post('change-service-status', 'AdminController@changeServiceStatus')->name('change-service-status');

});

/*for vue router*/
Route::any('/{any}', function () {
    return view('welcome');
})->where(['any' => '.*']);



// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::group(['prefix' =>'admin' ,'middleware' => 'checkAdmin'],function(){
//     Route::get('/', 'AdminController@index');
//     // Route::get('users', 'AdminController@providerList');
//     Route::get('users/{type}', 'UserController@list');
//     Route::post('create-user', 'UserController@createOrUpdate')->name('create-user');
// });



