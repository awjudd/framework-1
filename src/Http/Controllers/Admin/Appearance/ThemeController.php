<?php
namespace Haunt\Http\Controllers\Admin\Appearance;

use Haunt\Extend\Controller;

class ThemeController extends Controller
{
	/**
	 * Show the index view.
	 *
	 * @return \Illuminate\View\View
	 */
	public function index(): \Illuminate\View\View
	{
		return view('haunt::appearance.themes.index');
	}
}
