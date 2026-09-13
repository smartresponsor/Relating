<?php

declare(strict_types=1);

namespace App\Validator;

interface BusinessCommandValidatorInterface
{
    public function validateBusinessCommand(object $command): ValidationResult;
}
