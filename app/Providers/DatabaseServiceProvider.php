<?php

namespace App\Providers;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use League\Container\ServiceProvider\AbstractServiceProvider;

class DatabaseServiceProvider extends AbstractServiceProvider
{
    protected $provides = [
        EntityManager::class,
    ];

    public function register()
    {
        $container = $this->getContainer();

        $config = $container->get('config');

        $container->share(EntityManager::class, function () use ($config) {

            $connection = $config->get('db.mysql');

            $entityManager = EntityManager::create(
                $connection,
                Setup::createAnnotationMetadataConfiguration(
                    [base_path('app')],
                    $config->get('app.debug'),
                    null,
                    null,
                    false
                )
            );

            return $entityManager;
        });
    }
}