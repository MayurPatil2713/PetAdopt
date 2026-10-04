<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');

$routes->get('register', 'AuthController::register');
$routes->post('register/save', 'AuthController::saveRegister');

$routes->get('login', 'AuthController::login');
$routes->post('login/check', 'AuthController::checkLogin');

$routes->get('logout', 'AuthController::logout');

$routes->get('adoption/create/(:num)', 'AdoptionController::create/$1');
$routes->post('adoption/store/(:num)', 'AdoptionController::store/$1');

$routes->get('pets/browse', 'PetController::browse');
$routes->get('pets/details/(:num)', 'PetController::details/$1');

$routes->group('', ['filter' => 'auth'], function ($routes) {

    $routes->get('dashboard', 'DashboardController::index');

    $routes->get('pets', 'PetController::index');
    $routes->get('pets/create', 'PetController::create');
    $routes->post('pets/store', 'PetController::store');

    $routes->get('pets/edit/(:num)', 'PetController::edit/$1');
    $routes->post('pets/update/(:num)', 'PetController::update/$1');

    $routes->post('pets/delete/(:num)', 'PetController::delete/$1');

    $routes->get('adoption/requests', 'AdoptionController::index');
    $routes->get('adoption/approve/(:num)', 'AdoptionController::approve/$1');
    $routes->get('adoption/reject/(:num)', 'AdoptionController::reject/$1');
});
