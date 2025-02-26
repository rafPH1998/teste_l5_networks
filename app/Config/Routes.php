<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

/**
 * Clientes
 */
$routes->get('clientes', 'ClientesController::index');
$routes->get('clientes/(:num)', 'ClientesController::show/$1');
$routes->post('clientes', 'ClientesController::store');
$routes->put('clientes/(:num)', 'ClientesController::update/$1');
$routes->delete('clientes/(:num)', 'ClientesController::destroy/$1');

