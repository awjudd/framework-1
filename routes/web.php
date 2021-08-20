<?php

use Haunt\Entities\Models\Plugin;
use Illuminate\Support\Facades\Route;
use Haunt\Http\Controllers\ErrorController;
use Haunt\Http\Controllers\InstallController;
use Haunt\Http\Controllers\Admin\AuthController;

Route::group(['middleware' => ['web']], function() {
	// Haunt IS NOT installed
	Route::group(['middleware' => ['haunt-installed:false']], function() {
		Route::get('/install', [InstallController::class, 'index'])->name('install.index');
		Route::post('/install', [InstallController::class, 'store'])->name('install.store');
	});

	// Haunt IS installed
	Route::group(['middleware' => ['haunt-installed:true']], function() {
		// admin routes
		Route::group(['as' => 'admin.', 'prefix' => config('haunt.route')], function() {
			Route::group(['middleware' => ['haunt-auth:true']], function() {
				require_once('admin.php');

				if(Haunt::isInstalled()) {
					Plugin::active(true)->get()->each(function($item) {
						$instance = $item->instance();
						if(File::exists($instance->routes['admin'])) {
							require_once($instance->routes['admin']);
						}
					});
				}
			});

			Route::group(['middleware' => ['haunt-auth:false']], function() {
				Route::get('/login', [AuthController::class, 'edit'])->name('login');
				Route::post('/login', [AuthController::class, 'update'])->name('login');
			});
		});

		Route::any('/{any}', [ErrorController::class, 'index'])->where('any', '.*')->name('error');
	});
});
