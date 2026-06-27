<?php

declare(strict_types=1);

namespace App\Validation;

use App\Value\NeighborReference;

interface ReferenceValidatorInterface
{
    public function validateNeighborReference(NeighborReference $reference): ValidationResult;
}
