<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// $routes->group('api', ['namespace' => 'App\Controllers\Api'], function ($routes) {
//   $routes->post('register', 'AuthController::register');
//   $routes->post('login', 'AuthController::login');

//   // Protected routes (require JWT filter)
//   $routes->group('', ['filter' => 'auth'], function ($routes) {
//     $routes->get('users', 'UserController::index');        // list users
//     $routes->get('user', 'UserController::profile');       // current user info
//     $routes->put('users/(:num)', 'UserController::update/$1');
//     $routes->delete('users/(:num)', 'UserController::delete/$1');
//   });
// });

$routes->group('api', [
  'namespace' => 'App\Controllers\Api',
  'filter'    => 'cors'
], function ($routes) {
  $routes->post('register', 'AuthController::register');
  $routes->post('login', 'AuthController::login');

  // Protected routes (require JWT filter)
  $routes->group('', ['filter' => 'auth'], function ($routes) {
    $routes->get('users', 'UserController::index');
    $routes->get('user', 'UserController::profile');
    $routes->put('users/(:num)', 'UserController::update/$1');
    $routes->delete('users/(:num)', 'UserController::delete/$1');
  });
});
