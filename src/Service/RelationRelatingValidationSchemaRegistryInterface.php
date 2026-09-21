<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\Validator\RelationPayloadSchema;

interface RelationRelatingValidationSchemaRegistryInterface
{
    public function schemaForBusinessAction(string $businessAction): RelationPayloadSchema;
}
