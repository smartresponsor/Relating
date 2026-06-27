<?php

declare(strict_types=1);

namespace App\Tests\Relating;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class RelatingRouteBoundaryTest extends TestCase
{
    /**
     * @return iterable<string>
     */
    public static function forbiddenCrudActions(): iterable
    {
        yield 'index' => ['index'];
        yield 'create' => ['create'];
        yield 'read' => ['read'];
        yield 'update' => ['update'];
        yield 'delete' => ['delete'];
    }

    /**
     * @dataProvider forbiddenCrudActions
     */
    #[DataProvider('forbiddenCrudActions')]
    public function testRouteConfigDoesNotDeclareCrudActions(string $action): void
    {
        $routeConfig = dirname(__DIR__, 2).'/config/routes/relating.yaml';

        self::assertFileExists($routeConfig);

        $content = file_get_contents($routeConfig);
        self::assertIsString($content);

        $withoutComments = implode("\n", array_filter(
            explode("\n", $content),
            static fn (string $line): bool => !str_starts_with(trim($line), '#')
        ));

        self::assertDoesNotMatchRegularExpression('/(^|[^a-z])'.preg_quote($action, '/').'([^a-z]|$)/i', $withoutComments);
    }

    /**
     * @dataProvider forbiddenCrudActions
     */
    #[DataProvider('forbiddenCrudActions')]
    public function testRelatingControllersDoNotUseCrudActionNames(string $action): void
    {
        $controllerDir = dirname(__DIR__, 2).'/src/Relating/Controller';

        self::assertDirectoryExists($controllerDir);

        $files = glob($controllerDir.'/*.php') ?: [];
        foreach ($files as $file) {
            $content = file_get_contents($file);
            self::assertIsString($content);

            self::assertDoesNotMatchRegularExpression('/function\s+'.preg_quote($action, '/').'\s*\(/i', $content, basename($file));
            self::assertDoesNotMatchRegularExpression('/Route\s*\([^\)]*[\/_-]'.preg_quote($action, '/').'([\/_-]|\'|\")/i', $content, basename($file));
        }
    }
}
