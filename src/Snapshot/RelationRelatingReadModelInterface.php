<?php

declare(strict_types=1);

namespace App\Relating\Snapshot;

use App\Relating\Enum\RelationProjectionStatus;
use App\Relating\Enum\RelationReadModelKind;

interface RelationRelatingReadModelInterface extends \JsonSerializable
{
    public function kind(): RelationReadModelKind;

    public function reference(): string;

    public function projectedAt(): \DateTimeImmutable;

    public function status(): RelationProjectionStatus;

    /**
     * @return array<string, mixed>
     */
    public function toPayload(): array;
}
