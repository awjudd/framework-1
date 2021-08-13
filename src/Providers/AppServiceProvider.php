<?php
namespace Haunt\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Migrations\MigrationCreator;

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

		// migrations
		/**
		 $this->app->when(MigrationCreator::class)
			->needs('$customStubPath')
			->give(function($app) {
				return $app->basePath('stubs');
			});
		$this->loadMigrationsFrom("{$this->root}/database/migrations"); */

		// routes
		$this->loadRoutesFrom("{$this->root}/routes/game.php");
		$this->loadRoutesFrom("{$this->root}/routes/admin.php");

		// views
		$this->loadViewsFrom("{$this->root}/resources/views", 'haunt');

		// components
		$this->loadViewsFrom("{$this->root}/resources/components", 'haunt-component');
		Blade::componentNamespace('Haunt\\Http\\Views\\Components', 'haunt');

		// translations
        $this->loadTranslationsFrom("{$this->root}/resources/lang", 'haunt');

		// assets
        $this->publishes(["{$this->root}/resources/dist" => public_path('vendor/haunt')], 'haunt');
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		collect(glob($this->root.'/src/Helpers/*.php'))->each(function($filename) {
			require_once($filename);
		});
	}
}
