<?php

declare(strict_types=1);

namespace App\Command;

final readonly class StartRelationshipCommand
{
    public function __construct(
        public string $vendorReference,
        public string $relationshipKind = 'prospect',
        public ?string $tenantReference = null,
        public ?string $ownerReference = null,
        public ?string $sourceReference = null,
        public array $context = [],
    ) {
        self::assertFilled($this->vendorReference, 'Vendor reference');
    }

    private static function assertFilled(string $value, string $label): void
    {
        if ('' === trim($value)) {
            throw new \InvalidArgumentException($label.' cannot be empty.');
        }
    }
}
