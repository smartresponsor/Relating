<?php

declare(strict_types=1);

namespace App\Tests;

use App\Snapshot\View\AbstractArrayView;
use App\Snapshot\View\RelatingViewInterface;
use PHPUnit\Framework\TestCase;

final class RelatingViewBoundaryTest extends TestCase
{
    public function testViewsDoNotImportEntities(): void
    {
        $viewPath = \dirname(__DIR__).'/src/Snapshot/View';
        $files = glob($viewPath.'/*.php') ?: [];

        self::assertNotEmpty($files);

        foreach ($files as $file) {
            $contents = (string) file_get_contents($file);
            self::assertStringNotContainsString('use App\\Entity\\', $contents, basename($file));
            self::assertStringNotContainsString('App\\Entity\\', $contents, basename($file));
        }
    }

    public function testAllConcreteArrayViewsImplementRelatingViewInterface(): void
    {
        $viewPath = \dirname(__DIR__).'/src/Snapshot/View';
        $files = glob($viewPath.'/*View.php') ?: [];

        self::assertNotEmpty($files);

        foreach ($files as $file) {
            $class = 'App\\Snapshot\\View\\'.basename($file, '.php');

            if (!class_exists($class)) {
                require_once $file;
            }

            $reflection = new \ReflectionClass($class);

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
        $view = new readonly class(['id' => 'rel_1']) extends AbstractArrayView {
        };

        self::assertSame(['id' => 'rel_1'], $view->payload());

        $this->expectException(\InvalidArgumentException::class);

        new readonly class(['entity' => new \stdClass()]) extends AbstractArrayView {
        };
    }
}
