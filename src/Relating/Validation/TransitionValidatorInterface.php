<?php

declare(strict_types=1);

namespace App\Relating\Validation;

interface TransitionValidatorInterface
{
    public function validateTransition(string $businessObject, string $fromState, string $toState): ValidationResult;
}
