<?php

declare(strict_types=1);

namespace App\Relating\Tests;

use PHPUnit\Framework\TestCase;

final class RelatingMessageHandlerBoundaryTest extends TestCase
{
    public function testMessageHandlersUseBusinessBoundaryNames(): void
    {
        $root = dirname(__DIR__, 2);
        $handlerDirectory = $root . '/src/Relating/MessageHandler';

        self::assertDirectoryExists($handlerDirectory);

        $forbidden = '/(Create|Update|Delete|Remove|Persist|Flush|Save)(Entity|Record|Model|Handler|Message)?/';
        $files = glob($handlerDirectory . '/*MessageHandler.php') ?: [];

        self::assertNotEmpty($files);

        foreach ($files as $file) {
            $base = basename($file);
            self::assertDoesNotMatchRegularExpression($forbidden, $base, $base);

            $contents = (string) file_get_contents($file);
            self::assertStringNotContainsString('EntityManagerInterface', $contents, $base);
            self::assertStringNotContainsString('Connection $', $contents, $base);
            self::assertStringNotContainsString('executeStatement', $contents, $base);
            self::assertStringNotContainsString('SELECT ', $contents, $base);
            self::assertStringNotContainsString('INSERT ', $contents, $base);
            self::assertStringNotContainsString('UPDATE ', $contents, $base);
            self::assertStringNotContainsString('DELETE ', $contents, $base);
        }
    }
}
