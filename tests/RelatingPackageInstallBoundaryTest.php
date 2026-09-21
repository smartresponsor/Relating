<?php

declare(strict_types=1);

namespace App\Relating\Tests;

use PHPUnit\Framework\TestCase;

final class RelatingPackageInstallBoundaryTest extends TestCase
{
    public function testPackageInstallDocsExist(): void
    {
        $root = \dirname(__DIR__);

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
            self::assertFileExists($root.'/'.$relativePath, $relativePath);
        }
    }

    public function testSkeletonDoesNotIntroduceBundleMagicOrDomainPath(): void
    {
        $root = \dirname(__DIR__);

        self::assertDirectoryDoesNotExist($root.'/src/Domain');
        self::assertDirectoryDoesNotExist($root.'/migrations');

        $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($root));

        foreach ($iterator as $file) {
            if (!$file instanceof \SplFileInfo || !$file->isFile()) {
                continue;
            }

            self::assertFalse(str_ends_with($file->getFilename(), '.sql'), $file->getPathname());
        }
    }

    public function testComposerAutoloadNotesFollowCanon018Identity(): void
    {
        $content = file_get_contents(\dirname(__DIR__).'/docs/composer-autoload-notes.md');
        self::assertIsString($content);

        self::assertStringContainsString('"App\\\\Relating\\\\": "src/"', $content);
        self::assertStringContainsString('src', $content);
        self::assertStringContainsString('RelatingBundle', $content);
    }

    public function testInstallReadinessKeepsBusinessRouteOnlyBoundary(): void
    {
        $content = file_get_contents(\dirname(__DIR__).'/docs/package-install-readiness.md');
        self::assertIsString($content);

        self::assertStringContainsString('No CRUD route is part of this package', $content);
        self::assertStringContainsString('/relating/relationship/start', $content);
        self::assertStringContainsString('/relating/lead/qualify', $content);
        self::assertStringContainsString('/relating/ai/suggestion/review', $content);
    }
}
