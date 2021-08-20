<?php

namespace Haunt\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallHauntCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'haunt:install';

    /**
     * The console command description.
     *
     * @var string
     */
	protected $description = 'Install Haunt.';

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
		$this->updateDatabase()
			 ->updateGuards()
			 ->configCache()
             ->initMigrations()
			 ->publishAssets();
	}

	/**
	 * Add the haunt connection to the database config.
	 *
	 * @return \Haunt\Commands\InstallHauntCommand
	 */
	private function updateDatabase(): InstallHauntCommand
	{
		$location = "'connections' => [";
		$path = config_path('database.php');

		if(File::exists($path)) {
			$content = file_get_contents($path);

			// check if the guard already exists
			if(!Str::contains($content, 'haunt')) {
				$start = strpos($content, $location) + strlen($location);

				$build = "
		'haunt' => [
            'driver' => 'mysql',
            'url' => env('HAUNT_DATABASE_URL'),
            'host' => env('HAUNT_DB_HOST', '127.0.0.1'),
            'port' => env('HAUNT_DB_PORT', '3306'),
            'database' => env('HAUNT_DB_DATABASE', 'forge'),
            'username' => env('HAUNT_DB_USERNAME', 'forge'),
            'password' => env('HAUNT_DB_PASSWORD', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => env('HAUNT_DB_PREFIX', ''),
		],
				";
				file_put_contents($path, substr_replace($content, $build, $start, 0));
			}
		}

		return $this;
	}

	/**
	 * Add the haunt connection to the database config.
	 *
	 * @return \Haunt\Commands\InstallHauntCommand
	 */
	private function updateGuards(): InstallHauntCommand
	{
		$location = "'guards' => [";
		$path = config_path('auth.php');

		if(File::exists($path)) {
			$content = file_get_contents($path);

			// check if the guard already exists
			if(!Str::contains($content, 'haunt')) {
				$start = strpos($content, $location) + strlen($location);

				$build = "
		'haunt' => [
			'driver' => 'haunt',
		],
				";
				file_put_contents($path, substr_replace($content, $build, $start, 0));
			}
		}

		return $this;
	}

	/**
	 * Cache the config files.
	 *
	 * @return \Haunt\Commands\InstallHauntCommand
	 */
	private function configCache(): InstallHauntCommand
	{
		$this->call('config:cache');

		return $this;
	}

	/**
	 * Run the default migrations.
	 *
	 * @return \Haunt\Commands\InstallHauntCommand
	 */
	private function initMigrations(): InstallHauntCommand
	{
		$this->call('haunt:migrate');

		return $this;
	}

	/**
	 * Publish the package assets.
	 *
	 * @return \Haunt\Commands\InstallHauntCommand
	 */
	private function publishAssets(): InstallHauntCommand
	{
		$this->call('vendor:publish', [
			'--tag' => 'haunt'
		]);

		$this->call('vendor:publish', [
			'--tag' => 'laravel-blade-tiptap'
		]);

		return $this;
	}
}
