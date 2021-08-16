<?php

namespace Haunt\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HauntInit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
		dd('here');
        return $next($request);
    }
}
