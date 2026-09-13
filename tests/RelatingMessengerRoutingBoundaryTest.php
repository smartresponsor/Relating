<?php

declare(strict_types=1);

namespace App\Tests;

use PHPUnit\Framework\TestCase;

final class RelatingMessengerRoutingBoundaryTest extends TestCase
{
    public function testMessengerRoutingUsesBusinessMessagesOnly(): void
    {
        $root = \dirname(__DIR__);
        $messageDir = $root.'/src/Message';

        self::assertDirectoryExists($messageDir);

        $forbiddenPrefixes = [
            'Create',
            'Update',
            'Delete',
            'Save',
            'Persist',
            'Flush',
            'Remove',
        ];

        foreach (glob($messageDir.'/*Message.php') ?: [] as $file) {
            $class = basename($file, '.php');

            foreach ($forbiddenPrefixes as $prefix) {
                self::assertFalse(
                    str_starts_with($class, $prefix),
                    \sprintf('Relating message must be business-named, got %s', $class),
                );
            }
        }
    }

    public function testMessengerDistDoesNotRouteCrudMessages(): void
    {
        $root = \dirname(__DIR__);
        $file = $root.'/config/packages/relating_messenger.yaml.dist';

        self::assertFileExists($file);

        $content = (string) file_get_contents($file);

        foreach (['Create', 'Update', 'Delete', 'Save', 'Persist', 'Flush', 'Remove'] as $prefix) {
            self::assertStringNotContainsString(
                '\\Message\\'.$prefix,
                $content,
                \sprintf('Messenger routing must not include %s*Message', $prefix),
            );
        }
    }
}
