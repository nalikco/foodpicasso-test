<?php

declare(strict_types=1);

namespace App\Controller\Authenticate;

use App\Controller\Controller;
use App\DTO\Authenticate\RegisterRequestDTO;
use Psr\Http\Message\ResponseInterface;
use Respect\Validation\Exceptions\ValidatorException;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class RegisterController extends Controller
{
    public function render(Request $request, Response $response): ResponseInterface
    {
        return $this->view($request, $response, 'authenticate/register.html.twig');
    }

    public function handle(Request $request, Response $response): ResponseInterface
    {
        $dto = RegisterRequestDTO::fromArray($request->getParsedBody());
        try {
            $dto->validate();

            return $this->json($response, $request->getParsedBody());
        } catch (ValidatorException $e) {
            return $this->json($response, [
                'errors' => $e->getMessages(),
            ], 400);
        }
    }
}
