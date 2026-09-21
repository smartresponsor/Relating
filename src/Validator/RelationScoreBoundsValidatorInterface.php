<?php

declare(strict_types=1);

namespace App\Relating\Validator;

interface RelationScoreBoundsValidatorInterface
{
    public function validateScore(string $scoreName, int $scoreValue): RelationValidationResult;
}
