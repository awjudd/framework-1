<?php
namespace Haunt\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
	/**
	 * The direct path.
	 * @var string
	 */
	private $root = __DIR__.'/../..';

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		// views
		$this->loadViewsFrom("{$this->root}/resources/views", 'haunt');

		// components
		$this->loadViewsFrom("{$this->root}/resources/components", 'haunt-component');
		Blade::componentNamespace('Haunt\\Http\\Views\\Components', 'haunt');
	}
}
