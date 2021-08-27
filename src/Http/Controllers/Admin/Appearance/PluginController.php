<?php
namespace Haunt\Http\Controllers\Admin\Appearance;

use Haunt\Extend\Controller;
use Haunt\Entities\Models\Plugin;
use Illuminate\Support\Facades\Artisan;
use Haunt\Http\Requests\Appearance\Plugins\InstallRequest;

class PluginController extends Controller
{
	/**
	 * Show the index view.
	 *
	 * @return \Illuminate\View\View
	 */
	public function index(): \Illuminate\View\View
	{
		$resources = Plugin::all();

		return view('haunt::appearance.plugins.index', [
			'resources' => $resources,
		]);
	}

	/**
	 * Show the create view.
	 *
	 * @return \Illuminate\View\View
	 */
	public function create(): \Illuminate\View\View
	{
		return view('haunt::appearance.plugins.create');
	}

	/**
	 * Handle creating a resource.
	 *
	 * @param \Haunt\Http\Requests\Appearance\Plugins\InstallRequest $request
     * @return \Illuminate\Http\RedirectResponse
	 */
	public function store(InstallRequest $request): \Illuminate\Http\RedirectResponse
	{
		$package = $request->input('package');

		Artisan::call('haunt:install-plugin', [
			'--plugin' => $package
		]);

		return redirect()->back();
	}

	/**
	 * Handle editing a resource.
	 *
     * @return \Illuminate\Http\RedirectResponse
	 */
	public function update(int $id): \Illuminate\Http\RedirectResponse
	{
		$plugin = Plugin::where('id', '=', $id)->firstOrFail();
		$plugin->active = !$plugin->active;
		$plugin->save();

		return redirect()->back();
	}
}
