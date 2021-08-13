<?php
namespace Haunt\Library;

use Illuminate\Console\Command as BaseCommand;

class Command extends BaseCommand
{
    /**
     * The filesystem instance.
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected \Illuminate\Filesystem\Filesystem $files;

	/**
	 * The direct path.
	 * @var string
	 */
	protected $root = __DIR__.'/../..';

	/**
	 * The location of the stubs.
	 * @var string
	 */
	protected string $stubDirectory;

	/**
     * Create a new controller creator command instance.
     *
     * @param \Illuminate\Filesystem\Filesystem 	$files
     * @return void
     */
    public function __construct(\Illuminate\Filesystem\Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
		$this->stubDirectory = $this->root.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Commands'.DIRECTORY_SEPARATOR.'stubs'.DIRECTORY_SEPARATOR;
    }

    /**
     * Get the path to a stub.
     *
     * @param string $stub
     * @return string
     */
    protected function getStub(string $stub): string
    {
        return $this->stubDirectory.$stub;
    }

    /**
     * Get the path to a file for a plugin.
     *
     * @param string $file
     * @return string
     */
    protected function pluginPath(string $file = null): string
    {
        $path = plugin_path($this->plugin);

        if($file) {
            $path .= '/'.$file;
        }

        return $path;
    }
}
