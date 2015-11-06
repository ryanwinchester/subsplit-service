<?php

namespace App\Http\Middleware;

use Closure;

class GithubWebhookMiddleware
{
    /**
     * Secret key used to authorize requests.
     *
     * @var string
     */
    private $secret;

    /**
     * Instantiate and set the secret key...
     */
    public function __construct()
    {
        $this->secret = env('WEBHOOK_SECRET');
    }

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
     * @see http://php.net/manual/en/function.hash-hmac.php#111435
     *
     * @param \Illuminate\Http\Request $request
     * @return bool
     */
    private function isValidRequest($request)
    {
        $signature = $request->server('HTTP_X_HUB_SIGNATURE');
        list($algo, $hash) = explode('=', $signature, 2);

        $payloadHash = hash_hmac($algo, $request->getContent(), $this->secret);

        return md5($hash) === md5($payloadHash);
    }
}
