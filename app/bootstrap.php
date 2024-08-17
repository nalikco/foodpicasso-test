<?php

declare(strict_types=1);

use App\Interface\Repository\UserRepositoryInterface;
use App\Interface\Service\AuthenticateServiceInterface;
use App\Interface\Service\PasswordHashServiceInterface;
use App\Interface\Service\RegistrationServiceInterface;
use App\Interface\Service\SessionServiceInterface;
use App\Repository\UserRepository;
use App\Service\AuthenticateService;
use App\Service\PasswordHashService;
use App\Service\RegistrationService;
use App\Service\SessionService;
use DI\Container;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Slim\Psr7\Factory\StreamFactory;

$slimConfig = require ROOT_PATH.'/config/slim.php';
$doctrineConfig = require ROOT_PATH.'/config/doctrine.php';
$entityManagerFactory = require ROOT_PATH.'/app/entity-manager.php';

$container = new Container;

$configs = [
    'slim' => $slimConfig,
    'doctrine' => $doctrineConfig,
];
$container->set('configs', $configs);
$container->set(StreamFactoryInterface::class, new StreamFactory);
$container->set(EntityManagerInterface::class, static fn (Container $container): EntityManager => $entityManagerFactory($container->get('configs')['doctrine']));
$container->set(UserRepositoryInterface::class, static fn (Container $container): UserRepositoryInterface => $container->make(UserRepository::class));
$container->set(SessionServiceInterface::class, static fn (Container $container): SessionServiceInterface => $container->make(SessionService::class));
$container->set(PasswordHashServiceInterface::class, static fn (Container $container): PasswordHashServiceInterface => $container->make(PasswordHashService::class));
$container->set(AuthenticateServiceInterface::class, static fn (Container $container): AuthenticateServiceInterface => $container->make(AuthenticateService::class));
$container->set(RegistrationServiceInterface::class, static fn (Container $container): RegistrationServiceInterface => $container->make(RegistrationService::class));

return $container;
