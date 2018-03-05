<?php

$route->get('/', function ($request, $response) {
    $response->getBody()->write("Homepage");

    return $response;
});