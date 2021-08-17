<?php
namespace Haunt;

use Haunt\Entities\Models\Plugin;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

class Haunt
{
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
	 * The admin navigation.
	 * @var \Illuminate\Support\Collection
	 */
	private Collection $navigation;

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

		$this->addNavigationParent('admin.index', __('haunt::dashboard/home.titles.index'), [
		], 'home', 0);
		$this->addNavigationParent('admin.appearance.themes.index', __('haunt::appearance/themes.titles.index'), [
			['route' => 'admin.appearance.plugins.index', 'title' => __('haunt::appearance/plugins.titles.index'), 'priority' => 10],
			['route' => 'admin.appearance.plugins.create'],
		], 'color-swatch', 100);
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
				$instance = $item->instance();
				if($instance->views !== null) {
					app('view')->addNamespace($instance->slug, $instance->views);
				}
				if($instance->translations !== null) {
					app('translator')->addNamespace($instance->slug, $instance->translations);
				}
				$this->classes = array_merge($this->classes, $instance->classes);
			});

			$this->registerClasses();

			$plugins->each(function($item) {
				$instance = $item->instance();
				$instance->init();
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

	/**
	 * Add a navigation parent item.
	 *
	 * @param string $route
	 * @param string $title
	 * @param array $children
	 * @param string $icon
	 * @param int $priority
	 * @return bool
	 */
	public function addNavigationParent(string $route, string $title, array $children = [], string $icon = 'home', int $priority = 50): bool
	{
		if($this->hasNavigationParent($route)) {
			return false;
		}

		$this->navigation->put($route, [
			'route' => $route,
			'title' => $title,
			'children' => collect(),
			'icon' => $icon,
			'priority' => $priority
		]);

		$this->addNavigationChild($route, $route, $title, 0);
		foreach($children as $child) {
			$this->addNavigationChild($route, $child['route'], $child['title'] ?? null, $child['priority'] ?? 50);
		}

		return true;
	}

	/**
	 * Add a navigation child to a parent.
	 *
	 * @param string $parent
	 * @param string $route
	 * @param string $title
	 * @param int $priority
	 * @return bool
	 */
	public function addNavigationChild(string $parent, string $route, ?string $title = null, int $priority = 50): bool
	{
		if($this->hasNavigationChild($parent, $route)) {
			return false;
		}

		$this->navigation->get($parent)['children']->put($route, [
			'route' => $route,
			'title' => $title,
			'priority' => $priority,
		]);

		return true;
	}

	/**
	 * Check if a navigation parent exists.
	 *
	 * @param string $route
	 * @return bool
	 */
	public function hasNavigationParent(string $route): bool
	{
		return $this->navigation->has($route);
	}

	/**
	 * Check if a navigation child exists.
	 *
	 * @param string $parent
	 * @param string $route
	 * @return bool
	 */
	public function hasNavigationChild(string $parent, string $route): bool
	{
		return !$this->navigation->has($parent) || ($this->navigation->get($parent)['children']->has($route));
	}

	/**
	 * Build the main navigation menu.
	 *
	 * @return \Illuminate\Support\Collection
	 */
	public function navigation(): \Illuminate\Support\Collection
	{
		return $this->navigation->sortBy('priority');
	}

	/**
	 * Build the sub navigation menu.
	 *
	 * @return \Illuminate\Support\Collection
	 */
	public function menu(): \Illuminate\Support\Collection
	{
		$parent = $this->navigation->filter(function($item) {
			return $item['children']->has(request()->route()->getName());
		})->first();
		return $parent ? $parent['children']->whereNotNull('title')->sortBy('priority') : collect();
	}
}
