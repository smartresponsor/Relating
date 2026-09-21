<?php

declare(strict_types=1);

namespace App\Relating\Tests;

use App\Relating\DataFixtures\RelationRelatingDemoSeed;
use App\Relating\Enum\RelationDemoScenarioKind;
use App\Relating\Factory\RelationRelatingDemoEntityFactory;
use App\Relating\Snapshot\View\RelationDemoScenarioView;
use PHPUnit\Framework\TestCase;

final class RelatingDemoSeedBoundaryTest extends TestCase
{
    public function testDemoSeedCoversEveryScenarioKind(): void
    {
        $seed = new RelationRelatingDemoSeed();
        $actual = array_map(static fn ($scenario): string => $scenario->kind->value, $seed->scenarios());

        self::assertSame(RelationDemoScenarioKind::codes(), $actual);
    }

    public function testDemoScenariosDoNotUseCrudOperationNames(): void
    {
        $forbidden = '/^(index|create|read|update|delete|list|show|edit)$/i';

        foreach ((new RelationRelatingDemoSeed())->scenarios() as $scenario) {
            foreach ($scenario->businessOperations as $operation) {
                self::assertDoesNotMatchRegularExpression($forbidden, $operation);
            }
        }
    }

    public function testDemoScenarioViewIsScalarPayloadOnly(): void
    {
        $scenario = (new RelationRelatingDemoSeed())->relationshipStart();
        $view = RelationDemoScenarioView::fromScenario($scenario);

        self::assertSame('demo.scenario', $view->surface());
        self::assertSame(['kind', 'title', 'businessGoal', 'businessOperations', 'payload'], RelationDemoScenarioView::expectedKeys());
        self::assertSame('relationship_start', $view->payload()['kind']);
    }

    public function testDemoEntityFactoryBuildsBusinessLifecycleObjects(): void
    {
        $factory = new RelationRelatingDemoEntityFactory();

        self::assertArrayHasKey('relationship', $factory->relationshipStart());
        self::assertArrayHasKey('lead', $factory->qualifiedLead());
        self::assertArrayHasKey('opportunity', $factory->opportunityFlow());
    }
}
