<?php

declare(strict_types=1);

namespace App\Request\Validation\Authenticate;

use App\Interface\Validation\HasValidation;
use Respect\Validation\Validatable;
use Respect\Validation\Validator;

readonly class LoginValidation implements HasValidation
{
    #[\Override]
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
            ->setName('username')
            ->setTemplate('Должен быть заполнен.');
    }

    /**
     * Get the validation rules for the password.
     *
     * @return Validatable The validation rules for the 'password' field.
     */
    private function getPasswordValidationRules(): Validatable
    {
        return Validator::stringType()
            ->setName('password')
            ->setTemplate('Должен быть заполнен.');
    }
}
