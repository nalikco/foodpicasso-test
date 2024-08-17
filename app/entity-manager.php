<?php

declare(strict_types=1);

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Symfony\Component\Cache\Adapter\ArrayAdapter;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

return function (array $settings): \Doctrine\ORM\EntityManager {
    $cache = $settings['dev_mode'] ?
        new ArrayAdapter :
        new FilesystemAdapter(directory: $settings['doctrine']['cache_dir']);

    $config = ORMSetup::createAttributeMetadataConfiguration(
        $settings['metadata_dirs'],
        $settings['dev_mode'],
        null,
        $cache,
    );

    $connection = DriverManager::getConnection($settings['connection']);

    return new EntityManager($connection, $config);
};
