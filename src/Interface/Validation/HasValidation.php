<?php

declare(strict_types=1);

namespace App\Interface\Validation;

use Respect\Validation\Exceptions\ValidationException;

interface HasValidation
{
    /**
     * Validate the provided data.
     *
     * @param  array  $data  The data to validate.
     *
     * @throws ValidationException If validation fails.
     */
    public function validate(array $data): void;
}
