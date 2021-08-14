<?php
namespace Haunt\Extend;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Authenticatable extends Eloquent
{
	/**
	 * The "booting" method of the model.
	 *
	 * @return void
	 */
	protected static function boot()
	{
		parent::boot();
		Model::unguard();
		Model::preventLazyLoading();
	}
}
