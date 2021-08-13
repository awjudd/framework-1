<?php

namespace Haunt\Commands;

use Illuminate\Console\Command;

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
		$this->configCache()
             ->linkThemes()
			 ->refreshPlugins()
			 ->clearCache();
	}

	/**
	 * Cache the config files.
	 *
	 * @return \Haunt\Commands\InstallHauntCommand
	 */
	private function configCache()
	{
		$this->call('config:cache');

		return $this;
	}

	/**
	 * Link the themes folder.
	 *
	 * @return \Haunt\Commands\InstallHauntCommand
	 */
	private function linkThemes()
	{
		$this->call('haunt:link-themes');

		return $this;
	}

	/**
	 * Refresh the plugins manifest.
	 *
	 * @return \Haunt\Commands\InstallHauntCommand
	 */
	private function refreshPlugins()
	{
		$this->call('haunt:refresh-plugins');

		return $this;
	}

	/**
	 * Clear the cache.
	 *
	 * @return \Haunt\Commands\InstallHauntCommand
	 */
	private function clearCache()
	{
		$this->call('cache:clear');

		return $this;
	}
}
