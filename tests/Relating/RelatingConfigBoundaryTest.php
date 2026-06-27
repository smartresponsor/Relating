<?php

declare(strict_types=1);

namespace App\Relating\Tests;

use PHPUnit\Framework\TestCase;

final class RelatingConfigBoundaryTest extends TestCase
{
    public function testConfigDoesNotDeclareCrudRoutesOrSqlFirstInfrastructure(): void
    {
        $root = dirname(__DIR__, 2);
        $configDir = $root . '/config';

        self::assertDirectoryExists($configDir);

        $forbidden = [
            '/relating/{entity}',
            '/relating/{id}',
            '/create',
            '/read',
            '/update',
            '/delete',
            '/list',
            '/show',
            '/edit',
            'CREATE TABLE',
            'ALTER TABLE',
            'DROP TABLE',
            'DELETE FROM',
            'INSERT INTO',
            'UPDATE ',
        ];

        foreach ($this->configFiles($configDir) as $file) {
            $content = (string) file_get_contents($file);

            foreach ($forbidden as $needle) {
                self::assertStringNotContainsString(
                    $needle,
                    $content,
                    sprintf('Forbidden config fragment %s found in %s', $needle, $file),
                );
            }
        }
    }

    /**
     * @return list<string>
     */
    private function configFiles(string $configDir): array
    {
        $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($configDir));
        $files = [];

        foreach ($iterator as $file) {
            if (!$file instanceof \SplFileInfo || !$file->isFile()) {
                continue;
            }

            if (!str_ends_with($file->getFilename(), '.yaml') && !str_ends_with($file->getFilename(), '.dist')) {
                continue;
            }

            $files[] = $file->getPathname();
        }

        sort($files);

        return $files;
    }
}
