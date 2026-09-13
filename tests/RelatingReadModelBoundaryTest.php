<?php

declare(strict_types=1);

namespace App\Tests;

use PHPUnit\Framework\TestCase;

final class RelatingReadModelBoundaryTest extends TestCase
{
    public function testReadModelLayerDoesNotBecomeCrudOrSqlInfrastructure(): void
    {
        $root = \dirname(__DIR__);
        $directories = [
            $root.'/src/Snapshot',
            $root.'/src/Service/ReadModel',
        ];

        foreach ($directories as $directory) {
            self::assertDirectoryExists($directory);
        }

        $files = [];
        foreach ($directories as $directory) {
            $files = array_merge($files, glob($directory.'/*.php') ?: []);
        }

        self::assertNotEmpty($files);

        foreach ($files as $file) {
            $base = basename($file);
            $contents = (string) file_get_contents($file);

            self::assertDoesNotMatchRegularExpression('/(Create|Update|Delete|Remove|Persist|Flush|Save)(Entity|Record|Model|Handler|Message)?/', $base, $base);
            self::assertStringNotContainsString('EntityManagerInterface', $contents, $base);
            self::assertStringNotContainsString('Doctrine\\ORM', $contents, $base);
            self::assertStringNotContainsString('Connection $', $contents, $base);
            self::assertStringNotContainsString('executeStatement', $contents, $base);
            self::assertStringNotContainsString('SELECT ', $contents, $base);
            self::assertStringNotContainsString('INSERT ', $contents, $base);
            self::assertStringNotContainsString('UPDATE ', $contents, $base);
            self::assertStringNotContainsString('DELETE ', $contents, $base);
        }
    }

    public function testProjectionViewsDoNotImportEntities(): void
    {
        $root = \dirname(__DIR__);
        $viewDirectory = $root.'/src/Snapshot/View';
        $files = glob($viewDirectory.'/*ProjectionView.php') ?: [];

        self::assertNotEmpty($files);

        foreach ($files as $file) {
            $contents = (string) file_get_contents($file);
            self::assertStringNotContainsString('App\\Entity', $contents, basename($file));
        }
    }
}
