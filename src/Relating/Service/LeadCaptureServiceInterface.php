<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\Entity\Lead;

interface LeadCaptureServiceInterface
{
    /**
     * @param array<string, mixed> $payload
     */
    public function captureLeadFromBusinessSignal(string $sourceCode, array $payload): Lead;
}
