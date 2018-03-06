<?php

/**
 * Bootstrap application
 */
require_once __DIR__ . '/../bootstrap/app.php';

/**
 * Response
 */
$container->get('emitter')->emit($response);