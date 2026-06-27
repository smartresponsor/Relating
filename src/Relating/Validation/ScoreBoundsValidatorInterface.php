<?php

declare(strict_types=1);

namespace App\Relating\Validation;

interface ScoreBoundsValidatorInterface
{
    public function validateScore(string $scoreName, int $scoreValue): ValidationResult;
}
