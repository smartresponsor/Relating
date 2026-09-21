<?php

declare(strict_types=1);

namespace App\Relating\Snapshot\View;

interface RelationRelatingViewInterface extends \JsonSerializable
{
    /**
     * Stable business surface code, not a route name and not a Doctrine entity name.
     */
    public function surface(): string;

    /**
     * @return array<string, mixed>
     */
    public function payload(): array;
}
