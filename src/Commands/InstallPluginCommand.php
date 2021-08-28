<?php
namespace Haunt\Commands;

use Haunt\Facades\Haunt;
use Haunt\Library\Classes\Command;
use Haunt\Entities\Models\Plugin;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Process\Process;

class InstallPluginCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'haunt:install-plugin
							{--package=haunt/plugin-core : The plugin to install.}
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

		// check if the plugin has already been installed
		if($this->composer->isPackageInstalled($package)) {
			$this->output->writeln("<comment>Plugin Already Installed:</> {$package}");
			return;
		}

		// install the plugin
		$state = $this->composer->installPackage($package);

		// check if the plugin was installed without any errors
		if($state === false) {
			$this->output->writeln("<fg=red>Failed to Install Plugin:</> {$package}");
			return;
		}

		// get the "plugin.json" data
		$data = $this->composer->getPluginJsonFile($package);

		// create a plugin model instance
		if($plugin = Plugin::where('package', '=', $package)->first()) {
			// is the version already installed?
			if($plugin->version === $data['version']) {
				$this->output->writeln("<comment>Plugin Already Installed:</> {$plugin->plugin}");
				return;
			} else {
				$plugin->version = $data['version'];
			}
		} else {
			$plugin = new Plugin;
			$plugin->package = $package;
			$plugin->main = $data['main'];
			$plugin->name = $data['name'];
			$plugin->version = $data['version'];
			$plugin->priority = $data['priority'];
			$plugin->active = true;
		}

		// build the requires
		$requires = [];
		if(array_key_exists('requires', $data)) {
			foreach($data['requires'] as $require) {
				$requires[$require] = $this->composer->getPluginJsonFile($require);
			}
		}
		$plugin->requires = $requires;

		$plugin->packages()->each(function($package) use($plugin) {
			$instance = new $package['main'];
			if($instance->migrations) {
				$this->call('haunt:migrate', [
					'--batch' => $plugin->package,
					'--path' => $instance->migrations,
				]);
			}

			// attempt to activate the plugin
			$state = $instance->install($package['version'] ?? $plugin->version);

			// check if there were any errors
			if($state->count() > 0) {
				$instance->uninstall();
				$this->output->writeln("<fg=red>Failed to Activate Plugin:</> {$state->first()}");
				return;
			}
		});

		$plugin->save();

		$this->output->writeln("<info>Plugin Installed:</info> {$plugin->package}");
		return;
	}
}
