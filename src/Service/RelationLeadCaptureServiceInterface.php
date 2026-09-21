<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\Entity\RelationLead;

interface RelationLeadCaptureServiceInterface
{
    /**
     * @param array<string, mixed> $payload
     */
    public function captureLeadFromBusinessSignal(string $sourceCode, array $payload): RelationLead;
}
