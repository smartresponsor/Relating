<?php

declare(strict_types=1);

namespace App\Tests;

use PHPUnit\Framework\TestCase;

final class RelatingBusinessRouteSurfaceTest extends TestCase
{
    /**
     * @return array<int, string>
     */
    private function controllerFiles(): array
    {
        $files = glob(\dirname(__DIR__).'/src/Controller/*.php') ?: [];
        sort($files);

        return $files;
    }

    public function testBusinessRouteSurfaceDoesNotExposeCrudPathTokens(): void
    {
        $forbidden = [
            'index',
            'create',
            'read',
            'update',
            'delete',
            'list',
            'show',
            'edit',
            'store',
            'patch',
            'remove',
        ];

        foreach ($this->controllerFiles() as $file) {
            $content = file_get_contents($file);
            self::assertIsString($content);

            preg_match_all('/#\[Route\(\s*[\'\"]([^\'\"]+)[\'\"]/m', $content, $matches);

            foreach ($matches[1] ?? [] as $routePath) {
                foreach ($forbidden as $token) {
                    self::assertDoesNotMatchRegularExpression(
                        '/(^|[\/_-])'.preg_quote($token, '/').'($|[\/_-])/i',
                        $routePath,
                        basename($file).' exposes forbidden route token '.$token.' in '.$routePath
                    );
                }
            }
        }
    }

    public function testBusinessRouteSurfaceUsesOnlyApprovedActionPaths(): void
    {
        $approved = [
            '/relating/catalog',
            '/relating/relationship/start',
            '/relating/lead/capture',
            '/relating/lead/qualify',
            '/relating/lead/convert',
            '/relating/opportunity/open',
            '/relating/opportunity/stage/transition',
            '/relating/activity/record',
            '/relating/timeline/project',
            '/relating/ai/suggestion/review',
        ];

        $actual = [];
        foreach ($this->controllerFiles() as $file) {
            $content = file_get_contents($file);
            self::assertIsString($content);
            preg_match_all('/#\[Route\(\s*[\'\"]([^\'\"]+)[\'\"]/m', $content, $matches);
            $actual = array_merge($actual, $matches[1] ?? []);
        }

        sort($approved);
        sort($actual);

        self::assertSame($approved, $actual);
    }
}
