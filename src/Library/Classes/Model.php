<?php
namespace Haunt\Library\Classes;

use Haunt\Library\Traits\Clean;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Model extends Eloquent
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
		Model::unguard();
	}
}
