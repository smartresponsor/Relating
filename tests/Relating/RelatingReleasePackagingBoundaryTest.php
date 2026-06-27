<?php

declare(strict_types=1);

namespace App\Tests\Relating;

use PHPUnit\Framework\TestCase;

final class RelatingReleasePackagingBoundaryTest extends TestCase
{
    public function testReleasePackagingDocsAndToolsExist(): void
    {
        $root = dirname(__DIR__, 2);

        $required = [
            'docs/release-packaging-quality.md',
            'docs/archive-hash-verification.md',
            'docs/manifest-verification.md',
            'docs/windows-install-notes.md',
            'docs/inventory-discipline.md',
            'docs/release-checklist.md',
            'docs/s15-release-packaging-report.md',
            'tools/verify-relating-manifest.ps1',
            'tools/verify-relating-archive.ps1',
        ];

        foreach ($required as $relativePath) {
            self::assertFileExists($root . '/' . $relativePath, $relativePath);
        }
    }

    public function testManifestKnowsReleasePackagingFiles(): void
    {
        $root = dirname(__DIR__, 2);
        $manifest = json_decode((string) file_get_contents($root . '/MANIFEST.json'), true, 512, JSON_THROW_ON_ERROR);
        $files = $manifest['files'] ?? [];

        self::assertContains('docs/release-packaging-quality.md', $files);
        self::assertContains('docs/archive-hash-verification.md', $files);
        self::assertContains('docs/manifest-verification.md', $files);
        self::assertContains('tools/verify-relating-manifest.ps1', $files);
        self::assertContains('tools/verify-relating-archive.ps1', $files);
    }

    public function testReleasePackagingDoesNotIntroduceForbiddenInventory(): void
    {
        $root = dirname(__DIR__, 2);

        self::assertDirectoryDoesNotExist($root . '/src/Domain');
        self::assertDirectoryDoesNotExist($root . '/migrations');
        self::assertDirectoryDoesNotExist($root . '/node_modules');

        $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($root));

        foreach ($iterator as $file) {
            if (!$file instanceof \SplFileInfo || !$file->isFile()) {
                continue;
            }

            self::assertFalse(str_ends_with($file->getFilename(), '.sql'), $file->getPathname());
        }
    }

    public function testReleaseDocsPreserveNoCrudBoundary(): void
    {
        $content = (string) file_get_contents(dirname(__DIR__, 2) . '/docs/release-packaging-quality.md');

        self::assertStringContainsString('CRUD controllers', $content);
        self::assertStringContainsString('CRUD routes', $content);
        self::assertStringContainsString('CRUD YAML declarations', $content);
        self::assertStringContainsString('Relating remains a CRM-oriented business lifecycle component', $content);
    }
}
