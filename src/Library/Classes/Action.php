<?php
namespace Haunt\Library\Classes;

use LumiteStudios\Action\Action as BaseAction;
use LumiteStudios\Action\Concerns\HandleErrors;
use LumiteStudios\Action\Concerns\HandleRequest;

abstract class Action extends BaseAction
{
	use HandleErrors;
	use HandleRequest;

	/**
	 * Create a new action instance.
	 *
	 * @param array $data 	An array of data to use.
	 * @return void
	 */
	public function __construct(array $data = [])
	{
		config(['database.default' => 'haunt']);
		config(['auth.defaults.guard' => 'haunt']);

		parent::__construct($data);
	}
}
