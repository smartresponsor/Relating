<?php

declare(strict_types=1);

namespace App\Tests\Relating;

use PHPUnit\Framework\TestCase;

final class RelatingEventBoundaryTest extends TestCase
{
    public function testRelatingDoesNotDeclareGenericCrudEventClasses(): void
    {
        $eventDir = dirname(__DIR__, 2).'/src/Relating/Event';

        self::assertDirectoryExists($eventDir);

        $forbidden = [
            'RelationshipCreated.php',
            'RelationshipUpdated.php',
            'RelationshipDeleted.php',
            'OpportunityCreated.php',
            'OpportunityUpdated.php',
            'OpportunityDeleted.php',
            'GenericCrudOperationCompleted.php',
        ];

        foreach ($forbidden as $fileName) {
            self::assertFileDoesNotExist($eventDir.'/'.$fileName, $fileName.' is a CRUD-derived event name.');
        }
    }
}
