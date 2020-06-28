<?php

Route::group(['middleware' => ['auth','language']], function () {
	Route::resource('/system', 'SystemController', ['only' => ['edit', 'update']]);
});