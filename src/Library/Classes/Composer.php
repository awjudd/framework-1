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
		parent::__construct(new Filesystem(), base_path());
		$this->path = base_path('composer.lock');
	}

	/**
	 * Get a plugin's json data.
	 *
	 * @param string $plugin
	 * @return array
	 */
	public function getPluginJsonFile(string $plugin): array
	{
        $installed = $this->getInstalledPackage($plugin);
		$path = base_path("vendor/{$plugin}/plugin.json");

		if(!File::exists($path)) {
			dd('file not found');
		}

		$data = json_decode(file_get_contents($path), true);
		$data['version'] = Str::after($installed['version'], 'v');
		return $data;
	}

	/**
	 * Install a package.
	 *
	 * @param string $package
	 * @param string $version
	 * @return bool
	 */
	public function installPackage(string $package, string $version): bool
	{
		try {
			$this->runCommand(['require', "{$package}:{$version}"]);
			return true;
		} catch(ProcessFailedException $exception) {
			return false;
		}
	}

	/**
	 * Check if a package is installed.
	 *
	 * @param string $package
	 * @param string $version
	 * @return bool
	 */
	public function isPackageInstalled(string $package, string $version): bool
	{
		return $this->getInstalledPackage($package, $version) !== null;
	}

	/**
	 * Get an installed package.
	 *
	 * @param string $package
	 * @param string|null $version
	 * @return array
	 */
	private function getInstalledPackage(string $package, ?string $version = null): ?array
	{
		// TODO: version
        return collect(json_decode($this->files->get($this->path), true)['packages'])
            ->keyBy('name')
            ->get($package);
	}

	/**
	 * Run a command.
	 *
	 * @param array $command
	 * @return bool
	 * @throws \Symfony\Component\Process\Exception\ProcessFailedException
	 */
	private function runCommand(array $command = []): bool
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
