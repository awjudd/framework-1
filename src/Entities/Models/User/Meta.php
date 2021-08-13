<?php
namespace Haunt\Entities\Models\User;

use Haunt\Library\Classes\Models\Model;
use Haunt\Entities\Observers\User\MetaObserver;

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
 */
class Meta extends Model
{
    /**
     * The attributes that should be cast.
     * @var array<string>
     */
    protected $casts = [
        //
	];

	/**
	 * The database table used by the model.
	 * @var string
	 */
	protected $table = 'users_metadata';

	/**
	 * The identifier to use in a url.
	 * @var string
	 */
	protected $urlIdentifier = 'id';
}
