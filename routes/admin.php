<?php

use Illuminate\Support\Facades\Route;
use Haunt\Http\Controllers\Admin\HomeController;
use Haunt\Http\Controllers\Admin\Appearance\ThemeController;
use Haunt\Http\Controllers\Admin\Appearance\PluginController;

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::group(['as' => 'appearance.', 'prefix' => 'appearance'], function() {
	// themes
	Route::group(['as' => 'themes.', 'prefix' => 'themes'], function() {
		Route::get('/', [ThemeController::class, 'index'])->name('index');
	});

	// plugins
	Route::group(['as' => 'plugins.', 'prefix' => 'plugins'], function() {
		Route::get('/', [PluginController::class, 'index'])->name('index');
		Route::get('/install', [PluginController::class, 'create'])->name('create');
		Route::post('/install', [PluginController::class, 'store'])->name('store');
		Route::patch('/toggle/{plugin_id}', [PluginController::class, 'update'])->name('update');
		Route::delete('/uninstall/{plugin_id}', [PluginController::class, 'destroy'])->name('destroy');
	});
});
