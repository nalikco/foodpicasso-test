<?php

declare(strict_types=1);

use DI\Container;
use Psr\Http\Message\StreamFactoryInterface;
use Slim\Factory\AppFactory;
use Slim\Psr7\Factory\StreamFactory;

define('ROOT_PATH', dirname(__DIR__));

require ROOT_PATH . '/vendor/autoload.php';

$container = new Container();

$configs = [
    'env' => 'production',
];
$container->set('configs', $configs);
$container->set(StreamFactoryInterface::class, new StreamFactory());

$app = AppFactory::createFromContainer($container);

$middlewares = require ROOT_PATH . '/app/middlewares.php';
$middlewares($app);

$routes = require ROOT_PATH . '/app/routes.php';
$routes($app);

$app->run();
