<?php

if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

// Autoload de composer
require __DIR__ . '/../vendor/autoload.php';

// Configuration slim pour les messages d'erreurs
$configuration = [
  'settings' => [
    'displayErrorDetails' => true,
  ],
];

// Initialisation des paramètres du container slim
$c = new \Slim\Container($configuration);

// Initialisation de Slim
$app = new \Slim\App($c);

// Initialisation des sessions/cookies
if (session_status() == PHP_SESSION_NONE) {
    // 3600 => 1h
    // 21600 => 6h
    // 86400 => 24h
    // session_set_cookie_params(21600);
    session_start();
}

// Le container qui compose nos librairies
require __DIR__ . '/../app/config/container.php';

// Appel des middlewares
require __DIR__ . '/../app/config/middlewares.php';

// Le fichier ou l'on déclare les routes
require __DIR__ . '/../app/config/routes.php';

// Le fichier de configuration des pages d'erreur
require __DIR__ . '/../app/config/error_pages.php';

// Execution de Slim
$app->run();
