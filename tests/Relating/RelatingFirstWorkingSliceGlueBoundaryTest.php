<?php

declare(strict_types=1);

namespace App\Tests\Relating;

use PHPUnit\Framework\TestCase;

final class RelatingFirstWorkingSliceGlueBoundaryTest extends TestCase
{
    public function testFirstSliceGlueFilesExist(): void
    {
        $root = dirname(__DIR__, 2);

        $required = [
            'src/Relating/Repository/DoctrineRelationshipRepository.php',
            'src/Relating/Repository/DoctrineLeadRepository.php',
            'src/Relating/Repository/DoctrineOpportunityRepository.php',
            'src/Relating/Service/UuidRelatingIdGenerator.php',
            'src/Relating/Service/DispatchingRelatingBusinessEventRecorder.php',
            'config/services/relating_first_slice.yaml.dist',
            'docs/s18-first-working-slice-glue.md',
        ];

        foreach ($required as $relativePath) {
            self::assertFileExists($root . '/' . $relativePath, $relativePath);
        }
    }

    public function testFirstSliceWiresExistingContractsOnly(): void
    {
        $content = file_get_contents(dirname(__DIR__, 2) . '/config/services/relating_first_slice.yaml.dist');
        self::assertIsString($content);

        self::assertStringContainsString('RelationshipRepositoryInterface', $content);
        self::assertStringContainsString('LeadRepositoryInterface', $content);
        self::assertStringContainsString('OpportunityRepositoryInterface', $content);
        self::assertStringContainsString('RelatingIdGeneratorInterface', $content);
        self::assertStringContainsString('RelatingBusinessEventRecorderInterface', $content);
    }

    public function testFirstSliceDoesNotIntroduceForbiddenInfrastructure(): void
    {
        $root = dirname(__DIR__, 2);

        self::assertDirectoryDoesNotExist($root . '/src/Domain');
        self::assertDirectoryDoesNotExist($root . '/migrations');

        $newFiles = [
            'config/services/relating_first_slice.yaml.dist',
            'docs/s18-first-working-slice-glue.md',
        ];

        foreach ($newFiles as $relativePath) {
            $content = file_get_contents($root . '/' . $relativePath);
            self::assertIsString($content);

            self::assertStringNotContainsString('/relating/create', $content);
            self::assertStringNotContainsString('/relating/update', $content);
            self::assertStringNotContainsString('/relating/delete', $content);
            self::assertStringNotContainsString('src/Domain/', $content);
            self::assertStringNotContainsString('CREATE TABLE', strtoupper($content));
        }
    }
}
