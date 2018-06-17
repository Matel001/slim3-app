<?php
require __DIR__ . '/../vendor/autoload.php';
session_start();
$app = new \Slim\App([
    'settings'  =>  [
        'displayErrorDetails'   =>  true
    ]
]);
$container = $app->getContainer();
$container['db'] = function(){
    $pdo =  new PDO('mysql:host=localhost;dbname=t-s;','root', '');

    $pdo -> query ('SET NAMES utf8');
    $pdo -> query ('SET CHARACTER_SET utf8_unicode_ci');
    return $pdo;
};

$container['view'] = function($container){
    $view = new \Slim\Views\Twig(__DIR__ . '/../resources/views', [
        'cache' =>  false
    ]);

    // Instantiate and add Slim specific extension

    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));
    return $view;
};

$container['RoadController'] = function($container){
    return new \App\Controllers\RoadController($container);
};
$container['validator'] = function($container){
    return new \App\Validation\Validator;
};

$app->add(new \App\Middleware\ValidateErrorsMiddleware($container));
require_once  __DIR__ . '/../routes/web.php';