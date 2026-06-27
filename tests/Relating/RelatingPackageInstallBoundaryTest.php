<?php

declare(strict_types=1);

namespace App\Tests\Relating;

use PHPUnit\Framework\TestCase;

final class RelatingPackageInstallBoundaryTest extends TestCase
{
    public function testPackageInstallDocsExist(): void
    {
        $root = dirname(__DIR__, 2);

        $required = [
            'docs/package-install-readiness.md',
            'docs/composer-autoload-notes.md',
            'docs/symfony-import-checklist.md',
            'docs/local-install-validation.md',
            'docs/host-app-integration-checklist.md',
            'docs/no-bundle-magic-boundary.md',
            'docs/s14-package-install-report.md',
            'tools/validate-relating-package.ps1',
        ];

        foreach ($required as $relativePath) {
            self::assertFileExists($root . '/' . $relativePath, $relativePath);
        }
    }

    public function testSkeletonDoesNotIntroduceBundleMagicOrDomainPath(): void
    {
        $root = dirname(__DIR__, 2);

        self::assertDirectoryDoesNotExist($root . '/src/Domain');
        self::assertDirectoryDoesNotExist($root . '/migrations');

        $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($root));

        foreach ($iterator as $file) {
            if (!$file instanceof \SplFileInfo || !$file->isFile()) {
                continue;
            }

            self::assertStringNotEndsWith('.sql', $file->getFilename(), $file->getPathname());
        }
    }

    public function testComposerAutoloadNotesKeepDefaultAppNamespace(): void
    {
        $content = file_get_contents(dirname(__DIR__, 2) . '/docs/composer-autoload-notes.md');
        self::assertIsString($content);

        self::assertStringContainsString('"App\\\\": "src/"', $content);
        self::assertStringContainsString('src/Relating', $content);
        self::assertStringContainsString('RelatingBundle', $content);
    }

    public function testInstallReadinessKeepsBusinessRouteOnlyBoundary(): void
    {
        $content = file_get_contents(dirname(__DIR__, 2) . '/docs/package-install-readiness.md');
        self::assertIsString($content);

        self::assertStringContainsString('No CRUD route is part of this package', $content);
        self::assertStringContainsString('/relating/relationship/start', $content);
        self::assertStringContainsString('/relating/lead/qualify', $content);
        self::assertStringContainsString('/relating/ai-suggestion/review', $content);
    }
}
