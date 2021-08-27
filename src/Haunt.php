<?php
namespace Haunt;

use Haunt\Entities\Models\Plugin;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Haunt\Library\Traits\Haunt\Navigation;

class Haunt
{
	use Navigation;

	/**
	 *
	 */
	private ?string $authModel = null;

	/**
	 * The path to the auth storage file.
	 * @var string
	 */
	private string $authStorage;

	/**
	 * The models to register.
	 * @var array
	 */
	private array $classes;

	/**
	 * Create a new Haunt instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->authModel = \Haunt\Entities\Models\User::class;
		$this->authStorage = storage_path('app/private/auth.json');
		$this->navigation = collect();
	}

	/**
	 * Check if Haunt is installed.
	 *
	 * @return bool
	 */
	public function isInstalled(): bool
	{
		return boolval(config('haunt.installed'));
	}

	/**
	 * Check if a database connection can be made.
	 *
	 * @return bool
	 */
	public function canMakeDatabaseConnection(): bool
	{
		config(['database.default' => 'haunt']);

		try {
			DB::connection()->getPdo();
			return true;
		} catch(\Exception $e) {
			return false;
		}
	}

	/**
	 * Check if the site has been setup.
	 *
	 * @return bool
	 */
	public function hasSetupSite(): bool
	{
		return File::exists($this->getAuthStorage());
	}

	/**
	 * Set an environment variable.
	 *
	 * @param string $name
	 * @param string $value
	 * @return void
	 */
	public function setEnvironmentValue(string $name, string $value): void
	{
		$path = app()->environmentPath().'/'.app()->environmentFile();
		if(file_exists($path)) {
			file_put_contents($path, replaceBetween(file_get_contents($path), $name, "\n", "={$value}"));
		}
	}

	/**
	 * Get the auth model class.
	 *
	 * @return string|null
	 */
	public function getAuthModel(): ?string
	{
		return $this->authModel;
	}

	/**
	 * Set the auth model class.
	 *
	 * @return void
	 */
	public function setAuthModel(string $class): void
	{
		$this->authModel = $class;
	}

	/**
	 * Get the auth storage file location.
	 *
	 * @return string
	 */
	public function getAuthStorage(): string
	{
		return $this->authStorage;
	}

	/**
	 * Setup Haunt.
	 *
	 * @return void
	 */
	public function setup(): void
	{
		$this->addClass('Extend\\Action', \Haunt\Library\Classes\Action::class);
		$this->addClass('Extend\\Authenticatable', \Haunt\Library\Classes\Authenticatable::class);
		$this->addClass('Extend\\Controller', \Haunt\Library\Classes\Controller::class);
		$this->addClass('Extend\\Model', \Haunt\Library\Classes\Model::class);
		$this->addClass('Extend\\Observer', \Haunt\Library\Classes\Observer::class);

		$this->addNavigationParent('dashboard', 'home', [], 0);
		$this->addNavigationParent('appearance', 'color-swatch', [
			['route' => 'admin.appearance.themes.index', 'title' => __('haunt::appearance/themes.titles.index'), 'priority' => 10, 'active' => [

			]],
			['route' => 'admin.appearance.plugins.index', 'title' => __('haunt::appearance/plugins.titles.index'), 'priority' => 20, 'active' => [
				'admin.appearance.plugins.create'
			]],
		], 100);
	}

	/**
	 * Initialise Haunt.
	 *
	 * @return void
	 */
	public function init(): void
	{
		$this->setup();

		if($this->isInstalled()) {
			$plugins = Plugin::active()->priority()->get();

			$plugins->each(function($item) {
				$item->instances()->each(functioN($instance) {
					if($instance->views !== null) {
						app('view')->addNamespace($instance->slug, $instance->views);
					}
					if($instance->translations !== null) {
						app('translator')->addNamespace($instance->slug, $instance->translations);
					}
					$this->classes = array_merge($this->classes, $instance->classes);
				});
			});

			$this->registerClasses();

			$plugins->each(function($item) {
				$item->instances()->each(functioN($instance) {
					$instance->init();
				});
			});
		} else {
			$this->registerClasses();
		}
	}

	/**
	 * Register the models.
	 *
	 * @return void
	 */
	private function registerClasses(): void
	{
		foreach($this->classes as $name => $class) {
			if(!class_exists("\\Haunt\\{$name}", false)) {
				class_alias($class, "\\Haunt\\{$name}");
			}
		}
	}

	/**
	 * Add a class to register.
	 *
	 * @param string $Name
	 * @param string $class
	 * @return void
	 */
	public function addClass(string $name, string $class): void
	{
		$this->classes[$name] = $class;
	}
}
