<?php
namespace Haunt\Http\Controllers\Admin;

use Haunt\Extend\Controller;

class HomeController extends Controller
{
	public function index()
	{
		return view('haunt::dashboard.index');
	}
}
