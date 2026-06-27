<?php

declare(strict_types=1);

namespace App\Validation;

interface BusinessCommandValidatorInterface
{
    public function validateBusinessCommand(object $command): ValidationResult;
}
