<?php

declare(strict_types=1);

namespace App\Controller\Authenticate;

use App\Controller\Controller;
use App\DTO\Authenticate\LoginRequestDTO;
use App\Exception\Authenticate\UnauthenticatedException;
use App\Interface\Service\AuthenticateServiceInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class LoginController extends Controller
{
    public function __construct(
        private readonly AuthenticateServiceInterface $authenticateService,
    ) {}

    public function render(Request $request, Response $response): ResponseInterface
    {
        return $this->view($request, $response, 'authenticate/login.html.twig');
    }

    public function handle(Request $request, Response $response): ResponseInterface
    {
        $dto = LoginRequestDTO::fromArray($request->getParsedBody());

        try {
            $this->authenticateService->authenticate($dto->getUsername(), $dto->getPassword());

            return $this->json($response, [
                'status' => 'ok',
            ]);
        } catch (UnauthenticatedException) {
            return $this->json($response, [
                'status' => 'unauthorized',
            ], self::HTTP_STATUS_UNAUTHORIZED);
        }
    }
}
