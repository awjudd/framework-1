<?php
namespace Haunt\Library\Classes;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Process\Process;
use Illuminate\Support\Composer as BaseComposer;
use Symfony\Component\Process\Exception\ProcessFailedException;

class Composer extends BaseComposer
{
	protected string $path;

	/**
	 * Create a new Composer instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct(new Filesystem());
		$this->path = base_path('composer.lock');
	}

	/**
	 * Install a package.
	 *
	 * @param string $package
	 * @return bool
	 */
	public function installPackage(string $package): bool
	{
		try {
			$this->runCommand(['require', $package]);
			return true;
		} catch(ProcessFailedException $exception) {
			dd($exception);
			return false;
		}
	}

	/**
	 * Check if a package is installed.
	 *
	 * @param string $package
	 * @return bool
	 */
	public function isPackageInstalled(string $package): bool
	{
		return $this->getInstalledPackage($package) !== null;
	}

	public function getPluginJsonFile(string $plugin): array
	{
        $installed = $this->getInstalledPackage($plugin);
		$path = base_path("vendor/{$plugin}/plugin.json");

		if(!File::exists($path)) {
			dd('failed');
		}

		$data = json_decode(file_get_contents($path), true);
		$data['version'] = Str::after($installed['version'], 'v');
		return $data;
	}

	private function getInstalledPackage(string $package): ?array
	{
        return collect(json_decode($this->files->get($this->path), true)['packages'])
            ->keyBy('name')
            ->get($package);
	}

	private function runCommand(array $command = [])
	{
		$command = array_merge($this->findComposer(), $command);
		$process = $this->getProcess($command);
		$process->run();

		if($process->isSuccessful()) {
			return true;
		} else {
			throw new ProcessFailedException($process);
		}
	}
}
