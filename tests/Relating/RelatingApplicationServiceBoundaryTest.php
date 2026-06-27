<?php

declare(strict_types=1);

namespace App\Tests\Relating;

use PHPUnit\Framework\TestCase;

final class RelatingApplicationServiceBoundaryTest extends TestCase
{
    public function testApplicationServicesDoNotExposeCrudActionNames(): void
    {
        $serviceDir = dirname(__DIR__, 2) . '/src/Relating/Application/Service';
        self::assertDirectoryExists($serviceDir);

        $files = glob($serviceDir . '/*.php') ?: [];
        self::assertNotSame([], $files);

        $forbidden = [
            'function index(',
            'function show(',
            'function list(',
            'function read(',
            'function store(',
            'function save(',
            'function edit(',
            'function patch(',
            'function put(',
            'function remove(',
            'function delete(',
        ];

        foreach ($files as $file) {
            $content = file_get_contents($file);
            self::assertIsString($content);

            foreach ($forbidden as $needle) {
                self::assertStringNotContainsString($needle, $content, basename($file) . ' exposes forbidden application method ' . $needle);
            }
        }
    }

    public function testAsyncMessagesDoNotUseGenericCrudNames(): void
    {
        $messageDir = dirname(__DIR__, 2) . '/src/Relating/Message';
        self::assertDirectoryExists($messageDir);

        self::assertFileDoesNotExist($messageDir . '/CreateAiSuggestionMessage.php');
        self::assertFileExists($messageDir . '/RaiseAiSuggestionMessage.php');
    }
}
