<?php

/**
 * Errors
 */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/**
 * Session
 */
session_start();

require_once __DIR__ . '/../vendor/autoload.php';

/**
 * Environment variables
 */
try {
    $dotenv = (new \Dotenv\Dotenv(base_path()))->load();
} catch (\Dotenv\Exception\InvalidPathException $exception) {
    //
}

/**
 * Container
 */
require_once base_path('bootstrap/container.php');

/*
 * Routing system
 */
$route = $container->get(\League\Route\RouteCollection::class);

require_once base_path('routes/web.php');

$response = $route->dispatch(
    $container->get('request'), $container->get('response')
);