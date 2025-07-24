<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// -------------------- Profiling Routes -------------------- //
$routes->get('/profiling', 'ProfilingController::profiling');

$routes->post('/profiling/step1', 'ProfilingController::profilingStep1');
$routes->post('/profiling/step2', 'ProfilingController::profilingStep2');
$routes->post('/profiling/step3', 'ProfilingController::profilingStep3');

$routes->post('/profiling/backToStep1', 'ProfilingController::backToStep1');
$routes->post('/profiling/backToStep2', 'ProfilingController::backToStep2');
$routes->post('/profiling/backToStep3', 'ProfilingController::backToStep3');
$routes->post('/profiling/backToStep4', 'ProfilingController::backToStep4');

$routes->post('/profiling/submit', 'ProfilingController::profilingSubmit');
$routes->get('/profiling/reupload/(:num)', 'ProfilingController::reuploadById/$1');
// ---------------------------------------------------------- //


// ---------------------- K-NECT Routes --------------------- //
$routes->get('/', 'KNectController::login');
$routes->get('login', 'KNectController::login');
$routes->post('loginProcess', 'AuthController::loginProcess');
$routes->post('logout', 'AuthController::logout');
$routes->get('/change-password', 'AuthController::changePassword');
$routes->post('/change-password-process', 'AuthController::changePasswordProcess');
$routes->get('/debug/user', 'AuthController::debugUser'); // Temporary debug route
// ---------------------------------------------------------- //


// --------------- Authenticated User Routes ---------------- //
$routes->group('', ['filter' => 'auth'], function ($routes) {

    // ----------- KK Routes ----------- //
    $routes->get('/kk/dashboard', 'KKController::dashboard');

    // ----------- SK Routes ----------- //
    $routes->get('/sk/dashboard', 'SKController::dashboard');
    $routes->get('/sk/profile', 'SKController::profile');
    $routes->get('/sk/member', 'SKController::member');

    // -------- Pederasyon Routes ------ //
    $routes->get('/pederasyon/dashboard', 'PederasyonController::dashboard');
    $routes->get('/pederasyon/member', 'PederasyonController::member');

    // ------ General Member Routes ---- //
    $routes->post('/getUserInfo', 'MemberController::getUserInfo');
    $routes->get('/previewDocument/(:segment)/(:any)', 'MemberController::previewDocument/$1/$2');
    $routes->post('/updateUserType', 'MemberController::updateUserType');
    $routes->post('/bulkUpdateUserType', 'MemberController::bulkUpdateUserType');
    $routes->post('/updateUserPosition', 'MemberController::updateUserPosition');
    $routes->post('/bulkUpdateUserPosition', 'MemberController::bulkUpdateUserPosition');

    // ---- User Verification Routes --- //
    $routes->post('/approved/(:num)', 'SKController::approved/$1');
    $routes->post('/reject/(:num)', 'SKController::reject/$1');
    $routes->post('/reverify/(:num)', 'SKController::reverify/$1');
});
// ---------------------------------------------------------- //
