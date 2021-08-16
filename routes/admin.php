<?php

use Haunt\Entities\Models\Plugin;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Haunt\Http\Controllers\InstallController;

Route::group(['as' => 'admin.', 'middleware' => ['web'], 'prefix' => config('haunt.route')], function() {
	// Haunt IS NOT installed
	Route::group(['as' => 'install.', 'middleware' => ['haunt-installed:false']], function() {
		Route::get('/', [InstallController::class, 'index'])->name('index');
		Route::post('/', [InstallController::class, 'store'])->name('store');
	});

	// Haunt IS installed
	Route::group(['middleware' => ['haunt-installed:true']], function() {
		if(Haunt::isInstalled()) {
			Plugin::active(true)->get()->each(function($item) {
				$instance = $item->instance();
				if(File::exists($instance->routes['admin'])) {
					require_once($instance->routes['admin']);
				}
			});
		}
		Route::any('/{any}', '\Haunt\Http\Controllers\InstallController@index')->where('any', '.*');
	});
});
