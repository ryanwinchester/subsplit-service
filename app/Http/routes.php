<?php

$app->get('/', function () use ($app) {
    app()->abort(404);
});

$app->group(['prefix' => 'webhooks'], function ($app) {

    /*
    |--------------------------------------------------------------------------
    | Define The Webhook Routes
    |--------------------------------------------------------------------------
    |
    | Here, we are defining what webhook routes we want and what middleware is
    | associated with them. You should un-comment the routes you want to use
    | use and also comment out the routes you do not wish to use.
    |
    */

    $app->post('github', ['middleware' => 'github'], 'App\Http\Controllers\WebhooksController@push');

    $app->post('bitbucket', ['middleware' => 'bitbucket'], 'App\Http\Controllers\WebhooksController@push');

    // $app->post('gitlab', ['middleware' => 'gitlab'], 'App\Http\Controllers\WebhooksController@push');

});
