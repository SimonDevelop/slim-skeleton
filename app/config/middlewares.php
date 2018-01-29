<?php

use App\Middlewares;

// Middleware pour les messages flash en session
$app->add(new Middlewares\AlertMiddleware());

// Middleware pour la génération de token
$app->add(new Middlewares\TokenMiddleware());

// Middleware csrf
$app->add($container->get('csrf'));
