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
		$this->updateGuards()
			 ->configCache()
             ->initMigrations();
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
	 * Install the "haunt-pet/plugin-core" plugin.
	 *
	 * @return \Haunt\Commands\InstallHauntCommand
	 */
	private function installCore(): InstallHauntCommand
	{
		$this->call('haunt:install-plugin', [
			'--package' => 'haunt-pet/plugin-core'
		]);

		return $this;
	}
}
