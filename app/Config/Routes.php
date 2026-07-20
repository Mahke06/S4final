<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/login', 'ClientController::index');
$routes->post('/login', 'ClientController::login');
$routes->get('/client/(:num)', 'ClientController::accueil/$1');
$routes->get('/logout', 'ClientController::logout');