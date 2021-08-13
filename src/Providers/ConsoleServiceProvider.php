<?php
namespace Haunt\Providers;

use Illuminate\Support\ServiceProvider;

class ConsoleServiceProvider extends ServiceProvider
{
	/**
	 * The commands to register.
	 * @var array<string>
	 */
	private $commands = [
		\Haunt\Commands\InstallHauntCommand::class,
		\Haunt\Commands\InstallPluginCommand::class,
		\Haunt\Commands\MigrateCommand::class,
	];

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->commands($this->commands);
	}
}
