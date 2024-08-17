<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\User;
use App\Exception\Authenticate\UnauthenticatedException;
use App\Interface\Repository\UserRepositoryInterface;
use App\Interface\Service\AuthenticateServiceInterface;
use App\Interface\Service\PasswordHashServiceInterface;
use App\Interface\Service\SessionServiceInterface;
use Override;

readonly class AuthenticateService implements AuthenticateServiceInterface
{
    private const string USER_USERNAME_SESSION_KEY = 'username';

    public function __construct(
        private UserRepositoryInterface $userRepository,
        private PasswordHashServiceInterface $passwordHashService,
        private SessionServiceInterface $sessionService,
    ) {}

    #[Override]
    public function authenticate(string $username, string $password): User
    {
        $user = $this->userRepository->findByUsername($username);
        if (is_null($user)) {
            throw new UnauthenticatedException;
        }

        if (! $this->passwordHashService->verify($password, $user->getPassword())) {
            throw new UnauthenticatedException;
        }

        $this->sessionService->put(self::USER_USERNAME_SESSION_KEY, $user->getId());

        return $user;
    }

    #[Override]
    public function logout(): void
    {
        $this->sessionService->remove(self::USER_USERNAME_SESSION_KEY);
    }

    #[Override]
    public function getAuthenticatedUsername(): ?string
    {
        return $this->sessionService->get(self::USER_USERNAME_SESSION_KEY);
    }
}
