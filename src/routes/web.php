<?php

Route::group(['middleware' => 'language'], function () {
	Route::group(['middleware' => 'auth'], function () {
		Route::any('/ckfinder/connector', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')
		    ->name('ckfinder_connector');

		Route::any('/ckfinder/browser', '\CKSource\CKFinderBridge\Controller\CKFinderController@browserAction')
		    ->name('ckfinder_browser');
		Route::group([ 'prefix' => 'admin'], function () {
		    Route::resource('/role','RoleController');
		    Route::resource('/user','UserController');
			Route::resource('/system', 'SystemController', ['only' => ['edit', 'update']]);
		});
	});
	Route::get('set-language/{locale}', function($locale){
        Session::put('locale', $locale);
        Session::save();
        return back()->withInput();
	});
	Route::group(['middleware' => 'site_settings'], function () {
		Route::get('{canonical}{extension}', 'RouterController@index');
	});
});