<?php
namespace Haunt\Extend;

class BasePlugin
{
	/**
	 * The full namespace of this plugin.
	 * @var string
	 */
	protected string $namespace;

	/**
	 * Get the plugin root directory.
	 * @var string
	 */
	protected string $root;

	/**
	 * The routes the plugin uses.
	 * @var array
	 */
	public array $routes = [];

	/**
	 * Constructor.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->namespace = get_called_class();
		$this->root = dirname((new \ReflectionClass(get_class($this)))->getFileName());
	}
}
