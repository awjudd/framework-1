<?php
namespace Haunt\Extend;

abstract class Plugin
{
	/**
	 * The classes to register.
	 * @var array<string>
	 */
	public array $classes = [];

	/**
	 * The full namespace of this plugin.
	 * @var string
	 */
	protected string $namespace;

	/**
	 * The path location of the migrations.
	 * @var string|null
	 */
	public ?string $migrations = null;

	/**
	 * Get the plugin root directory.
	 * @var string
	 */
	protected string $root;

	/**
	 * The routes the plugin uses.
	 * @var array<string>
	 */
	public array $routes = [
		'admin' => null,
		'game' => null,
	];

    /**
     * A slug to use for the plugin.
     * @var string
     */
    public string $slug;

	/**
	 * The path location of the translations.
	 * @var string|null
	 */
	public ?string $translations = null;

	/**
	 * The path location of the views.
	 * @var string|null
	 */
	public ?string $views = null;

	/**
	 * Create a new plugin instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->namespace = get_called_class();
		$this->root = dirname(dirname((new \ReflectionClass(get_class($this)))->getFileName()));
	}

	/**
	 * Install the plugin.
	 *
	 * @param string $version
	 * @return \Illuminate\Support\Collection
	 */
	abstract public function install(string $version): \Illuminate\Support\Collection;

	/**
	 * Uninstall the plugin.
	 *
	 * @param string $version
	 * @return void
	 */
	abstract public function uninstall(string $version): void;

	/**
	 * Initialise the plugin.
	 *
	 * @return void
	 */
	abstract public function init(): void;
}
