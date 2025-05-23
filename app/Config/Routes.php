<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// 🌐 Public Routes
$routes->get('/', 'AuthController::portal');
$routes->get('public/index', 'PublicPortal::index');  // Dashboard page after login

// Appointment Scheduling
$routes->get('schedule', 'AppointmentController::create');
$routes->post('schedule', 'AppointmentController::store');

// Document Upload
$routes->get('upload', 'DocumentController::upload');
$routes->post('upload', 'DocumentController::saveupload');

// Track Status
$routes->get('track', 'PublicPortal::trackStatus');
$routes->post('track', 'PublicPortal::processTracking');

$routes->get('auth/portal', 'AuthController::portal');  // For logout redirect

// 🔐 Authentication Routes
$routes->get('register', 'AuthController::register');
$routes->post('register_ac', 'AuthController::register_ac');
$routes->get('login', 'AuthController::login');
$routes->post('login_ac', 'AuthController::login_ac');
$routes->get('logout', 'AuthController::logout');

// Protected routes group (only logged-in users)
$routes->group('', ['filter' => 'auth'], function($routes) {
    $routes->get('index', 'PublicPortal::index');
    // Add other protected routes here
});

// Admin routes
$routes->group('admin', function($routes) {
    $routes->get('/', 'Admin\Dashboard::index');

}); 
   $routes->get('admin/documents', 'Admin\Documents::index');
   $routes->get('admin/appointments', 'Admin\Appointments::index');
$routes->get('admin/appointments/updateStatus/(:num)/(:segment)', 'Admin\Appointments::updateStatus/$1/$2');
$routes->get('admin/gis', 'Admin\Gis::index');
$routes->get('/admin/gis', 'Admin\GIS::index');
$routes->get('/admin/gis/properties', 'Admin\GIS::getProperties');
$routes->match(['get', 'post'], 'admin/parcels/create', 'Admin\ParcelController::create');
$routes->get('admin/parcels/fetch', 'Admin\ParcelController::fetch');
