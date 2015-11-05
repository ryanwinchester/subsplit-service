<?php

$app->get('/', function () use ($app) {
    app()->abort(404);
});

$app->group(['prefix' => 'webhooks', 'middleware' => 'github'], function ($app) {

    $app->post('push', 'App\Http\Controllers\WebhooksController@push');

});
