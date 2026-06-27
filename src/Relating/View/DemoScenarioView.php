<?php

declare(strict_types=1);

namespace App\Relating\View;

use App\Relating\Enum\RelatingViewSurface;
use App\Relating\Fixture\RelatingDemoScenario;

final class DemoScenarioView extends AbstractArrayView
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
