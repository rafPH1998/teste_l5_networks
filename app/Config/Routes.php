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

/**
 * Produtos
*/
$routes->get('produtos', 'ProdutoController::index');
$routes->get('produtos/(:num)', 'ProdutoController::show/$1');
$routes->post('produtos', 'ProdutoController::store');
$routes->put('produtos/(:num)', 'ProdutoController::update/$1');
$routes->delete('produtos/(:num)', 'ProdutoController::destroy/$1');

