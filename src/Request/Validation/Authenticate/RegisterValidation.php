<?php

declare(strict_types=1);

namespace App\Request\Validation\Authenticate;

use App\Interface\Validation\HasValidation;
use Override;
use Respect\Validation\Validatable;
use Respect\Validation\Validator;

readonly class RegisterValidation implements HasValidation
{
    #[Override]
    public function validate(array $data): void
    {
        $this->getUsernameValidationRules()->assert($data['username'] ?? null);
        $this->getPasswordValidationRules()->assert($data['password'] ?? null);
    }

    /**
     * Get the validation rules for the username.
     *
     * @return Validatable The validation rules for the 'username' field.
     */
    private function getUsernameValidationRules(): Validatable
    {
        return Validator::stringType()
            ->alnum()
            ->noWhitespace()
            ->length(2, 20)
            ->setName('username')
            ->setTemplate('Должен содержать латинские символы без пробелов, длина от 2-х до 20-и символов.');
    }

    /**
     * Get the validation rules for the password.
     *
     * @return Validatable The validation rules for the 'password' field.
     */
    private function getPasswordValidationRules(): Validatable
    {
        return Validator::stringType()
            ->length(5)
            ->regex('/[^\d]/')
            ->setName('password')
            ->setTemplate('Должен содержать числа и другие символы и длина должна быть минимум 5 символов.');
    }
}
