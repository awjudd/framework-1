<?php
namespace Haunt\Plugin;

use Haunt\Plugin\Manifest;
use Haunt\Extend\BasePlugin;
use Illuminate\Support\Collection;

class Repository
{
	/**
	 * The installed plugins.
	 * @var \Illuminate\Support\Collection
	 */
	protected Collection $plugins;

	/**
	 * The slug of the core Haunt plugin.
	 * @var string
	 */
	private string $corePlugin = 'HauntCore';

	/**
	 * Get all the installed plugins.
	 *
	 * @return \Illuminate\Support\Collection
	 */
	public function all(): Collection
	{
		return $this->plugins = $this->plugins ?? app(Manifest::class)->plugins();
	}

	/**
	 * Get a single installed plugin.
	 *
	 * @param string $name
	 * @return array
	 */
	public function get(string $name)
	{
		return $this->has($name) ?: $this->all()->get($name);
	}

	/**
	 * Check if a plugin exists.
	 *
	 * @param string $name
	 * @return boolean
	 */
	public function has(string $name): bool
	{
		return $this->all()->has($name) ?? false;
	}

	/**
	 * Instance a plugin.
	 *
	 * @return \Haunt\Extend\BasePlugin
	 */
	public function instance(array $plugin): BasePlugin
	{
		return $this->has($plugin['name']) ?: new $plugin['main'];
	}

	/**
	 * Get all the installed plugins, bar the
	 * core Haunt plugin.
	 *
	 * @return \Illuminate\Support\Collection
	 */
	public function list(): Collection
	{
		return $this->all()->filter(function($plugin) {
			return $plugin['namespace'] !== $this->corePlugin;
		});
	}
}
