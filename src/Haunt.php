<?php
namespace Haunt;

class Haunt
{
	private \Illuminate\Support\Collection $navigation;

	public function __construct()
	{
		$this->navigation = collect([
			[
				'children' => collect([
					[
						'route' => 'admin.index',
						'title' => 'Dashboard',
					]
				]),
				'icon' => 'home',
				'route' => 'admin.index',
				'title' => 'Dashboard',
			],
		]);
	}

	/**
	 * @return \Illuminate\Support\Collection
	 */
	public function navigation(): \Illuminate\Support\Collection
	{
		return $this->navigation;
	}

	/**
	 * @return \Illuminate\Support\Collection
	 */
	public function menu(): \Illuminate\Support\Collection
	{
		return $this->navigation->where('route', request()->route()->getName())->first()['children'];
	}
}
