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
$routes->get('/admin/playlists', 'Admin::playlists');
$routes->get('/admin/music_control', 'Admin::server_music_player');
$routes->get('/admin/login', 'Admin::login');
$routes->get('/admin/logout', 'Admin::logout');

/*** SERVER ***/
$routes->post('/get_user_data', 'Admin::get_user_data');
$routes->post('/get_user_data_by_id', 'Admin::get_user_data_by_id');
$routes->post('/update_user', 'Admin::update_user');
$routes->post('/upload_music', 'Admin::upload_music');
$routes->post('/delete_music', 'Admin::delete_music');
$routes->post('/get_music_by_id', 'Admin::get_music_by_id');
$routes->post('/update_music', 'Admin::update_music');
$routes->post('/add_playlist', 'Admin::add_playlist');
$routes->post('/add_to_playlist', 'Admin::add_to_playlist');
$routes->post('/delete_playlist', 'Admin::delete_playlist');
$routes->post('/get_playlist_by_id', 'Admin::get_playlist_by_id');
$routes->post('/edit_playlist', 'Admin::edit_playlist');
$routes->post('/sync_data', 'Admin::sync_data');
$routes->post('/get_current_playlist_songs', 'Admin::get_current_playlist_songs');
