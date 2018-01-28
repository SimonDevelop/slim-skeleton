<?php

use App\Controllers\HomeController;

$app->get('/', HomeController::class. ':getHome')->setName('home');
$app->post('/', HomeController::class. ':postHome');
