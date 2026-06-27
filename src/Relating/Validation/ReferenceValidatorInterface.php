<?php

declare(strict_types=1);

namespace App\Relating\Validation;

use App\Relating\Value\NeighborReference;

interface ReferenceValidatorInterface
{
    public function validateNeighborReference(NeighborReference $reference): ValidationResult;
}
