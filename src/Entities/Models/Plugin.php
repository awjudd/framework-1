<?php
namespace Haunt\Entities\Models;

use Haunt\Extend\Model;

/**
 * Haunt\Entities\Models\User\Meta
 *
 * Properties
 * @property int $id
 * @property string $created_at
 * @property string $updated_at
 *
 * Attributes
 * @property string $url
 *
 * Relations
 *
 * Methods
 * @method \Haunt\Extend\BasePlugin instance()
 */
class Plugin extends Model
{
    /**
     * The attributes that should be cast.
     * @var array<string>
     */
    protected $casts = [
        'active' => 'boolean',
	];

	/**
	 * The database table used by the model.
	 * @var string
	 */
	protected $table = 'plugins';

	/**
	 * The identifier to use in a url.
	 * @var string
	 */
	protected $urlIdentifier = 'id';

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
	 * @return \Haunt\Extend\BasePlugin
	 */
	public function instance()
	{
		return new $this->main;
	}
}
