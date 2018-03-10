<?php

$route->get('/', 'App\\Controllers\\HomeController::index');

$route->group('/auth', function ($route) {
    $route->get('/signin', 'App\\Controllers\\Auth\\LoginController::index');
    $route->post('/signin', 'App\\Controllers\\Auth\\LoginController::signin');
});