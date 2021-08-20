<?php

namespace Haunt\Http\Middleware;

use Closure;
use Haunt\Facades\Haunt;
use Illuminate\Http\Request;

class HauntInstalled
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string $state
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $state = 'true')
    {
		if((Haunt::isInstalled() && $state === 'true') || (!Haunt::isInstalled() && $state === 'false')) {
			return $next($request);
		} else {
			if(Haunt::isInstalled()) {
				return redirect()->route('admin.index');
			} else {
				return redirect()->route('install.index');
			}
		}
    }
}
