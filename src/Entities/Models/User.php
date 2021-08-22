<?php
namespace Haunt\Entities\Models;

use Haunt\Extend\Authenticatable;

class User extends Authenticatable
{
	/**
	 * The database table used by the model.
	 * @var string
	 */
	protected $table = '';

	/**
	 * Get the user's full username.
	 *
	 * @return string
	 */
	public function getFullUsernameAttribute(): string
	{
		return "{$this->username}";
	}
}
