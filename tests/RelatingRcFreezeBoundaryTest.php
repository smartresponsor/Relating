<?php

declare(strict_types=1);

namespace App\Tests;

use PHPUnit\Framework\TestCase;

final class RelatingRcFreezeBoundaryTest extends TestCase
{
    public function testRcFreezeFilesExist(): void
    {
        $root = dirname(__DIR__);

        foreach ([
            'VERSION',
            'RELEASE_NOTES.md',
            'docs/preinstall-rc-freeze.md',
            'docs/rc-immutability-checklist.md',
            'docs/first-extraction-flow.md',
            'docs/s17-preinstall-rc-freeze-report.md',
        ] as $relativePath) {
            self::assertFileExists($root . '/' . $relativePath, $relativePath);
        }
    }

    public function testRcVersionIsPinned(): void
    {
        $version = trim((string) file_get_contents(dirname(__DIR__) . '/VERSION'));

        self::assertSame('0.1.0-rc.1', $version);
    }

    public function testRcFreezeDocumentationKeepsCrudBoundary(): void
    {
        $root = dirname(__DIR__);
        $content = (string) file_get_contents($root . '/docs/preinstall-rc-freeze.md');

        self::assertStringContainsString('add CRUD route surface', $content);
        self::assertStringContainsString('add migrations', $content);
        self::assertStringContainsString('add SQL files', $content);
        self::assertStringContainsString('add /src/Domain', $content);
    }
}
