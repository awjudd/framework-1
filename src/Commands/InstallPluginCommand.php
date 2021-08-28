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
							{--version=dev-main : The version of the plugin.}
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
		$version = $this->option('version');

		// check if the plugin has already been installed,
		// and if it has, exit straight away
		if($this->composer->isPackageInstalled($package, $version)) {
			$this->output->writeln("<comment>Plugin Already Installed:</> {$package}");
			return;
		}

		$state = $this->composer->installPackage($package, $version);

		// composer might fail to install, so exit if it has
		if($state === false) {
			$this->output->writeln("<fg=red>Failed to Install Plugin:</> {$package}");
			return;
		}

		// TODO: figure out how to load the installed package class
		// the below didn't work
		$this->composer->dumpOptimized();

		$data = $this->composer->getPluginJsonFile($package);

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
			if(class_exists($package['main'])) {
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
			}
		});

		$plugin->save();

		$this->output->writeln("<info>Plugin Installed:</info> {$plugin->package}");
		return;
	}
}
