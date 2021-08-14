<?php

use Haunt\Entities\Models\Plugin;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'admin.', 'middleware' => [], 'prefix' => config('haunt.route')], function() {
	Plugin::active(true)->get()->each(function($item) {
		$instance = $item->instance();
		if(File::exists($instance->routes['admin'])) {
			require_once($instance->routes['admin']);
		}
	});
});
