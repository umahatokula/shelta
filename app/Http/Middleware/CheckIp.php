<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckIp
{
    public $whiteListedIps = [
        '192.168.0.5'
    ];

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!in_array($request->getClientIp(), $this->whiteListedIps)) {
            abort(403, "You are restricted to access the site.");
        }

        return $next($request);
    }
}
