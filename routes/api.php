<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['namespace' => 'Api'],function()
{
    // google social login
    Route::any('auth/google', 'ApiAuthController@redirectToGoogle');
    Route::get('auth/google/callback','ApiAuthController@handleGoogleCallback');

    // facebook social login
    Route::any('auth/facebook', 'ApiAuthController@redirectToFacebook');
    Route::get('auth/facebook/callback','ApiAuthController@handleFacebookCallback');

    Route::post('auth/social/getUserInfo','ApiAuthController@getSocialLoginUserInfo');

    Route::post('login', 'ApiAuthController@login');
    Route::post('register', 'ApiAuthController@register');
    Route::post('send-otp', 'ApiAuthController@sendOtp');
    Route::post('verify', 'ApiAuthController@otpVerify');
    Route::post('reset-password', 'ApiAuthController@resetPassword');
    // Route::post('logout', 'ApiAuthController@logout');
    // Route::post('/demo','BusinessController@demo'); 
    Route::get('get-categories', 'UserBusinessController@getCategories');

    Route::group(['middleware' => 'auth.jwt'], function () {
        Route::get('logout', 'ApiAuthController@logout');

        Route::get('get-user-business/{id?}', 'UserBusinessController@getUserBusiness');
        Route::post('get-shop-info', 'UserBusinessController@getShopInfo');
        Route::get('get-bookings', 'BookingController@getBookings');
        Route::get('booking-detail', 'BookingController@bookingDetail');
        Route::get('booking-cancelation', 'BookingController@bookingCancel');

        Route::get('get-auth-user', 'ApiAuthController@getAuthUser');
        Route::post('update-user', 'ApiUserController@createOrUpdate');

        // notifications
        Route::get('get-notifications', 'NotificationController@getNotifications');
        Route::get('get-notifications-count', 'NotificationController@getNotificationsCount');
        Route::post('seen-notification', 'NotificationController@seenNotification');
        
        /*service provider start*/
        Route::group(['middleware' => 'provider.jwt'], function () {

            Route::post('create-or-update-business', 'BusinessController@createOrUpdate');
            /*categories*/
            
            // Route::post('create-user-category', 'BusinessController@CreateOrUpdateBusinessCategory');

            Route::post('bind-categories', 'BusinessController@bindCategories');

            Route::get('get-user-categories', 'UserBusinessController@getUserCategories');
            Route::delete('delete-user-category/{id}', 'UserBusinessController@deleteUserCategory');

            Route::post('create-or-update-category-service', 'BusinessController@createOrUpdateCaetgoryService');
            Route::get('get-user-services', 'UserBusinessController@getUserServices');
            Route::delete('delete-user-service/{id}', 'UserBusinessController@deleteUserService');

            /*user*/
            Route::post('create-user-business', 'UserBusinessController@createOrUpdate');
            Route::post('save-shop-schedule', 'UserBusinessController@addShopSchedule');
            
            Route::delete('delete-user-business', 'UserBusinessController@deleteUserBusiness');
            Route::post('create-business-schedule', 'UserBusinessController@createOrUpdateSchedule');
            Route::delete('delete-business-image', 'UserBusinessController@deleteBusinessImage');

            Route::get('get-user-earning', 'BookingController@getUserEarning');

            Route::post('create-user-category-service', 'UserBusinessController@createUserBusinessService');
            // bank   
            Route::post('save-bank-detail', 'ApiUserController@saveBankDetail');
            Route::get('get-bank-detail', 'ApiUserController@getBankDetail');
            Route::delete('delete-bank-detail', 'ApiUserController@deleteBankDetail');

            Route::post('reject-booking', 'BookingController@rejectBooking');
            Route::post('accept-booking', 'BookingController@acceptBooking');

            
        });
        /*service provider end*/
        /*client*/
        Route::group(['middleware' => 'client.jwt'], function () {

            Route::post('get-businesses-list', 'UserBusinessController@getBusinesseslist');

            Route::post('create-booking', 'BookingController@create');
            Route::post('get-estimated-time', 'BookingController@getEstimatedTime');
            Route::post('shop-current-bookings', 'BookingController@shopCurrentBooking');

            Route::post('cancel-booking', 'BookingController@cancelBooking');
            Route::post('save-feedback', 'BookingController@postFeedback');

        });
    });
    /*end*/
});

// Route::group(['namespace' => 'Api','middleware' => ['assign.guard:providers','jwt.auth']],function ()
// {
//     Route::post('/demo','BusinessController@demo'); 
// });



