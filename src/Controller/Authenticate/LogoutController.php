<?php

declare(strict_types=1);

namespace App\Controller\Authenticate;

use App\Controller\Controller;
use App\Interface\Service\AuthenticateServiceInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class LogoutController extends Controller
{
    public function __construct(
        private readonly AuthenticateServiceInterface $authenticateService,
    ) {}

    public function __invoke(Request $request, Response $response): ResponseInterface
    {
        $this->authenticateService->logout();

        return $this->json($response, [
            'status' => 'ok',
        ]);
    }
}
