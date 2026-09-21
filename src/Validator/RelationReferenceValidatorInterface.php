<?php

declare(strict_types=1);

namespace App\Relating\Validator;

use App\Relating\ValueObject\RelationNeighborReference;

interface RelationReferenceValidatorInterface
{
    public function validateNeighborReference(RelationNeighborReference $reference): RelationValidationResult;
}
