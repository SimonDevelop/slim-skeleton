<?php

$container = $app->getContainer();

// Twig
$container['view'] = function ($container) {
    $pathView = dirname(dirname(__DIR__));

    $view = new \Slim\Views\Twig($pathView.'/app/src/Views', [
    'cache' => $pathView.'/app/cache',
    'debug' => true
  ]);

    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));
    $view->addExtension(new Twig_Extension_Debug());

    return $view;
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
