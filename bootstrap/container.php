<?php

use League\Container\Container;
use League\Container\ReflectionContainer;

$container = new Container();

$container->delegate(
    new ReflectionContainer
);

$container->addServiceProvider(new \App\Providers\ConfigServiceProvider());

// Load service providers
foreach ($container->get('config')->get('app.providers') as $provider) {
    $container->addServiceProvider($provider);
}