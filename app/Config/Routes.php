<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');

$routes->get('register', 'AuthController::register');
$routes->post('register/save', 'AuthController::saveRegister');

$routes->get('login', 'AuthController::login');
$routes->post('login/check', 'AuthController::checkLogin');

$routes->get('logout', 'AuthController::logout');

$routes->group('', ['filter' => 'auth'], function ($routes) {

    $routes->get('dashboard', 'DashboardController::index');

    $routes->get('pets', 'PetController::index');
    $routes->get('pets/create', 'PetController::create');
    $routes->post('pets/store', 'PetController::store');

    $routes->get('pets/edit/(:num)', 'PetController::edit/$1');
    $routes->post('pets/update/(:num)', 'PetController::update/$1');

    $routes->post('pets/delete/(:num)', 'PetController::delete/$1');
});
