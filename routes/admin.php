<?php

use Haunt\Entities\Models\Plugin;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

Route::group(['as' => 'admin.', 'middleware' => ['web'], 'prefix' => config('haunt.route')], function() {
	if(Haunt::isInstalled()) {
		Plugin::active(true)->get()->each(function($item) {
			$instance = $item->instance();
			if(File::exists($instance->routes['admin'])) {
				require_once($instance->routes['admin']);
			}
		});
	}
});
