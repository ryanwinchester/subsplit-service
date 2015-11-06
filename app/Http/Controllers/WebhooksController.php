<?php

namespace App\Http\Controllers;

class WebhooksController extends Controller
{
    /**
     * Handle a push request.
     *
     * @return \Laravel\Lumen\Http\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function push()
    {
        $exitCode = \Artisan::call('flashtag:subsplit');

        if ($exitCode !== 0) {
            return response("There was a problem with the subsplit command.", 500);
        }

        return response("ok");
    }
}
