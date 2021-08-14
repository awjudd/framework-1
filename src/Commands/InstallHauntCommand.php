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
             ->initMigrations()
			 ->installCore();
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
	 * Run the default migrations.
	 *
	 * @return \Haunt\Commands\InstallHauntCommand
	 */
	private function initMigrations()
	{
		$this->call('haunt:migrate');

		return $this;
	}

	/**
	 * Install the "haunt-pet/plugin-core" plugin.
	 *
	 * @return \Haunt\Commands\InstallHauntCommand
	 */
	private function installCore()
	{
		$this->call('haunt:install-plugin', [
			'--package' => 'haunt-pet/plugin-core'
		]);

		return $this;
	}
}
