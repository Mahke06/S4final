<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

/* ------  Jo  ------*/
$routes->get('/operateurs', 'Operateur::index');
$routes-> get('/frais', 'Frais::index');


/* ------  Kenny  ------*/
$routes->get('/login', 'ClientController::index');
$routes->post('/login', 'ClientController::login');
$routes->get('/client/(:num)', 'ClientController::accueil/$1');
$routes->get('/logout', 'ClientController::logout');

$routes->get('/depot', 'DepotController::index'); 
$routes->post('/depot', 'DepotController::faireDepot');