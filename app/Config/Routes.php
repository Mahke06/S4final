<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

/* ------  Jo  ------*/
$routes->get('/operateurs', 'Operateur::index');
$routes-> get('/frais', 'FraisController::index');
$routes->get('/frais/add', 'FraisController::add');     
$routes->post('/frais/add', 'FraisController::create');  
$routes->get('/frais/edit/(:num)', 'FraisController::edit/$1');  
$routes->post('/frais/update/(:num)', 'FraisController::update/$1'); 
$routes->match(['get', 'post'], '/frais/delete/(:num)', 'FraisController::delete/$1');

/* ------  Kenny  ------*/
$routes->get('/login', 'ClientController::index');
$routes->post('/login', 'ClientController::login');
$routes->get('/client/(:num)', 'ClientController::accueil/$1');
$routes->get('/logout', 'ClientController::logout');

$routes->get('/depot', 'DepotController::index'); 
$routes->post('/depot', 'DepotController::faireDepot');

$routes->get('/retrait', 'RetraitController::index');
$routes->post('/retrait', 'RetraitController::faireRetrait');

$routes->get('/transfert', 'TransfertController::index');
$routes->post('/transfert', 'TransfertController::faireTransfert');