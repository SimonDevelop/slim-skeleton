<?php

use App\Middlewares;

// Middleware pour les message d'alert en session
$app->add(new Middlewares\AlertMiddleware($container->view->getEnvironment()));

// Middleware pour la sauvegarde des champs de saisi
$app->add(new Middlewares\OldMiddleware($container->view->getEnvironment()));

// Middleware pour la génération de token
$app->add(new Middlewares\TokenMiddleware($container->view->getEnvironment()));

// Middleware pour la vérification csrf
$app->add(new Middlewares\CsrfMiddleware($container->view->getEnvironment(), $container->csrf));
$app->add($container->csrf);
