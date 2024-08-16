<?php

declare(strict_types=1);

namespace App\DTO\Authenticate;

use Respect\Validation\Exceptions\ValidatorException;
use Respect\Validation\Validatable;
use Respect\Validation\Validator;

class RegisterRequestDTO
{
    private string $username;
    private string $password;

    public static function fromArray(array $data): self
    {
        $instance = new self();
        $instance->setUsername($data['username']);
        $instance->setPassword($data['password']);

        return $instance;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    private function getUsernameValidationRules(): Validatable
    {
        return Validator::stringType()
            ->alnum()
            ->noWhitespace()
            ->length(2, 20)
            ->setName('username')
            ->setTemplate('Должен содержать латинские символы без пробелов, длина от 2-х до 20-и символов.');
    }

    private function getPasswordValidationRules(): Validatable
    {
        return Validator::stringType()
            ->length(5)
            ->regex('/[^\d]/')
            ->setName('password')
            ->setTemplate('Должен содержать числа и другие символы и длина должна быть минимум 5 символов.');
    }

    /**
     * @throws ValidatorException
     */
    public function validate(): void
    {
        $this->getUsernameValidationRules()->assert($this->getUsername());
        $this->getPasswordValidationRules()->assert($this->getPassword());
    }
}
