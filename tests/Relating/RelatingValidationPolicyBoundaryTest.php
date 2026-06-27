<?php

declare(strict_types=1);

namespace App\Relating\Tests;

use PHPUnit\Framework\TestCase;

final class RelatingValidationPolicyBoundaryTest extends TestCase
{
    public function testValidationAndPolicyLayersExist(): void
    {
        self::assertFileExists(__DIR__ . '/../../src/Relating/Validation/ValidationResult.php');
        self::assertFileExists(__DIR__ . '/../../src/Relating/Policy/PolicyDecisionResult.php');
        self::assertFileExists(__DIR__ . '/../../src/Relating/Policy/OpportunityStageTransitionPolicyInterface.php');
        self::assertFileExists(__DIR__ . '/../../src/Relating/Validation/BusinessPayloadValidatorInterface.php');
    }

    public function testValidationLayerDoesNotDeclareCrudRouteSurface(): void
    {
        $paths = array_merge(
            glob(__DIR__ . '/../../src/Relating/Validation/*.php') ?: [],
            glob(__DIR__ . '/../../src/Relating/Policy/*.php') ?: []
        );

        self::assertNotEmpty($paths);

        $forbidden = [
            'IndexController',
            'CreateController',
            'ReadController',
            'UpdateController',
            'DeleteController',
            'ListController',
            'ShowController',
            'EditController',
            'RemoveController',
            'EntityManagerInterface',
            'Connection',
            'executeQuery',
            'executeStatement',
        ];

        foreach ($paths as $path) {
            $contents = (string) file_get_contents($path);

            foreach ($forbidden as $needle) {
                self::assertStringNotContainsString($needle, $contents, $path . ' must not contain ' . $needle);
            }
        }
    }

    public function testPolicyNamingIsBusinessLifecycleNaming(): void
    {
        $policyFiles = glob(__DIR__ . '/../../src/Relating/Policy/*PolicyInterface.php') ?: [];

        self::assertNotEmpty($policyFiles);

        foreach ($policyFiles as $path) {
            $contents = (string) file_get_contents($path);

            self::assertStringContainsString('PolicyInterface', basename($path));
            self::assertStringNotContainsString('function save', $contents);
            self::assertStringNotContainsString('function persist', $contents);
            self::assertStringNotContainsString('function flush', $contents);
        }
    }
}
