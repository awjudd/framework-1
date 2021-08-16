<?php
namespace Haunt\Entities\Models;

use Haunt\Library\Classes\Model;

/**
 * Haunt\Entities\Models\Theme
 *
 * Properties
 * @property int $id
 * @property string $package
 * @property string $name
 * @property string $version
 * @property bool $active
 * @property string $created_at
 * @property string $updated_at
 *
 * Attributes
 * @property string $url
 *
 * Relations
 *
 * Methods
 */
class Theme extends Model
{
    /**
     * The attributes that should be cast.
     * @var array<string>
     */
    protected $casts = [
        'active' => 'boolean',
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
	protected $table = 'themes';
}
