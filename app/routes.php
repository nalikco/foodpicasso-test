<?php

declare(strict_types=1);

use App\Controllers\Authenticate\LoginController;
use App\Controllers\Authenticate\LogoutController;
use App\Controllers\Authenticate\RegisterController;
use App\Controllers\DashboardController;
use App\Controllers\HomeController;
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
