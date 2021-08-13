<?php
namespace Haunt\Providers;

use Illuminate\Support\AggregateServiceProvider;

class HauntServiceProvider extends AggregateServiceProvider
{
	/**
     * The provider class names.
     *
     * @var array
     */
    protected $providers = [
		\Haunt\Providers\AppServiceProvider::class,
		\Haunt\Providers\ConsoleServiceProvider::class,
		// \Haunt\Providers\PluginServiceProvider::class,
	];
}
