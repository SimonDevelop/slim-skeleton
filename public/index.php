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

// Configuration slim
$configuration = [
  'settings' => [
    'displayErrorDetails' => true,
    'renderer' => [
        'template_path' => __DIR__ . '/../app/src/Views/',
    ],
  ],
];

// Initialisation des paramètres du container slim
$c = new \Slim\Container($configuration);

// Initialisation de Slim
$app = new \Slim\App($c);

// Initialisation des sessions/cookies
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Le container qui compose nos librairies
require __DIR__ . '/../app/config/container.php';

// Appel des middlewares
require __DIR__ . '/../app/config/middlewares.php';

// Le fichier ou l'on déclare les routes
require __DIR__ . '/../app/config/routes.php';

// Execution de Slim
$app->run();
