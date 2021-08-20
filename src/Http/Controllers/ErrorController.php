<?php
namespace Haunt\Http\Controllers;

use Haunt\Extend\Controller;

class ErrorController extends Controller
{
	public function index(string $route = '/')
	{
		dd($route);
	}
}
