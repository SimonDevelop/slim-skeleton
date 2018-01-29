<?php

$container = $app->getContainer();

// View renderer
$container['renderer'] = function ($configuration) {
    return new Slim\Views\PhpRenderer($configuration['settings']['renderer']['template_path']);
};

// Csrf
$container['csrf'] = function () {
    $guard = new \Slim\Csrf\Guard();
    $guard->setFailureCallable(function ($request, $response, $next) {
        $request = $request->withAttribute("csrf_status", false);
        return $next($request, $response);
    });
    return $guard;
};
