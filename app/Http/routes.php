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

    // Github
    $app->post('github', [
        'middleware' => 'github',
        'uses' => 'App\Http\Controllers\WebhooksController@push',
    ]);

    // Bitbucket
    $app->post('bitbucket', [
        'middleware' => 'bitbucket',
        'uses' => 'App\Http\Controllers\WebhooksController@push',
    ]);

    // // Gitlab
    // $app->post('gitlab', [
    //     'middleware' => 'gitlab',
    //     'uses' => 'App\Http\Controllers\WebhooksController@push',
    // ]);

});
