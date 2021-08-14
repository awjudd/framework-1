<?php
namespace Haunt\Extend;

use Haunt\Entities\Models\Plugin;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
	public function __construct()
	{
		Plugin::active()->priority()->get()->each(function($item) {
			$instance = $item->instance();
			$instance->setup();
			$instance->init();
		});
	}
}
