<?php
namespace Haunt\Library\Classes;

use Haunt\Library\Traits\Clean;
use Illuminate\Foundation\Auth\User as AuthUser;

class Authenticatable extends AuthUser
{
	use Clean;

    /**
     * The connection name for the model.
     *
     * @var string|null
     */
    protected $connection = 'haunt';

	/**
	 * The "booting" method of the model.
	 *
	 * @return void
	 */
	protected static function boot()
	{
		parent::boot();
		Authenticatable::unguard();
	}
}
