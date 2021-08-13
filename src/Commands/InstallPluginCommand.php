<?php
namespace Haunt\Commands;

use Haunt\Library\Command;

class InstallPluginCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'haunt:install-plugin
							{--package= : The plugin to install.}
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

		//$composer = new Composer(new Filesystem);
		//dd($composer->getProcess());

		// check if the plugin is already installed
		if(Plugin::where('package', '=', $package)->first()) {
			return;
		}

		// attempt to download and extract the plugin

		// ALTER LATER: get the data after downloading
		$data = [
			'name' => 'Haunt Core',
			'main' => 'HauntCore\\Plugin',
			'autoload' => [
				'HauntCore\\' => 'src/'
			],
			'priority' => 0,
		];

		$instance = new $data['main'];

		$this->call('haunt:migrate', [
			'--batch' => $data['name'],
			'--path' => $instance->migrations,
		]);

		$state = $instance->activate('1.0.0');

		if(count($state) > 0) {
			$instance->deactivate(true);
			$this->error(array_values($state)[0]);
            return $this;
		}

		// create plugin entry in database
		$plugin = Plugin::create([
			'package' => $package,
			'version' => '1.0.0',
			'data' => json_encode($data),
			'active' => 1
		]);

		$this->info("Installed the {$package} plugin.");
	}
}
