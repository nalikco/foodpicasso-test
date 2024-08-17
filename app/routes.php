<?php

declare(strict_types=1);

use App\Controller\Authenticate\LoginController;
use App\Controller\Authenticate\LogoutController;
use App\Controller\Authenticate\RegisterController;
use App\Controller\DashboardController;
use App\Controller\HomeController;
use App\Middleware\AuthenticatedMiddleware;
use App\Middleware\ValidationMiddleware;
use App\Request\Validation\Authenticate\LoginValidation;
use App\Request\Validation\Authenticate\RegisterValidation;
use DI\Container;
use Slim\App;

return function (App $app, Container $container): void {
    $app->get('/', HomeController::class);

    $app->get('/login', [LoginController::class, 'render']);

    $app->post('/login', [LoginController::class, 'handle'])
        ->addMiddleware(new ValidationMiddleware(new LoginValidation));

    $app->get('/register', [RegisterController::class, 'render']);

    $app->post('/register', [RegisterController::class, 'handle'])
        ->addMiddleware(new ValidationMiddleware(new RegisterValidation));

    $app->get('/dashboard', DashboardController::class);

    $app->post('/logout', LogoutController::class)
        ->addMiddleware($container->make(AuthenticatedMiddleware::class));
};
