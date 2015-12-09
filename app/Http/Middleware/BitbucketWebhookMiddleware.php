<?php

namespace App\Http\Middleware;

use Closure;

class BitbucketWebhookMiddleware
{
    /**
     * Bitbucket IP ranges.
     * @see https://confluence.atlassian.com/bitbucket/manage-webhooks-735643732.html#ManageWebhooks-trigger_webhookTriggeringWebhooks
     *
     * @var array
     */
    private $ranges = [
        '131.103.20.160/27',
        '165.254.145.0/26',
        '104.192.143.0/24',
    ];

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
     * Validate the bitbucket ip range.
     *
     * @param \Illuminate\Http\Request $request
     * @return bool
     */
    private function isValidRequest($request)
    {
        foreach ($this->ranges as $range) {
            if (! $this->ipInRange($request->ip(), $range)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Check if a given ip is in a network.
     *
     * @see https://gist.github.com/ryanwinchester/578c5b50647df3541794
     *
     * @param  string $ip     IP to check in IPV4 format eg. 127.0.0.1
     * @param  string $range  IP/CIDR netmask eg. 127.0.0.0/24, also 127.0.0.1 is accepted and /32 assumed
     * @return bool           true if the ip is in this range / false if not.
     */
    function ipInRange($ip, $range)
    {
    	if (strpos($range, '/') == false) {
    		$range .= '/32';
    	}

    	// $range is in IP/CIDR format eg 127.0.0.1/24
    	list($range, $netmask) = explode('/', $range, 2);

        $ip_decimal = ip2long($ip);
        $range_decimal = ip2long($range);
    	$wildcard_decimal = pow(2, (32 - $netmask)) - 1;
    	$netmask_decimal = ~ $wildcard_decimal;

    	return (($ip_decimal & $netmask_decimal) == ($range_decimal & $netmask_decimal));
    }
}
