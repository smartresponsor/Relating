<?php

declare(strict_types=1);

namespace App\Relating\Validator;

interface RelationBusinessPayloadValidatorInterface
{
    /**
     * @param array<string, mixed> $payload
     */
    public function validatePayload(RelationPayloadSchema $schema, array $payload): RelationValidationResult;
}
