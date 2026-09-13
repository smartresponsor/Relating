<?php

declare(strict_types=1);

namespace App\Validator;

interface ScoreBoundsValidatorInterface
{
    public function validateScore(string $scoreName, int $scoreValue): ValidationResult;
}
