<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('login', 'Auth\ApiController@login');
// Route::post('register', 'Auth\ApiController@register');
// Route::get('details', 'Auth\ApiController@details')->middleware('auth:api');

// NCR Registration API
Route::group(['middleware' => ['auth:api', 'role:superuser|administrator|inspektor']], function(){
	Route::get('ncr_reg', 'Api\NcrRegistrationController@index');
	Route::post('ncr_reg', 'Api\NcrRegistrationController@store');
	Route::delete('ncr_reg/{id}', 'Api\NcrRegistrationController@destroy');
	Route::put('ncr_reg/{id}', 'Api\NcrRegistrationController@update');
	Route::post('ncr_reg/{ncr_id}/store_img', 'Api\NcrRegistrationController@storeImg');
	Route::get('ncr_reg/create', 'Api\NcrRegistrationController@create');
	Route::get('ncr_reg/{id}/edit', 'Api\NcrRegistrationController@edit');    
	Route::get('ncr_reg/{ncr_reg}/upload_img','Api\RegNcrController@uploadImg');
	Route::get('ncr_reg/{id}', 'Api\NcrRegistrationController@show');

	Route::get('inspector_verification', 'Api\InspectorVerificationController@index');
	Route::post('inspector_verification', 'Api\InspectorVerificationController@store');
	Route::get('inspector_verification/{ncr_id}/edit', 'Api\InspectorVerificationController@edit');
	Route::get('inspector_verification/create', 'Api\InspectorVerificationController@create');
	Route::get('inspector_verification/{id}', 'Api\InspectorVerificationController@show');
	Route::put('inspector_verification/{ver_id}', 'Api\InspectorVerificationController@update');
	Route::delete('inspector_verification/{id}', 'Api\InspectorVerificationController@destroy');
	Route::get('inspector_verification/{ncr_resp_id}/print_pdf', 'Api\InspectorVerificationController@printPdf');

	});
Route::group(['middleware' => ['auth:api']], function(){
    Route::get('ncr_reg/{ncr_id}/print_pdf', 'Api\NcrRegistrationController@printPdf');
    Route::put('profile/{id}', 'ProfileController@update');
    Route::post('logout', 'Auth\ApiController@logout');
});
// NCR Response API
Route::group(['middleware' => ['auth:api', 'role:admin_pic_response|inspektor|administrator|superuser|manager']], function(){
	Route::get('ncr_resp', 'Api\NcrResponseController@index');
	Route::get('ncr_resp/{id}', 'Api\NcrResponseController@show');
	Route::delete('ncr_resp/{id}', 'Api\NcrResponseController@destroy');
	Route::put('ncr_resp/{ncr_resp_id}', 'Api\NcrResponseController@update');
	Route::post('ncr_resp/{id}', 'Api\NcrResponseController@store');
	Route::get('ncr_resp/{resp_id}/print_pdf', 'Api\NcrResponseController@printPdf');

    Route::post('/ncr_resp/{ncr_resp}/mrb', 'Api\NcrResponseController@mrbStore');    
    Route::put('/ncr_resp/{ncr_resp}/mrb_update', 'Api\NcrResponseController@mrbUpdate');
    Route::post('generate_report', 'Api\NcrRegistrationController@generateSpreadSheet');
});