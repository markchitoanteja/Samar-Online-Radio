<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

/*** PUBLIC PAGES ***/
$routes->get('/', 'Home::index');
$routes->get('/home', 'Home::index');
$routes->get('/public', 'Home::index');

/*** ADMIN PAGES ***/
$routes->get('/admin', 'Admin::index');
$routes->get('/admin/login', 'Admin::login');
$routes->get('/admin/logout', 'Admin::logout');
$routes->get('/admin/dashboard', 'Admin::dashboard');

/*** SERVER ***/
$routes->post('/get_user_data', 'Admin::get_user_data');
$routes->post('/get_user_data_by_id', 'Admin::get_user_data_by_id');
$routes->post('/update_user', 'Admin::update_user');
