<?php

// Turn on errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once __DIR__ . '/../vendor/autoload.php';

try {
    $dotenv = (new \Dotenv\Dotenv(__DIR__ . '/..//'))->load();
} catch (\Dotenv\Exception\InvalidPathException $exception) {
    //
}

require_once __DIR__ . '/container.php';

$route = $container->get(\League\Route\RouteCollection::class);

require_once __DIR__ . '/../routes/web.php';

$response = $route->dispatch(
    $container->get('request'), $container->get('response')
);