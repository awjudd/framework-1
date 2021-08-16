<?php
namespace Haunt\Providers;

use Haunt\Facades\Haunt;
use Haunt\Entities\Models\Plugin;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
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
		// config
		$this->mergeConfigFrom("{$this->root}/config/haunt.php", 'haunt');
		$this->publishes(["{$this->root}/config/haunt.php" => config_path('haunt.php')], 'haunt');

		// routes
		$this->loadRoutesFrom("{$this->root}/routes/web.php");
		app('router')->aliasMiddleware('haunt-installed', \Haunt\Http\Middleware\HauntInstalled::class);

		// translations
        $this->loadTranslationsFrom("{$this->root}/resources/lang", 'haunt');

		// assets
        $this->publishes(["{$this->root}/resources/dist" => public_path('vendor/haunt')], 'haunt');

		// paginator
        Paginator::defaultView('haunt-component::pagination');

		Haunt::init();
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		collect(glob($this->root.'/src/Library/Helpers/*.php'))->each(function($filename) {
			require_once($filename);
		});
	}
}
