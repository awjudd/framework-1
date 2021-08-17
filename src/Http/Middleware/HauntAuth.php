<?php

namespace Haunt\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HauntAuth
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
		if($state === 'true') {
			if(auth()->guard('haunt')->check()) {
				return $next($request);
			} else {
				return redirect()->route('admin.login');
			}
		} elseif($state === 'false') {
			if(auth()->guard('haunt')->check()) {
				return redirect()->route('admin.index');
			} else {
				return $next($request);
			}
		}
		return redirect()->route('admin.login');
    }
}
