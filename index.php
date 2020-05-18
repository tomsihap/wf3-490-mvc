<?php

use Bramus\Router\Router;

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/config/config.php';

$router = new Router;


$router->get('/accueil', function() {
    echo "Hello world !";
});

$router->get('/articles', function () {
    include __DIR__ . '/affichage.php';
});

$router->get('/animaux', AnimalController::list());

$router->run();