<?php

declare(strict_types=1);

namespace App\Tests\Relating;

use App\Kernel;
use JsonException;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class RelatingSymfonyHttpSmokeTest extends TestCase
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
    public function testCatalogAndBusinessHttpRoutesReturnJson(): void
    {
        $catalog = $this->getJson('/relating/catalog');
        self::assertSame('Relating', $catalog['component'] ?? null);
        self::assertSame('CRM', $catalog['marketCategory'] ?? null);
        self::assertSame('Relationship', $catalog['rootObject'] ?? null);

        $relationship = $this->postJson('/relating/relationship/start', [
            'vendor_reference' => 'vendor-smoke-001',
            'relationship_kind' => 'prospect',
            'tenant_reference' => 'tenant-smoke',
            'owner_reference' => 'owner-smoke',
            'context' => ['source' => 'http-smoke'],
        ]);
        $this->assertBusinessResult($relationship, 'relationship-start');

        $lead = $this->postJson('/relating/lead/capture', [
            'source_code' => 'website',
            'tenant_reference' => 'tenant-smoke',
            'display_name' => 'Smoke Lead',
            'company_name' => 'Smoke Company',
            'email' => 'smoke@example.test',
            'payload' => ['source' => 'http-smoke'],
        ]);
        $this->assertBusinessResult($lead, 'lead-capture');

        $qualified = $this->postJson('/relating/lead/qualify', [
            'lead_reference' => $lead['subject_reference'],
            'score' => 80,
            'temperature' => 'warm',
            'context' => ['source' => 'http-smoke'],
        ]);
        $this->assertBusinessResult($qualified, 'lead-qualification');

        $converted = $this->postJson('/relating/lead/convert', [
            'lead_reference' => $lead['subject_reference'],
            'vendor_reference' => 'vendor-smoke-001',
            'pipeline_reference' => 'pipeline-smoke',
            'stage_reference' => 'stage-new',
            'opportunity_name' => 'Smoke Opportunity',
            'context' => ['source' => 'http-smoke'],
        ]);
        $this->assertBusinessResult($converted, 'lead-conversion');

        $opportunity = $this->postJson('/relating/opportunity/open', [
            'relationship_reference' => $relationship['subject_reference'],
            'pipeline_reference' => 'pipeline-smoke',
            'stage_reference' => 'stage-new',
            'name' => 'Smoke Direct Opportunity',
            'tenant_reference' => 'tenant-smoke',
            'currency' => 'USD',
            'amount_minor' => 10000,
            'context' => ['source' => 'http-smoke'],
        ]);
        $this->assertBusinessResult($opportunity, 'opportunity-open');

        $stage = $this->postJson('/relating/opportunity/stage-transition', [
            'opportunity_reference' => $opportunity['subject_reference'],
            'stage_reference' => 'stage-qualified',
            'probability' => 60,
            'forecast_category' => 'pipeline',
            'context' => ['source' => 'http-smoke'],
        ]);
        $this->assertBusinessResult($stage, 'opportunity-stage-transition');

        $activity = $this->postJson('/relating/activity/record', [
            'target_type' => 'opportunity',
            'target_reference' => $opportunity['subject_reference'],
            'activity_type' => 'task',
            'direction' => 'internal',
            'relationship_reference' => $relationship['subject_reference'],
            'owner_reference' => 'owner-smoke',
            'subject' => 'Smoke follow-up',
            'body' => 'Smoke activity body',
            'payload' => ['source' => 'http-smoke'],
        ]);
        $this->assertBusinessResult($activity, 'activity-record');

        $timeline = $this->postJson('/relating/timeline/project', [
            'target_type' => 'opportunity',
            'target_reference' => $opportunity['subject_reference'],
            'event_kind' => 'neighbor_signal_captured',
            'relationship_reference' => $relationship['subject_reference'],
            'source_component' => 'Relating',
            'source_reference' => $activity['subject_reference'],
            'payload' => ['source' => 'http-smoke'],
        ]);
        $this->assertBusinessResult($timeline, 'timeline-project');
    }

    /** @return array<string, mixed> */
    private function getJson(string $path): array
    {
        return $this->requestJson(Request::create($path, 'GET'));
    }

    /**
     * @param array<string, mixed> $payload
     * @return array<string, mixed>
     * @throws JsonException
     */
    private function postJson(string $path, array $payload): array
    {
        return $this->requestJson(Request::create(
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
        ));
    }

    /** @return array<string, mixed> */
    private function requestJson(Request $request): array
    {
        $response = $this->kernel->handle($request);

        try {
            self::assertSame(Response::HTTP_OK, $response->getStatusCode(), $response->getContent());
            self::assertStringStartsWith('application/json', $response->headers->get('content-type', ''));
            $decoded = json_decode($response->getContent(), true, 512, JSON_THROW_ON_ERROR);
            self::assertIsArray($decoded);

            return $decoded;
        } finally {
            $this->kernel->terminate($request, $response);
        }
    }

    /** @param array<string, mixed> $result */
    private function assertBusinessResult(array $result, string $businessAction): void
    {
        self::assertSame('Relating', $result['component'] ?? null);
        self::assertSame($businessAction, $result['business_action'] ?? null);
        self::assertNotSame('', $result['subject_reference'] ?? '');
        self::assertIsArray($result['payload'] ?? null);
    }

    private function resetDebugStore(): void
    {
        $storePath = dirname(__DIR__, 2) . '/var/relating-debug-store.json';

        if (is_file($storePath)) {
            unlink($storePath);
        }
    }
}
