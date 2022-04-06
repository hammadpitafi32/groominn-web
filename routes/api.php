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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'Api'],function()
{
    Route::post('login', 'ApiAuthController@login');
    Route::post('/demo','BusinessController@demo'); 
    Route::group(['middleware' => 'auth.jwt'], function () {
        Route::get('logout', 'ApiAuthController@logout');
    });
    /*service provider start*/
    Route::group(['middleware' => 'provider.jwt'], function () {
        Route::post('create-or-update-business', 'BusinessController@createOrUpdate');
        Route::post('create-or-update-business-category', 'BusinessController@CreateOrUpdateBusinessCategory');
        Route::post('create-or-update-category-service', 'BusinessController@createOrUpdateCaetgoryService');
        /*user*/
        Route::post('create-user-business', 'UserBusinessController@createOrUpdate');
        Route::post('create-business-schedule', 'UserBusinessController@createOrUpdateSchedule');

        Route::post('create-user-category-service', 'UserBusinessController@createUserBusinessService');

        
    });
    /*service provider end*/
    /*client*/
    Route::group(['middleware' => 'client.jwt'], function () {
        Route::post('create-booking', 'BookingController@create');
        Route::post('get-estimated-time', 'BookingController@getEstimatedTime');

    });
    /*end*/
});

// Route::group(['namespace' => 'Api','middleware' => ['assign.guard:providers','jwt.auth']],function ()
// {
//     Route::post('/demo','BusinessController@demo'); 
// });



