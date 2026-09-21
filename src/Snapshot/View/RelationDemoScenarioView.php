<?php

declare(strict_types=1);

namespace App\Relating\Snapshot\View;

use App\Relating\DataFixtures\RelationRelatingDemoScenario;
use App\Relating\Enum\RelationRelatingViewSurface;

final readonly class RelationDemoScenarioView extends RelationAbstractArrayView
{
    public static function fromScenario(RelationRelatingDemoScenario $scenario): self
    {
        return new self($scenario->jsonSerialize());
    }

    public function surface(): string
    {
        return RelationRelatingViewSurface::DemoScenario->value;
    }

    /**
     * @return list<string>
     */
    public static function expectedKeys(): array
    {
        return ['kind', 'title', 'businessGoal', 'businessOperations', 'payload'];
    }
}
