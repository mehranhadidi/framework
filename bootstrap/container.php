<?php

use League\Container\Container;
use League\Container\ReflectionContainer;

$container = new Container();

$container->delegate(
    new ReflectionContainer
);

$container->addServiceProvider(new \App\Providers\AppServiceProvider());
$container->addServiceProvider(new \App\Providers\ViewServiceProvider());
$container->addServiceProvider(new \App\Providers\ConfigServiceProvider());