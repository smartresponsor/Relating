<?php

declare(strict_types=1);

namespace App\Snapshot\View;

use App\DataFixtures\RelatingDemoScenario;
use App\Enum\RelatingViewSurface;

final readonly class DemoScenarioView extends AbstractArrayView
{
    public static function fromScenario(RelatingDemoScenario $scenario): self
    {
        return new self($scenario->jsonSerialize());
    }

    public function surface(): string
    {
        return RelatingViewSurface::DemoScenario->value;
    }

    /**
     * @return list<string>
     */
    public static function expectedKeys(): array
    {
        return ['kind', 'title', 'businessGoal', 'businessOperations', 'payload'];
    }
}
