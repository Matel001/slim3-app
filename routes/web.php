<?php

use App\Controllers\RoadController;
use App\Controllers\MainController;

use App\Controllers\LoginController;

$app->get('/', LoginController::class . ':login');
$app->get('/main', MainController::class . ':index')->setName('main');

$app->get('/add-road', RoadController::class . ':get')->setName('add.road');
$app->post('/add-road', RoadController::class . ':post');

$app->get('/roads', RoadController::class . ':show');