<?php

namespace App\Http\Middleware;

use Closure;

class ExistThread
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $thread_id = $request->route()->parameter('thread_id');
        abort_if(\App\Thread::where('id', $thread_id)->doesntExist(), 404);
        return $next($request);
    }
}
