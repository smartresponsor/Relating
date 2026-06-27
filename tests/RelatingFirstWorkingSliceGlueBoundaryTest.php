<?php

declare(strict_types=1);

namespace App\Tests;

use PHPUnit\Framework\TestCase;

final class RelatingFirstWorkingSliceGlueBoundaryTest extends TestCase
{
    public function testFirstSliceGlueFilesExist(): void
    {
        $root = dirname(__DIR__);

        $required = [
            'src/Repository/DoctrineRelationshipRepository.php',
            'src/Repository/DoctrineLeadRepository.php',
            'src/Repository/DoctrineOpportunityRepository.php',
            'src/Service/UuidRelatingIdGenerator.php',
            'src/Service/DispatchingRelatingBusinessEventRecorder.php',
            'config/services/relating_first_slice.yaml.dist',
            'docs/s18-first-working-slice-glue.md',
        ];

        foreach ($required as $relativePath) {
            self::assertFileExists($root . '/' . $relativePath, $relativePath);
        }
    }

    public function testFirstSliceWiresExistingContractsOnly(): void
    {
        $content = file_get_contents(dirname(__DIR__) . '/config/services/relating_first_slice.yaml.dist');
        self::assertIsString($content);

        self::assertStringContainsString('RelationshipRepositoryInterface', $content);
        self::assertStringContainsString('LeadRepositoryInterface', $content);
        self::assertStringContainsString('OpportunityRepositoryInterface', $content);
        self::assertStringContainsString('RelatingIdGeneratorInterface', $content);
        self::assertStringContainsString('RelatingBusinessEventRecorderInterface', $content);
    }

    public function testFirstSliceDoesNotIntroduceForbiddenInfrastructure(): void
    {
        $root = dirname(__DIR__);

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
