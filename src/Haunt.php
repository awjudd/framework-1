<?php
namespace Haunt;

use Illuminate\Support\Collection;

class Haunt
{
	/**
	 * The admin navigation.
	 * @var \Illuminate\Support\Collection
	 */
	private Collection $navigation;

	public function __construct()
	{
		$this->navigation = collect();
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
			$this->addNavigationChild($route, $child['route'], $child['title'], $child['priority'] ?? 50);
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
	public function addNavigationChild(string $parent, string $route, string $title, int $priority = 50): bool
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
	 * @return \Illuminate\Support\Collection
	 */
	public function navigation(): \Illuminate\Support\Collection
	{
		return $this->navigation->sortBy('priority');
	}

	/**
	 * @return \Illuminate\Support\Collection
	 */
	public function menu(): \Illuminate\Support\Collection
	{
		$parent = $this->navigation->filter(function($item) {
			return $item['children']->has(request()->route()->getName());
		})->first();
		return $parent ? $parent['children']->sortBy('priority') : collect();
	}
}
