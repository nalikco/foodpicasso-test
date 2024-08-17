<?php

declare(strict_types=1);

use App\Middleware\JsonBodyParserMiddleware;
use Slim\App;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

return function (App $app): void {
    $settings = $app->getContainer()->get('configs')['slim'];

    $app->addRoutingMiddleware();
    $app->addErrorMiddleware(
        $settings['errors']['display_error_details'],
        $settings['errors']['log_errors'],
        $settings['errors']['log_error_details'],
    );

    $twig = Twig::create(ROOT_PATH.'/templates', ['cache' => false]);
    $twig->getEnvironment()->addGlobal('env', $settings['env']);
    $app->add(TwigMiddleware::create($app, $twig));

    $app->addMiddleware(new JsonBodyParserMiddleware);
};
