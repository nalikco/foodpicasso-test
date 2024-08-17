<?php

use Doctrine\Migrations\Configuration\EntityManager\ExistingEntityManager;
use Doctrine\Migrations\Configuration\Migration\PhpFile;
use Doctrine\Migrations\DependencyFactory;
use Doctrine\ORM\EntityManagerInterface;

const ROOT_PATH = __DIR__;
require ROOT_PATH.'/vendor/autoload.php';

$container = require ROOT_PATH.'/app/bootstrap.php';
$config = new PhpFile(ROOT_PATH.'/config/migrations.php');

$entityManager = $container->get(EntityManagerInterface::class);

return DependencyFactory::fromEntityManager($config, new ExistingEntityManager($entityManager));
