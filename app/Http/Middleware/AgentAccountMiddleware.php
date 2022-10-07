<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AgentAccountMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        abort_if(auth('web')->user()->account_id == 2,'404');

        return $next($request);
    }
}
