<?php

declare(strict_types=1);

namespace App\Controller\Authenticate;

use App\Controller\Controller;
use App\DTO\Authenticate\LoginRequestDTO;
use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class LoginController extends Controller
{
    public function render(Request $request, Response $response): ResponseInterface
    {
        return $this->view($request, $response, 'authenticate/login.html.twig');
    }

    public function handle(Request $request, Response $response): ResponseInterface
    {
        $dto = LoginRequestDTO::fromArray($request->getParsedBody());

        return $this->json($response, [
            'username' => $dto->getUsername(),
        ]);
    }
}
