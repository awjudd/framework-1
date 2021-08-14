<?php
namespace Haunt\Commands;

use Haunt\Library\Command;
use Illuminate\Support\Composer;
use Haunt\Entities\Models\Plugin;
use Illuminate\Filesystem\Filesystem;

class InstallPluginCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'haunt:install-plugin
							{--package=haunt-pet/plugin-core : The plugin to install.}
							';

    /**
     * The console command description.
     *
     * @var string
     */
	protected $description = 'Install a Haunt plugin.';

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
		$package = $this->option('package');

		// check if the plugin is already installed
		if(Plugin::where('package', '=', $package)->first()) {
			$this->output->writeln("<comment>Plugin Already Installed:</> {$package}");
			return;
		}

		// TODO: install package from composer

		// create a plugin instance
		$plugin = new Plugin;
		$plugin->package = $package;
		$plugin->main = 'HauntCore\\Plugin';
		$plugin->name = 'HauntCore';
		$plugin->version = '1.0.0';
		$plugin->priority = '1';
		$plugin->active = true;

		$instance = $plugin->instance();

		// check if any migrations need to run
		if($instance->migrations) {
			$this->call('haunt:migrate', [
				'--batch' => $plugin->package,
				'--path' => $instance->migrations,
			]);
		}

		// attempt to activate the plugin
		$state = $instance->activate($plugin->version);

		// check if there were any errors
		if($state->count() > 0) {
			$instance->deactivate();
			$this->output->writeln("<error>Failed to Activate Plugin:</error> {$state->first()}");
			return;
		}

		// save the plugin model
		$plugin->save();

		$this->output->writeln("<info>Plugin Installed:</info> {$plugin->package}");
		return;
	}
}
