<?php

declare(strict_types=1);

namespace App\Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class RelatingDocumentationBoundaryTest extends TestCase
{
    /**
     * @return iterable<string, array{string}>
     */
    public static function requiredDocumentationFiles(): iterable
    {
        yield 'documentation pack' => ['docs/documentation-finalization-pack.md'];
        yield 'canon' => ['docs/relating-canon.md'];
        yield 'adr index' => ['docs/boundary-adr-index.md'];
        yield 'source vacuum final report' => ['docs/source-vacuum-final-report.md'];
        yield 'implementation roadmap final' => ['docs/implementation-roadmap-final.md'];
        yield 'docs entrypoint' => ['docs/docs-entrypoint.md'];
    }

    /**
     * @dataProvider requiredDocumentationFiles
     */
    #[DataProvider('requiredDocumentationFiles')]
    public function testRequiredDocumentationFileExists(string $relativePath): void
    {
        self::assertFileExists(\dirname(__DIR__).'/'.$relativePath);
    }

    public function testDocumentationPackDeclaresCrudBoundary(): void
    {
        $content = file_get_contents(\dirname(__DIR__).'/docs/documentation-finalization-pack.md');
        self::assertIsString($content);

        self::assertStringContainsString('Relating never creates CRUD controllers', $content);
        self::assertStringContainsString('Relating never declares CRUD YAML routes', $content);
        self::assertStringContainsString('Relating exposes business routes only', $content);
    }

    public function testCanonKeepsRelatingAndRelationshipNames(): void
    {
        $content = file_get_contents(\dirname(__DIR__).'/docs/relating-canon.md');
        self::assertIsString($content);

        self::assertStringContainsString('Relating', $content);
        self::assertStringContainsString('Relationship', $content);
        self::assertStringContainsString('CRM', $content);
    }
}
