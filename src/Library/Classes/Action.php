<?php
namespace Haunt\Library\Classes;

use LumiteStudios\Action\Action as BaseAction;
use LumiteStudios\Action\Concerns\HandleErrors;
use LumiteStudios\Action\Concerns\HandleRequest;

abstract class Action extends BaseAction
{
	use HandleErrors;
	use HandleRequest;
}
