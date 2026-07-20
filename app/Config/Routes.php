<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

/* ------  Admin  ------*/
$routes->get('/loginOp', 'AdminController::index');
$routes->post('/loginOp', 'AdminController::login');
$routes->get('/admin', 'AdminController::choix');
$routes->get('/admin/commission', 'AdminController::commission');
$routes->post('/admin/commission/add', 'AdminController::ajoutCommission');
$routes->post('/admin/commission/update/(:num)', 'AdminController::updateCommission/$1');
$routes->post('/admin/commission/delete/(:num)', 'AdminController::deleteCommission/$1');
$routes->get('/admin/prefixe', 'AdminController::prefixe');
$routes->post('/admin/prefixe/update', 'AdminController::updatePrefixe');
$routes->get('/admin/frais', 'FraisController::index');
$routes->post('/admin/frais/add', 'FraisController::create');
$routes->get('/admin/frais/edit/(:num)', 'FraisController::edit/$1');
$routes->post('/admin/frais/update/(:num)', 'FraisController::update/$1');
$routes->match(['get', 'post'], '/admin/frais/delete/(:num)', 'FraisController::delete/$1');
$routes->get('/admin/gains', 'FraisController::gains');
$routes->get('/admin-logout', 'AdminController::logout');

/* ------  Kenny  ------*/
$routes->get('/login', 'ClientController::index');
$routes->post('/login', 'ClientController::login');
$routes->get('/client', 'ClientController::accueil');
$routes->get('/historique', 'ClientController::historique');
$routes->get('/logout', 'ClientController::logout');

$routes->get('/depot', 'DepotController::index');
$routes->post('/depot', 'DepotController::faireDepot');

$routes->get('/retrait', 'RetraitController::index');
$routes->post('/retrait', 'RetraitController::faireRetrait');

$routes->get('/transfert', 'TransfertController::index');
$routes->post('/transfert', 'TransfertController::faireTransfert');
$routes->get('/transfert/multiple', 'TransfertController::multiple');
$routes->post('/transfert/multiple', 'TransfertController::faireTransfertMultiple');
