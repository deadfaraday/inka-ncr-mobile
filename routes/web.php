<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('hellopdf', function(){
    return PDF::loadHTML('Hello World!')->stream('download.pdf');
});
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware'=>'auth'],function(){
        
    Route::get('files/{user_id}/dp', ['as' => 'dp_preview', 'uses' => 'FileController@previewProfileImage']);
    Route::get('files/{id}/ncr_reg', ['as' => 'ncr_reg_preview', 'uses' => 'FileController@previewNcrRegImage']);
    Route::get('files/{id}/ncr_resp', ['as' => 'ncr_resp_preview', 'uses' => 'FileController@previewNcrRespImage']);
    Route::get('download/{id}/ncr_resp', ['as' => 'ncr_resp_download', 'uses' => 'FileController@downloadNcrResponseFile']);
    Route::get('download/{id}/ncr_reg', ['as' => 'ncr_reg_download', 'uses' => 'FileController@downloadNcrRegistrationFile']);
    Route::resource('profile','ProfileController');    
});

Route::group(['middleware' =>['auth','role:administrator|gm|struktural']],function(){
    Route::resource('report_ncr_resp','ReportNcrRespController');  
    Route::resource('report_ncr_reg','ReportNcrRegController');
    // Route::resource('monitoring_dashboard','DashboardController');
    Route::resource('registration_dashboard','DashboardRegController');
    Route::resource('response_dashboard','DashboardRespController');
    
    Route::resource('response_dashboard','DashboardRespController');
    Route::resource('ins_ver_dashboard','DashboardInsVerController');

    Route::post('/set_dashboard_date', [
        'as' => 'dashboard.set_date',
        'uses' => 'DashboardController@setDateTime'
        ]);

    Route::post('/reset_date', [
            'as' => 'dashboard.reset_date',
            'uses' => 'DashboardController@resetDate'
        ]);
});

Route::group(['middleware' =>['auth','role:administrator']],function(){
    Route::resource('project', 'ProjectController');
    Route::resource('inspector', 'AdminInspectorController');
    Route::resource('employee', 'EmployeeController');
});



Route::group(['middleware' =>['auth','role:auditor_mmlh|gm|struktural']],function(){
    
    //dashboard
    Route::resource('monitoring_dashboard','DashboardController');
    
    
    Route::get('dashboard/all_ncr', [
        'as' => 'dashboard.all_ncr',
        'uses' => 'DashboardController@all'
        ]);

    Route::get('dashboard/print_ncr/{ncr_id}', [
            'as' => 'dashboard.print_pdf',
            'uses' => 'DashboardController@printPdf'
            ]);

    Route::post('/set_dashboard_date', [
        'as' => 'dashboard.set_date',
        'uses' => 'DashboardController@setDateTime'
        ]);

    Route::post('/reset_date', [
            'as' => 'dashboard.reset_date',
            'uses' => 'DashboardController@resetDate'
        ]);
});

Route::group(['middleware' =>['auth']],function(){
    
    // semua bisa print lewat sini, single source of truth
    Route::get('/ncr_reg/{ncr_reg}/print_pdf',[
        'as' => 'ncr_reg.print_pdf',
        'uses' => 'RegNcrController@printPdf' 
    ]);
   
});

Route::group(['middleware' =>['auth','role:auditor_mmlh']],function(){
    Route::resource('auditor_verification','AuditorVerificationController'); 

    Route::get('/auditor_verification/{ncr_id}/print',[
        'as' => 'auditor_verification.print',
        'uses' => 'AuditorVerificationController@print' 
    ]);

    Route::get('/auditor_verification/{ncr_resp_id}/print_pdf',[
        'as' => 'auditor_verification.print_pdf',
        'uses' => 'AuditorVerificationController@printPdf' 
    ]);

    Route::put('/edit_auditor_verification/auditor_verification/{ncr_id}',[
        'as' => 'auditor_verification.editAuditorVerification',
        'uses' => 'AuditorVerificationController@editAuditorVerification' 
    ]);


});


Route::group(['middleware' =>['auth','role:admin_pic_response|inspektor|administrator|superuser|manager']],function(){
    Route::resource('ncr_resp','NcrResponseController');
    
    Route::resource('generate_report_ncr','GenerateReportNcr');

    Route::put('/ncr_resp/edit/{ncr_resp}',[
        'as' => 'ncr_resp.update_response',
        'uses' => 'NcrResponseController@updateResponse' 
    ]);

    Route::put('/ncr_resp/{ncr_resp}/mrb',[
        'as' => 'ncr_resp.mrb',
        'uses' => 'NcrResponseController@mrbStore' 
    ]);

    Route::put('/ncr_resp/{ncr_resp}/mrb_update',[
        'as' => 'ncr_resp.mrb_update',
        'uses' => 'NcrResponseController@mrbUpdate' 
    ]);

    Route::get('/ncr_resp/{ncr_resp}/print',[
        'as' => 'ncr_resp.print',
        'uses' => 'NcrResponseController@print' 
    ]);

    Route::get('/ncr_resp/{ncr_resp}/print_pdf',[
        'as' => 'ncr_resp.print_pdf',
        'uses' => 'NcrResponseController@printPdf' 
    ]);

    Route::get('/ncr_resp/{ncr_resp}/upload_img',[
        'as' => 'ncr_resp.upload_img',
        'uses' => 'NcrResponseController@uploadImg' 
    ]);

    Route::post('/ncr_resp/{ncr_resp}/store_img',[
        'as' => 'ncr_resp.store_img',
        'uses' => 'NcrResponseController@storeImg' 
    ]);

});

Route::group(['middleware' =>['auth','role:superuser|administrator|inspektor']],function(){
    Route::resource('pdf','ExportPdfController');
    Route::resource('ncr_reg','RegNcrController');
        
    Route::put('/inspector_verification/update/{ver_id}',[
        'as' => 'inspector_verification.update_verification',
        'uses' => 'InspectorVerificationController@updateVerification' 
    ]);

    Route::resource('inspector_verification','InspectorVerificationController');
    
    Route::get('/inspector_verification/{ncr_id}/print',[
        'as' => 'inspector_verification.print',
        'uses' => 'InspectorVerificationController@print' 
    ]);

    Route::get('/inspector_verification/{ncr_id}/print_pdf',[
        'as' => 'inspector_verification.print_pdf',
        'uses' => 'InspectorVerificationController@printPdf' 
    ]);

    

    Route::get('/ncr_reg/{ncr_reg}/upload_img',[
        'as' => 'ncr_reg.upload_img',
        'uses' => 'RegNcrController@uploadImg' 
    ]);

    Route::post('/ncr_reg/{ncr_reg}/store_img',[
        'as' => 'ncr_reg.store_img',
        'uses' => 'RegNcrController@storeImg' 
    ]);

    Route::resource('ncr_reg_log','RegNcrLogController');
    
    Route::post('/ncr_reg/store_log',[
        'as' => 'ncr_reg.store_logistik',
        'uses' => 'RegNcrController@storeLogistik' 
    ]);

    Route::put('/ncr_reg/update_log/{ncr_reg_id}',[
        'as' => 'ncr_reg.update_logistik',
        'uses' => 'RegNcrController@updateLogistik' 
    ]);

    // Route::get('/ncr_reg/{ncr_reg}/print_pdf',[
    //     'as' => 'ncr_reg.print_pdf',
    //     'uses' => 'RegNcrController@printPdf' 
    // ]);

    
});
