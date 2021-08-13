<?php
namespace Haunt\Providers;

use Haunt\Plugin\Manifest;
use Haunt\Plugin\Repository;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;

class PluginServiceProvider extends ServiceProvider
{
	/**
	 * The direct path.
	 * @var string
	 */
	private $root = __DIR__.'/../..';

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		// register plugin manifest
		$manifest = $this->app->instance(Manifest::class, new Manifest(
			new Filesystem,
			$this->app->basePath(),
			$this->app->bootstrapPath().'/cache/plugins.php'
		));

		// autoload
		$loader = require base_path().'/vendor/autoload.php';
		foreach($manifest->plugins() as $plugin) {
			$loader->setPsr4($plugin['namespace'].'\\', $plugin['directory']);
		}
	}
}
