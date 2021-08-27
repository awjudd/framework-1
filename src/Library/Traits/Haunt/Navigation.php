<?php
namespace Haunt\Library\Traits\Haunt;

use Illuminate\Support\Collection;

trait Navigation
{
	/**
	 * The admin navigation.
	 * @var \Illuminate\Support\Collection
	 */
	private Collection $navigation;

	/**
	 * Add a navigation child to a parent.
	 *
	 * @param string $parent
	 * @param string $route
	 * @param string $title
	 * @param int $priority
	 * @param array $active
	 * @return bool
	 */
	public function addNavigationChild(string $parent, string $route, string $title, int $priority = 50, array $active = []): bool
	{
		if($this->hasNavigationChild($parent, $route)) {
			return false;
		}

		$this->navigation->get($parent)['active']->push($route);
		foreach($active as $slug) {
			$this->navigation->get($parent)['active']->push($slug);
		}

		$this->navigation->get($parent)['children']->put($route, [
			'route' => $route,
			'title' => $title,
			'priority' => $priority,
			'active' => collect(array_merge([$route], $active)),
		]);

		return true;
	}

	/**
	 * Add a navigation parent item.
	 *
	 * @param string $route
	 * @param string $icon
	 * @param array $children
	 * @param int $priority
	 * @return bool
	 */
	public function addNavigationParent(string $route, string $icon = 'home', array $children = [], int $priority = 50): bool
	{
		if($this->hasNavigationParent($route)) {
			return false;
		}

		$this->navigation->put($route, [
			'active' => collect(),
			'children' => collect(),
			'icon' => $icon,
			'priority' => $priority
		]);

		foreach($children as $child) {
			$this->addNavigationChild(
				$route,
				$child['route'],
				$child['title'],
				$child['priority'] ?? 50,
				$child['active'] ?? []
			);
		}

		return true;
	}

	/**
	 * Check if a navigation child exists.
	 *
	 * @param string $parent
	 * @param string $child
	 * @return bool
	 */
	public function hasNavigationChild(string $parent, string $child): bool
	{
		return !$this->navigation->has($parent) || ($this->navigation->get($parent)['children']->has($child));
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
	 * Build the sub navigation menu.
	 *
	 * @return \Illuminate\Support\Collection
	 */
	public function menu(): \Illuminate\Support\Collection
	{
		$parent = $this->navigation->filter(function($item) {
			return $item['active']->contains(request()->route()->getName());
		})->first();
		return $parent ? $parent['children']->whereNotNull('title')->sortBy('priority') : collect();
	}

	/**
	 * Build the main navigation menu.
	 *
	 * @return \Illuminate\Support\Collection
	 */
	public function navigation(): \Illuminate\Support\Collection
	{
		return $this->navigation->filter(function($item) {
			return $item['children']->isNotEmpty();
		})->sortBy('priority');
	}
}
