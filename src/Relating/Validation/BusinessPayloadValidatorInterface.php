<?php

declare(strict_types=1);

namespace App\Relating\Validation;

interface BusinessPayloadValidatorInterface
{
    /**
     * @param array<string, mixed> $payload
     */
    public function validatePayload(PayloadSchema $schema, array $payload): ValidationResult;
}
