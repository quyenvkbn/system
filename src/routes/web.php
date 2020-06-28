<?php

Route::group(['middleware' => ['auth','language']], function () {
	Route::any('/ckfinder/connector', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')
	    ->name('ckfinder_connector');

	Route::any('/ckfinder/browser', '\CKSource\CKFinderBridge\Controller\CKFinderController@browserAction')
	    ->name('ckfinder_browser');
	    
	Route::resource('/system', 'SystemController', ['only' => ['edit', 'update']]);
});