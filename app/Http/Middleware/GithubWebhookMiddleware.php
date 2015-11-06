<?php

namespace App\Http\Middleware;

use Closure;

class GithubWebhookMiddleware
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
     * Validate the github payload and signature.
     *
     * If you're wondering why the md5, see the link below.
     * @see http://php.net/manual/en/function.hash-hmac.php#111435
     *
     * @param \Illuminate\Http\Request $request
     * @return bool
     */
    private function isValidRequest($request)
    {
        $signature = $request->server('HTTP_X_HUB_SIGNATURE');
        $secret = env('WEBHOOK_SECRET');

        list($algo, $expectedHash) = explode('=', $signature, 2);

        $payloadHash = hash_hmac($algo, $request->getContent(), $secret);

        return md5($expectedHash) === md5($payloadHash);
    }
}
