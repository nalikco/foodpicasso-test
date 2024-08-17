<?php

declare(strict_types=1);

namespace App\Interface\Service;

use App\Entity\User;
use App\Exception\Registration\UsernameAlreadyTakenException;

interface RegistrationServiceInterface
{
    /**
     * Register a new user with the given username and password.
     *
     * @param  string  $username  The username for the new user.
     * @param  string  $password  The password for the new user.
     * @return User The newly registered user.
     *
     * @throws UsernameAlreadyTakenException If the username is already taken.
     */
    public function register(string $username, string $password): User;
}
