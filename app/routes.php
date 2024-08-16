<?php

declare(strict_types=1);

use App\Controllers\Authenticate\SignInController;
use App\Controllers\Authenticate\SignOutController;
use App\Controllers\Authenticate\SignUpController;
use App\Controllers\DashboardController;
use App\Controllers\HomeController;
use Slim\App;

return function (App $app): void {
    $app->get('/', HomeController::class);
    $app->get('/sign-in', [SignInController::class, 'render']);
    $app->post('/sign-in', [SignInController::class, 'handle']);
    $app->get('/sign-up', [SignUpController::class, 'render']);
    $app->post('/sign-up', [SignUpController::class, 'handle']);
    $app->get('/dashboard', DashboardController::class);
    $app->post('/sign-out', SignOutController::class);
};
