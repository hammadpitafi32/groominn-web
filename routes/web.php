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
    Route::post('update-user', 'UserController@updateUser')->name('update-user');
    Route::post('delete-user', 'UserController@UserDelete')->name('delete-user');
    Route::post('change-user-status', 'UserController@changeUserStatus')->name('change-user-status');
    Route::post('profile/update', 'UserController@updateProfile')->name('profile.update');
    Route::get('profile', 'UserController@getProfile');
    Route::get('settings', 'SettingController@index');
    Route::post('settings/update', 'SettingController@updateSetting')->name('settings.update');

    // Email Templates
    Route::get('email-templates', 'SettingController@getEmailTemplates')->name('email-templates');
    Route::post('delete-template', 'SettingController@templateDelete')->name('delete-template');

    Route::post('create-template', 'SettingController@createTemplate')->name('create-template');
    Route::post('update-template', 'SettingController@editTemplate')->name('update-template');
    // Bookings
    Route::get('bookings', 'BookingController@index')->name('bookings');
    Route::post('delete-booking', 'BookingController@BookingDelete')->name('delete-booking');
    Route::post('update-booking-status', 'BookingController@updateBookingStatus')->name('update-booking-status');

    Route::post('delete-business', 'AdminController@businessDelete')->name('delete-business');

    Route::group(['namespace' => 'Api'],function()
    {
        Route::post('create-category', 'BusinessController@CreateOrUpdateBusinessCategory')->name('create-category');
        Route::get('user-businesses', 'UserBusinessController@getAllBusinesses')->name('user-businesses');
        Route::post('change-business-status', 'UserBusinessController@changeBusinessStatus')->name('change-business-status');

        Route::post('delete-category', 'UserBusinessController@deleteCategory')->name('delete-category');

        Route::post('delete-service', 'UserBusinessController@ServiceDelete')->name('delete-service');
    });
    
    Route::get('categories', 'AdminController@getCategories')->name('categories');

    Route::get('services', 'AdminController@getServices')->name('services');
    
    Route::post('change-service-status', 'AdminController@changeServiceStatus')->name('change-service-status');

    Route::post('update-service', 'AdminController@updateService')->name('update-service');

    Route::get('business-type', 'AdminController@getBusinessTypes')->name('getBusinessTypes');
    
    Route::post('create-business-type', 'AdminController@createBusinessType')->name('create-business-type');
    
    Route::post('update-business-type', 'AdminController@updateBusinessType')->name('update-business-type');

    Route::post('delete-business-type', 'AdminController@deleteBusinessType')->name('delete-business-type');

    Route::get('get-notifications', 'AdminController@getNotifications')->name('getNotifications');

    Route::post('delete-notification', 'AdminController@deleteNotification')->name('delete-notification');

    Route::get('get-notifications-count', 'AdminController@getNotificationsCount')->name('get-notifications-count');

});

/*for vue router*/
Route::any('/{any}', function () {
    return view('welcome');
})->where(['any' => '.*']);


