<?php

declare(strict_types=1);

namespace App\Validator;

use App\ValueObject\NeighborReference;

interface ReferenceValidatorInterface
{
    public function validateNeighborReference(NeighborReference $reference): ValidationResult;
}
