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
    Route::post('login', 'ApiAuthController@login');
    Route::post('register', 'ApiAuthController@register');
    // Route::post('logout', 'ApiAuthController@logout');
    // Route::post('/demo','BusinessController@demo'); 
    Route::get('get-categories', 'UserBusinessController@getCategories');

    Route::group(['middleware' => 'auth.jwt'], function () {
        Route::get('logout', 'ApiAuthController@logout');

        Route::get('get-user-business/{id?}', 'UserBusinessController@getUserBusiness');
    
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
            
            Route::delete('delete-user-business', 'UserBusinessController@deleteUserBusiness');
            Route::post('create-business-schedule', 'UserBusinessController@createOrUpdateSchedule');

            Route::post('create-user-category-service', 'UserBusinessController@createUserBusinessService');

            
        });
        /*service provider end*/
        /*client*/
        Route::group(['middleware' => 'client.jwt'], function () {
            Route::post('get-businesses-list', 'UserBusinessController@getBusinesseslist');
            Route::post('create-booking', 'BookingController@create');
            Route::post('get-estimated-time', 'BookingController@getEstimatedTime');

        });
    });
    /*end*/
});

// Route::group(['namespace' => 'Api','middleware' => ['assign.guard:providers','jwt.auth']],function ()
// {
//     Route::post('/demo','BusinessController@demo'); 
// });



