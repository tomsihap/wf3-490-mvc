<?php

use Bramus\Router\Router;

$router = new Router();
$router->setNamespace('App\Controller');

$router->get('/animal', 'AnimalController@index');
$router->get('/animal/(\d+)', 'AnimalController@show');
$router->get('/animal/create', 'AnimalController@create');
$router->post('/animal', 'AnimalController@new');
$router->get('/animal/(\d+)/edit', 'AnimalController@edit');
$router->post('/animal/(\d+)/edit', 'AnimalController@update');
$router->post('/animal/(\d+)/delete', 'AnimalController@delete');

$router->get('/zoo', 'ZooController@index');
$router->get('/zoo/(\d+)', 'ZooController@show');
$router->get('/zoo/create', 'ZooController@create');
$router->post('/zoo', 'ZooController@new');
$router->get('/zoo/(\d+)/edit', 'ZooController@edit');
$router->post('/zoo/(\d+)/edit', 'ZooController@update');
$router->post('/zoo/(\d+)/delete', 'ZooController@delete');

$router->get('/animal_zoo', 'AnimalZooController@index');
$router->get('/animal_zoo/(\d+)', 'AnimalZooController@show');
$router->get('/animal_zoo/create', 'AnimalZooController@create');
$router->post('/animal_zoo', 'AnimalZooController@new');
$router->get('/animal_zoo/(\d+)/edit', 'AnimalZooController@edit');
$router->post('/animal_zoo/(\d+)/edit', 'AnimalZooController@update');
$router->post('/animal_zoo/(\d+)/delete', 'AnimalZooController@delete');

$router->run();

