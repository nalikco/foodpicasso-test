<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Interface\Validation\HasValidation;
use Override;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Respect\Validation\Exceptions\ValidatorException;
use Slim\Psr7\Response;

readonly class ValidationMiddleware implements MiddlewareInterface
{
    public function __construct(
        private HasValidation $validation,
    )
    {
    }

    /**
     * Process the incoming request and validate its data.
     *
     * @param ServerRequestInterface $request The HTTP request.
     * @param RequestHandlerInterface $handler The request handler.
     * @return ResponseInterface The HTTP response.
     */
    #[Override]
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        try {
            $this->validation->validate($request->getParsedBody());

            return $handler->handle($request);
        } catch (ValidatorException $e) {
            $response = new Response();
            $response->getBody()->write(json_encode([
                'errors' => $e->getMessages(),
            ]));

            return $response
                ->withStatus(400)
                ->withHeader('Content-Type', 'application/json');
        }
    }
}
