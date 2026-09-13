<?php

declare(strict_types=1);

namespace App\Service;

use App\Validator\PayloadSchema;

interface RelatingValidationSchemaRegistryInterface
{
    public function schemaForBusinessAction(string $businessAction): PayloadSchema;
}
