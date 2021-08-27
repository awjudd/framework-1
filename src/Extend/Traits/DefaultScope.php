<?php
namespace Haunt\Extend\Traits;

trait DefaultScope
{
	/**
	 * Get the default.
	 *
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param bool $state
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopeDefault(\Illuminate\Database\Eloquent\Builder $query, bool $state = true): \Illuminate\Database\Eloquent\Builder
	{
		return $query->where('default', '=', $state);
	}
}
