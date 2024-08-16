<?php

declare(strict_types=1);

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface;
use Slim\Exception\HttpInternalServerErrorException;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

abstract class Controller
{
    public function view(Request $request, Response $response, string $template, array $params = []): ResponseInterface
    {
        $view = Twig::fromRequest($request);

        try {
            return $view->render($response, $template, $params);
        } catch (LoaderError|RuntimeError|SyntaxError) {
            throw new HttpInternalServerErrorException($request);
        }
    }
}
