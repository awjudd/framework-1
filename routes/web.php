<?php

use Haunt\Entities\Models\Plugin;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Haunt\Http\Controllers\InstallController;
use Haunt\Http\Controllers\Admin\AuthController;

// Haunt IS NOT installed
Route::group(['as' => 'install.', 'middleware' => ['web', 'haunt-installed:false']], function() {
	Route::get('/', [InstallController::class, 'index'])->name('index');
	Route::post('/', [InstallController::class, 'store'])->name('store');
});

// Haunt IS installed
Route::group(['middleware' => ['web', 'haunt-installed:true']], function() {
	// admin routes
	Route::group(['as' => 'admin.', 'prefix' => config('haunt.route')], function() {
		Route::group(['middleware' => ['haunt-auth:true']], function() {
			require_once('admin.php');

			Plugin::active(true)->get()->each(function($item) {
				$instance = $item->instance();
				if(File::exists($instance->routes['admin'])) {
					require_once($instance->routes['admin']);
				}
			});
		});

		Route::group(['middleware' => ['haunt-auth:false']], function() {
			Route::get('/login', [AuthController::class, 'edit'])->name('login');
			Route::post('/login', [AuthController::class, 'update'])->name('login');
		});

		Route::any('/{any}', [ErrorController::class, 'index'])->where('any', '.*');
	});
});
