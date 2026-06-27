<?php

declare(strict_types=1);


namespace App\Relating\ReadModel;

use App\Relating\Enum\ProjectionStatus;
use App\Relating\Enum\ReadModelKind;

interface RelatingReadModelInterface extends \JsonSerializable
{
    public function kind(): ReadModelKind;

    public function reference(): string;

    public function projectedAt(): \DateTimeImmutable;

    public function status(): ProjectionStatus;

    /**
     * @return array<string, mixed>
     */
    public function toPayload(): array;
}
