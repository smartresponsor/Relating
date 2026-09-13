<?php

declare(strict_types=1);

namespace App\Tests;

use App\DataFixtures\RelatingDemoSeed;
use App\Enum\DemoScenarioKind;
use App\Factory\RelatingDemoEntityFactory;
use App\Snapshot\View\DemoScenarioView;
use PHPUnit\Framework\TestCase;

final class RelatingDemoSeedBoundaryTest extends TestCase
{
    public function testDemoSeedCoversEveryScenarioKind(): void
    {
        $seed = new RelatingDemoSeed();
        $actual = array_map(static fn ($scenario): string => $scenario->kind->value, $seed->scenarios());

        self::assertSame(DemoScenarioKind::codes(), $actual);
    }

    public function testDemoScenariosDoNotUseCrudOperationNames(): void
    {
        $forbidden = '/^(index|create|read|update|delete|list|show|edit)$/i';

        foreach ((new RelatingDemoSeed())->scenarios() as $scenario) {
            foreach ($scenario->businessOperations as $operation) {
                self::assertDoesNotMatchRegularExpression($forbidden, $operation);
            }
        }
    }

    public function testDemoScenarioViewIsScalarPayloadOnly(): void
    {
        $scenario = (new RelatingDemoSeed())->relationshipStart();
        $view = DemoScenarioView::fromScenario($scenario);

        self::assertSame('demo.scenario', $view->surface());
        self::assertSame(['kind', 'title', 'businessGoal', 'businessOperations', 'payload'], DemoScenarioView::expectedKeys());
        self::assertSame('relationship_start', $view->payload()['kind']);
    }

    public function testDemoEntityFactoryBuildsBusinessLifecycleObjects(): void
    {
        $factory = new RelatingDemoEntityFactory();

        self::assertArrayHasKey('relationship', $factory->relationshipStart());
        self::assertArrayHasKey('lead', $factory->qualifiedLead());
        self::assertArrayHasKey('opportunity', $factory->opportunityFlow());
    }
}
