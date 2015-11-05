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
        return response(\Artisan::call('flashtag:subsplit'));
    }
}

