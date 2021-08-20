<?php
namespace Haunt\Providers;

use Haunt\Facades\Haunt;
use Haunt\Entities\Models\Plugin;
use Illuminate\Support\Facades\Auth;
use Haunt\Library\Classes\HauntGuard;
use Haunt\Library\Classes\HauntUserProvider;
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
		app('router')->aliasMiddleware('haunt-installed', \Haunt\Http\Middleware\HauntInstalled::class);
		app('router')->aliasMiddleware('haunt-auth', \Haunt\Http\Middleware\HauntAuth::class);
		$this->loadRoutesFrom("{$this->root}/routes/web.php");

		// translations
        $this->loadTranslationsFrom("{$this->root}/resources/lang", 'haunt');

		// assets
        $this->publishes(["{$this->root}/resources/dist" => public_path('haunt')], 'haunt');

		// auth guard
        Auth::extend('haunt', function($app, $name, $config) {
            return new HauntGuard($app['request']);
        });

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
