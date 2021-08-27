<?php
namespace Haunt\Entities\Models;

use Haunt\Library\Classes\Model;

class Plugin extends Model
{
    /**
     * The attributes that should be cast.
     * @var array<string>
     */
    protected $casts = [
        'active' => 'boolean',
		'requires' => 'array',
	];

	/**
	 * The identifier to use for routing.
	 * @var string
	 */
	public string $routeIdentifier = 'id';

	/**
	 * The database table used by the model.
	 * @var string
	 */
	protected $table = 'plugins';

	/**
	 * Only fetch the active plugins.
	 *
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param bool $state
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopeActive(\Illuminate\Database\Eloquent\Builder $query, bool $state = true): \Illuminate\Database\Eloquent\Builder
	{
		return $query->where('active', '=', $state);
	}

	/**
	 * Fetch the plugins by their priority.
	 *
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param string $direction
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopePriority(\Illuminate\Database\Eloquent\Builder $query, string $direction = 'ASC'): \Illuminate\Database\Eloquent\Builder
	{
		return $query->orderBy('priority', $direction);
	}

	/**
	 * Create a new instance of this plugin.
	 *
	 * @return \Illuminate\Support\Collection
	 */
	public function instances(): \Illuminate\Support\Collection
	{
		return $this->packages()->map(function($package) {
			return new $package['main'];
		});
	}

	/**
	 * Create a new instance of this plugin.
	 *
	 * @return \Illuminate\Support\Collection
	 */
	public function packages(): \Illuminate\Support\Collection
	{
		$packages = collect();
		$packages->push($this->toArray());
		foreach($this->requires as $require) {
			$packages->push($require);
		}
		return $packages;
	}
}
