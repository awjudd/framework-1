<?php
Route::group(['as' => 'admin.', 'middleware' => [], 'namespace' => 'Haunt\\Http\\Controllers\\Admin', 'prefix' => config('haunt.route')], function() {
	Route::get('/', ['as' => 'index', 'uses' => 'HomeController@index']);
});
