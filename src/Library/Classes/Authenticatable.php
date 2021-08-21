<?php
namespace Haunt\Library\Classes;

use Illuminate\Foundation\Auth\User as AuthUser;

class Authenticatable extends AuthUser
{
    /**
     * The connection name for the model.
     *
     * @var string|null
     */
    protected $connection= 'haunt';

	/**
	 * The "booting" method of the model.
	 *
	 * @return void
	 */
	protected static function boot()
	{
		parent::boot();
		Model::unguard();
	}
}
