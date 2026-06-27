<?php

declare(strict_types=1);

namespace App\Relating\Tests;

use App\Relating\View\AbstractArrayView;
use App\Relating\View\RelatingViewInterface;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

final class RelatingViewBoundaryTest extends TestCase
{
    public function testViewsDoNotImportEntities(): void
    {
        $viewPath = dirname(__DIR__, 2).'/src/Relating/View';
        $files = glob($viewPath.'/*.php') ?: [];

        self::assertNotEmpty($files);

        foreach ($files as $file) {
            $contents = (string) file_get_contents($file);
            self::assertStringNotContainsString('use App\\Relating\\Entity\\', $contents, basename($file));
            self::assertStringNotContainsString('App\\Relating\\Entity\\', $contents, basename($file));
        }
    }

    public function testAllConcreteArrayViewsImplementRelatingViewInterface(): void
    {
        $viewPath = dirname(__DIR__, 2).'/src/Relating/View';
        $files = glob($viewPath.'/*View.php') ?: [];

        self::assertNotEmpty($files);

        foreach ($files as $file) {
            $class = 'App\\Relating\\View\\'.basename($file, '.php');

            if (!class_exists($class)) {
                require_once $file;
            }

            $reflection = new ReflectionClass($class);

            if ($reflection->isAbstract()) {
                continue;
            }

            if (!$reflection->isSubclassOf(AbstractArrayView::class)) {
                continue;
            }

            self::assertTrue($reflection->implementsInterface(RelatingViewInterface::class), $class);
        }
    }

    public function testAbstractArrayViewRejectsObjectPayloads(): void
    {
        $view = new class(['id' => 'rel_1']) extends AbstractArrayView {
        };

        self::assertSame(['id' => 'rel_1'], $view->payload());

        $this->expectException(\InvalidArgumentException::class);

        new class(['entity' => new \stdClass()]) extends AbstractArrayView {
        };
    }
}
