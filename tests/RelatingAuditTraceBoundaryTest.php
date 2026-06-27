<?php

declare(strict_types=1);

namespace App\Tests;

use PHPUnit\Framework\TestCase;

final class RelatingAuditTraceBoundaryTest extends TestCase
{
    public function testTraceLayerExists(): void
    {
        self::assertFileExists(__DIR__ . '/../src/Trace/BusinessDecisionTrace.php');
        self::assertFileExists(__DIR__ . '/../src/Trace/PolicyDecisionTrace.php');
        self::assertFileExists(__DIR__ . '/../src/Trace/AiReviewTrace.php');
        self::assertFileExists(__DIR__ . '/../src/Trace/TransitionTrace.php');
        self::assertFileExists(__DIR__ . '/../src/Trace/NeighborSignalTrace.php');
    }

    public function testTraceLayerDoesNotDeclareCrudOrSqlSurface(): void
    {
        $paths = array_merge(
            glob(__DIR__ . '/../src/Trace/*.php') ?: [],
            glob(__DIR__ . '/../src/Service/*Trace*Interface.php') ?: []
        );

        self::assertNotEmpty($paths);

        $forbidden = [
            'CreateController',
            'UpdateController',
            'DeleteController',
            'IndexController',
            'ListController',
            'ShowController',
            'EditController',
            'EntityManagerInterface',
            'Doctrine\\DBAL\\Connection',
            'executeQuery',
            'executeStatement',
            'INSERT INTO',
            'UPDATE ',
            'DELETE FROM',
        ];

        foreach ($paths as $path) {
            $contents = (string) file_get_contents($path);

            foreach ($forbidden as $needle) {
                self::assertStringNotContainsString($needle, $contents, $path . ' must not contain ' . $needle);
            }
        }
    }

    public function testTraceNamingIsBusinessDecisionNaming(): void
    {
        $paths = glob(__DIR__ . '/../src/Trace/*Trace.php') ?: [];

        self::assertNotEmpty($paths);

        foreach ($paths as $path) {
            $basename = basename($path);

            self::assertStringNotContainsString('Created', $basename);
            self::assertStringNotContainsString('Updated', $basename);
            self::assertStringNotContainsString('Deleted', $basename);
        }
    }
}
