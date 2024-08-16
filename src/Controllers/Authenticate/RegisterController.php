<?php

declare(strict_types=1);

namespace App\Controllers\Authenticate;

use App\Controllers\Controller;
use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class RegisterController extends Controller
{
    public function render(Request $request, Response $response): ResponseInterface
    {
        return $this->view($request, $response, 'authenticate/register.html.twig');
    }

    public function handle()
    {

    }
}
