<?php

declare(strict_types=1);

namespace App\Controller\Authenticate;

use App\Controller\Controller;
use App\DTO\Authenticate\LoginRequestDTO;
use App\Exception\Registration\UsernameAlreadyTakenException;
use App\Interface\Service\RegistrationServiceInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class RegisterController extends Controller
{
    public function __construct(
        private readonly RegistrationServiceInterface $registrationService,
    ) {}

    public function render(Request $request, Response $response): ResponseInterface
    {
        return $this->view($request, $response, 'authenticate/register.html.twig');
    }

    public function handle(Request $request, Response $response): ResponseInterface
    {
        $dto = LoginRequestDTO::fromArray($request->getParsedBody());

        try {
            $this->registrationService->register($dto->getUsername(), $dto->getPassword());

            return $this->json($response, [
                'status' => 'ok',
            ], self::HTTP_STATUS_CREATED);
        } catch (UsernameAlreadyTakenException) {
            return $this->json($response, [
                'errors' => [
                    'username' => 'Логин уже занят.',
                ],
            ], self::HTTP_STATUS_BAD_REQUEST);
        }
    }
}
