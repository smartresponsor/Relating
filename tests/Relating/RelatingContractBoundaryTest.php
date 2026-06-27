<?php

declare(strict_types=1);

namespace App\Relating\Tests;

use PHPUnit\Framework\TestCase;

final class RelatingContractBoundaryTest extends TestCase
{
    public function testRepositoryAndServiceContractsDoNotExposeCrudMutationNames(): void
    {
        $root = dirname(__DIR__, 2) . '/src/Relating';
        $files = array_merge(
            glob($root . '/Repository/*Interface.php') ?: [],
            glob($root . '/Service/*Interface.php') ?: []
        );

        self::assertNotSame([], $files);

        $forbidden = [
            'function save(',
            'function create(',
            'function update(',
            'function delete(',
            'function remove(',
            'function persist(',
            'function flush(',
            'function index(',
            'function read(',
        ];

        foreach ($files as $file) {
            $content = file_get_contents($file);
            self::assertIsString($content);

            foreach ($forbidden as $needle) {
                self::assertStringNotContainsString($needle, $content, basename($file) . ' exposes forbidden contract method ' . $needle);
            }
        }
    }
}
