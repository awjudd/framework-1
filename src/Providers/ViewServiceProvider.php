<?php
namespace Haunt\Providers;

use Livewire\Livewire;
use Illuminate\Pagination\Paginator;
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

		// paginator
        Paginator::defaultView('haunt-component::pagination');

		// livewire
		Livewire::component('repeatable-component', \Haunt\Http\Components\RepeatableComponent::class);
		Livewire::component('repeatable-view-component', \Haunt\Http\Components\RepeatableViewComponent::class);
	}
}
