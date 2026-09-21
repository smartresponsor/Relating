<?php

declare(strict_types=1);

namespace App\Relating\Command;

final readonly class RelationCaptureLeadCommand
{
    public function __construct(
        public string $sourceCode,
        public array $payload,
        public ?string $tenantReference = null,
        public ?string $displayName = null,
        public ?string $companyName = null,
        public ?string $email = null,
        public ?string $phone = null,
    ) {
        if ('' === trim($this->sourceCode)) {
            throw new \InvalidArgumentException('RelationSource code cannot be empty.');
        }
    }
}
