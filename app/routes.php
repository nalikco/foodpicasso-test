<?php

declare(strict_types=1);

use App\Controller\Authenticate\LoginController;
use App\Controller\Authenticate\LogoutController;
use App\Controller\Authenticate\RegisterController;
use App\Controller\DashboardController;
use App\Controller\HomeController;
use Slim\App;

return function (App $app): void {
    $app->get('/', HomeController::class);
    $app->get('/login', [LoginController::class, 'render']);
    $app->post('/login', [LoginController::class, 'handle']);
    $app->get('/register', [RegisterController::class, 'render']);
    $app->post('/register', [RegisterController::class, 'handle']);
    $app->get('/dashboard', DashboardController::class);
    $app->post('/logout', LogoutController::class);
};
