<?php

declare(strict_types=1);

namespace App\Relating\Tests;

use PHPUnit\Framework\TestCase;

final class RelatingFinalGapBoundaryTest extends TestCase
{
    public function testS16DocumentationPackExists(): void
    {
        $root = dirname(__DIR__, 2);

        foreach ([
            'docs/final-gap-review.md',
            'docs/naming-cleanup-report.md',
            'docs/obsolete-term-scan.md',
            'docs/duplicate-concept-review.md',
            'docs/docs-link-integrity.md',
            'docs/preinstall-rc-checklist.md',
            'docs/s16-final-gap-review-report.md',
            'tools/validate-relating-final-gap.ps1',
        ] as $relativePath) {
            self::assertFileExists($root . '/' . $relativePath, $relativePath);
        }
    }

    public function testProductionCodeDoesNotContainCrudOrLegacyMutationTerms(): void
    {
        $root = dirname(__DIR__, 2) . '/src/Relating';
        $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($root));
        $forbidden = [
            'Create',
            'Update',
            'Delete',
            'Remove',
            'Removed',
            'MassUpdate',
            'mass_update',
            'SELECT ',
            'INSERT ',
            'UPDATE ',
            'DELETE ',
        ];

        foreach ($iterator as $file) {
            if (!$file instanceof \SplFileInfo || !$file->isFile() || $file->getExtension() !== 'php') {
                continue;
            }

            $content = (string) file_get_contents($file->getPathname());
            foreach ($forbidden as $needle) {
                self::assertStringNotContainsString($needle, $content, $file->getPathname() . ' contains obsolete term ' . $needle);
            }
        }
    }

    public function testRenamedBusinessTermsArePresent(): void
    {
        $root = dirname(__DIR__, 2);

        self::assertFileExists($root . '/src/Relating/Event/RelationshipParticipantDetached.php');
        self::assertFileDoesNotExist($root . '/src/Relating/Event/RelationshipParticipantRemoved.php');

        $viewType = (string) file_get_contents($root . '/src/Relating/Enum/ViewType.php');
        self::assertStringContainsString("case BulkReview = 'bulk_review';", $viewType);
        self::assertStringNotContainsString('MassUpdate', $viewType);
        self::assertStringNotContainsString('mass_update', $viewType);
    }

    public function testManifestKnowsS16Files(): void
    {
        $root = dirname(__DIR__, 2);
        $manifest = json_decode((string) file_get_contents($root . '/MANIFEST.json'), true, 512, JSON_THROW_ON_ERROR);
        $files = $manifest['files'] ?? [];

        self::assertContains('docs/s16-final-gap-review-report.md', $files);
        self::assertContains('tools/validate-relating-final-gap.ps1', $files);
        self::assertContains('tests/Relating/RelatingFinalGapBoundaryTest.php', $files);
    }
}
