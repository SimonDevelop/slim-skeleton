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

// csrf
$responseFactory = $app->getResponseFactory();
$container->set('csrf', function () use ($responseFactory) {
    $guard = new Guard($responseFactory);
    $guard->setFailureHandler(function (ServerRequestInterface $request, RequestHandlerInterface $handler) {
        $request = $request->withAttribute("csrf_status", false);
        return $handler->handle($request);
    });
    return $guard;
});
