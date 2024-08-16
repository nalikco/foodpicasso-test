<?php

declare(strict_types=1);

use Slim\App;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

return function (App $app): void {
    $app->addRoutingMiddleware();
    $app->addErrorMiddleware(true, true, true);

    $twig = Twig::create(ROOT_PATH . '/templates', ['cache' => false]);
    $twig->getEnvironment()->addGlobal('env', $app->getContainer()->get('configs')['env']);
    $app->add(TwigMiddleware::create($app, $twig));
};
