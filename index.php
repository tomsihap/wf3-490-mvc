<?php

use App\Controller\AnimalController;

use Bramus\Router\Router;

require __DIR__ . '/vendor/autoload.php';
//require __DIR__ . '/config/config.php';

$router = new Router();
$router->setNamespace('App\Controller');

$router->get('/about', function() {
    echo "bienvenue sur la page About!";
});

$router->get('/contact', function () {
    echo "Page contactez-nous.";
});

$router->get('/redirect', function () {
    header('Location: about');
});

$router->get('/animaux', 'AnimalController@index');

$router->run();
