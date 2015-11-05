<?php

$app->get('/', function () use ($app) {
    return 'wut';
});

$app->group([
    'prefix' => 'webhooks',
    'middleware' => 'github',
    'namespace' => 'App\Http\Controllers',
], function ($app) {

    $app->post('push', 'WebhooksController@push');

});
