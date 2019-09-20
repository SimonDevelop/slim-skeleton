<?php

if (PHP_SAPI == 'cli-server') {
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];

    // check the file types, only serve standard files
    if (preg_match('/\.(?:png|js|jpg|jpeg|gif|css)$/', $file)) {
        // does the file exist? If so, return it
        if (is_file($file))
            return false;

        // file does not exist. return a 404
        header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found');
        printf('"%s" does not exist', $_SERVER['REQUEST_URI']);
        return false;
    }
}

use DI\Container;
use Slim\Factory\AppFactory;

// Set the absolute path to the root directory.
$rootPath = realpath(dirname(__DIR__));

// Autoload de composer
require $rootPath . '/vendor/autoload.php';

// Initialisation de la session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Create Container
$container = new Container();
AppFactory::setContainer($container);

// Create App
$app = AppFactory::create();
$app->addRoutingMiddleware();
$app->addBodyParsingMiddleware();
$displayErrors = true;
$app->addErrorMiddleware($displayErrors, false, false);

// Le container qui compose nos librairies
require $rootPath . '/app/config/container.php';

// Appel des middlewares
require $rootPath . '/app/config/middlewares.php';

// Le fichier ou l'on déclare les routes
require $rootPath . '/app/config/routes.php';

// Execution de Slim
$app->run();
