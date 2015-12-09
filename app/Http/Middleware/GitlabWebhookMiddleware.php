<?php

namespace App\Http\Middleware;

use Closure;

class GitlabWebhookMiddleware
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
        if ($this->isValidRequest($request)) {
            return $next($request);
        }

        return response("fail", 401);
    }

    /**
     * Validate the gitlab webhook request.
     *
     * @param \Illuminate\Http\Request $request
     * @return bool
     */
    private function isValidRequest($request)
    {
        // TODO: If there ever is a way to validate the request, add it here.

        return true;
    }
}
