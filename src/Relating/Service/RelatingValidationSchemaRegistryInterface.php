<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\Validation\PayloadSchema;

interface RelatingValidationSchemaRegistryInterface
{
    public function schemaForBusinessAction(string $businessAction): PayloadSchema;
}
