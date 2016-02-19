<?php

namespace App\Http\Controllers;

use App\Jobs\Subsplit;

class WebhooksController extends Controller
{
    /**
     * Handle a push request.
     *
     * @return \Laravel\Lumen\Http\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function push()
    {
        $this->dispatch(new Subsplit());

        return response("queued");
    }
}
