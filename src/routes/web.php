<?php

Route::group(['middleware' => ['auth','language']], function () {
	Route::any('/ckfinder/connector', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')
	    ->name('ckfinder_connector');

	Route::any('/ckfinder/browser', '\CKSource\CKFinderBridge\Controller\CKFinderController@browserAction')
	    ->name('ckfinder_browser');

    Route::resource('/role','RoleController');
    Route::resource('/user','UserController');
	Route::resource('/system', 'SystemController', ['only' => ['edit', 'update']]);
});