<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\User;
use App\Exception\Registration\UsernameAlreadyTakenException;
use App\Interface\Repository\UserRepositoryInterface;
use App\Interface\Service\PasswordHashServiceInterface;
use App\Interface\Service\RegistrationServiceInterface;
use Override;

readonly class RegistrationService implements RegistrationServiceInterface
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private PasswordHashServiceInterface $passwordHashService,
    ) {}

    #[Override]
    public function register(string $username, string $password): User
    {
        $userWithUsername = $this->userRepository->findByUsername($username);
        if (! is_null($userWithUsername)) {
            throw new UsernameAlreadyTakenException;
        }

        $hashedPassword = $this->passwordHashService->hash($password);

        return $this->userRepository->create($username, $hashedPassword);
    }
}
