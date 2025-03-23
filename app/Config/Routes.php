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
$routes->get('/admin/dashboard', 'Admin::dashboard');
$routes->get('/admin/music_files', 'Admin::music_files');
$routes->get('/admin/login', 'Admin::login');
$routes->get('/admin/logout', 'Admin::logout');

/*** SERVER ***/
$routes->post('/get_user_data', 'Admin::get_user_data');
$routes->post('/get_user_data_by_id', 'Admin::get_user_data_by_id');
$routes->post('/update_user', 'Admin::update_user');
