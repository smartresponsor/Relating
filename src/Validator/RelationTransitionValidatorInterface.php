<?php

declare(strict_types=1);

namespace App\Relating\Validator;

interface RelationTransitionValidatorInterface
{
    public function validateTransition(string $businessObject, string $fromState, string $toState): RelationValidationResult;
}
