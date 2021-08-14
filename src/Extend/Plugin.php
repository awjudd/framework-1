<?php
namespace Haunt\Extend;

abstract class Plugin
{
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
	 * The models to register.
	 * @var array<string>
	 */
	protected array $models = [];

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
    protected string $slug;

	/**
	 * The path location of the translations.
	 * @var string|null
	 */
	protected ?string $translations = null;

	/**
	 * The path location of the views.
	 * @var string|null
	 */
	protected ?string $views = null;

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
	 * Activate a plugin.
	 *
	 * @param string $version
	 * @return \Illuminate\Support\Collection
	 */
	abstract public function activate(string $version): \Illuminate\Support\Collection;

	/**
	 * Deactivate the plugin.
	 *
	 * @return void
	 */
	abstract public function deactivate(): void;

	/**
	 * Initialise the plugin.
	 *
	 * @return void
	 */
	abstract public function init(): void;

	/**
	 * Setup the plugin.
	 *
	 * @return void
	 */
	public function setup(): void
	{
		if($this->views !== null) {
			app('view')->addNamespace($this->slug, $this->views);
		}

		if($this->translations !== null) {
			app('translator')->addNamespace($this->slug, $this->translations);
		}

		foreach($this->models as $name => $class) {
			class_alias($class, '\\Haunt\\Models\\'.$name);
		}
	}
}
