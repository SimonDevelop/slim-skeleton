<?php

use Slim\Views\PhpRenderer;
use Slim\Csrf\Guard;

// Router
$container->set('router', function () use ($app) {
    return $app->getRouteCollector()->getRouteParser();
});

// View
$container->set('view', function () use ($app) {
    return new PhpRenderer(dirname(__DIR__)."/src/Views/");
});

// Csrf
$container->set('csrf', function () use ($app) {
    $guard = new Guard($app->getResponseFactory());
    $guard->setFailureHandler(function (ServerRequestInterface $request, RequestHandlerInterface $handler) {
        $request = $request->withAttribute("csrf_status", false);
        return $handler->handle($request);
    });
    return $guard;
});
