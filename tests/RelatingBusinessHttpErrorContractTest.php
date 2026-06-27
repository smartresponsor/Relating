<?php

declare(strict_types=1);

namespace App\Tests;

use App\Kernel;
use JsonException;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class RelatingBusinessHttpErrorContractTest extends TestCase
{
    private Kernel $kernel;

    protected function setUp(): void
    {
        $this->resetDebugStore();
        $this->kernel = new Kernel('test', true);
        $this->kernel->boot();
    }

    protected function tearDown(): void
    {
        $this->kernel->shutdown();
    }

    /** @throws JsonException */
    public function testMissingRequiredBusinessFieldsReturnStableJsonErrors(): void
    {
        $cases = [
            ['/relating/relationship/start', [], 'Missing required business field: vendor_reference.'],
            ['/relating/lead/capture', [], 'Missing required business field: source_code.'],
            ['/relating/lead/qualify', ['score' => 80], 'Missing required business field: lead_reference.'],
            ['/relating/lead/qualify', ['lead_reference' => 'lead-negative'], 'Missing required business field: score.'],
            ['/relating/opportunity/open', [], 'Missing required business field: relationship_reference.'],
            [
                '/relating/opportunity/stage-transition',
                ['opportunity_reference' => 'opportunity-negative', 'stage_reference' => 'stage-negative'],
                'Missing required business field: probability.',
            ],
        ];

        foreach ($cases as [$path, $payload, $message]) {
            $error = $this->postJsonError($path, $payload);

            self::assertSame('Relating', $error['component'] ?? null, $path);
            self::assertSame('business_payload_invalid', $error['error']['code'] ?? null, $path);
            self::assertSame($message, $error['error']['message'] ?? null, $path);
        }
    }

    /** @throws JsonException */
    public function testMalformedJsonReturnsStableJsonError(): void
    {
        $error = $this->requestJsonError(Request::create(
            '/relating/lead/capture',
            'POST',
            [],
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            '{'
        ));

        self::assertSame('Relating', $error['component'] ?? null);
        self::assertSame('business_payload_invalid', $error['error']['code'] ?? null);
        self::assertSame('Business request payload must be valid JSON.', $error['error']['message'] ?? null);
    }

    /** @throws JsonException */
    public function testMissingBusinessReferencesReturnStableJsonErrors(): void
    {
        $cases = [
            ['/relating/lead/qualify', ['lead_reference' => 'lead-missing', 'score' => 80], 'Lead was not found for reference: lead-missing'],
            [
                '/relating/lead/convert',
                ['lead_reference' => 'lead-missing', 'vendor_reference' => 'vendor-positive'],
                'Lead was not found for reference: lead-missing',
            ],
            [
                '/relating/opportunity/open',
                [
                    'relationship_reference' => 'relationship-missing',
                    'pipeline_reference' => 'pipeline-positive',
                    'stage_reference' => 'stage-positive',
                    'name' => 'Missing relationship opportunity',
                ],
                'Relationship was not found for reference: relationship-missing',
            ],
            [
                '/relating/opportunity/stage-transition',
                ['opportunity_reference' => 'opportunity-missing', 'stage_reference' => 'stage-positive', 'probability' => 50],
                'Opportunity was not found for reference: opportunity-missing',
            ],
        ];

        foreach ($cases as [$path, $payload, $message]) {
            $error = $this->postJsonError($path, $payload, Response::HTTP_NOT_FOUND, 'business_reference_not_found');

            self::assertSame('Relating', $error['component'] ?? null, $path);
            self::assertSame('business_reference_not_found', $error['error']['code'] ?? null, $path);
            self::assertSame($message, $error['error']['message'] ?? null, $path);
        }
    }

    /**
     * @param array<string, mixed> $payload
     * @return array<string, mixed>
     * @throws JsonException
     */
    private function postJsonError(string $path, array $payload, int $expectedStatusCode = Response::HTTP_BAD_REQUEST, string $expectedErrorCode = 'business_payload_invalid'): array
    {
        return $this->requestJsonError(Request::create(
            $path,
            'POST',
            [],
            [],
            [],
            [
                'CONTENT_TYPE' => 'application/json',
                'HTTP_ACCEPT' => 'application/json',
            ],
            json_encode($payload, JSON_THROW_ON_ERROR)
        ), $expectedStatusCode, $expectedErrorCode);
    }

    /** @return array<string, mixed> */
    private function requestJsonError(Request $request, int $expectedStatusCode = Response::HTTP_BAD_REQUEST, string $expectedErrorCode = 'business_payload_invalid'): array
    {
        $response = $this->kernel->handle($request);

        try {
            self::assertSame($expectedStatusCode, $response->getStatusCode(), $response->getContent());
            self::assertSame($expectedErrorCode, $response->headers->get('X-Relating-Error'));
            self::assertStringStartsWith('application/json', $response->headers->get('content-type', ''));

            $decoded = json_decode($response->getContent(), true, 512, JSON_THROW_ON_ERROR);
            self::assertIsArray($decoded);

            return $decoded;
        } finally {
            $this->kernel->terminate($request, $response);
        }
    }

    private function resetDebugStore(): void
    {
        $storePath = dirname(__DIR__) . '/var/relating-debug-store.json';

        if (is_file($storePath)) {
            unlink($storePath);
        }
    }
}
