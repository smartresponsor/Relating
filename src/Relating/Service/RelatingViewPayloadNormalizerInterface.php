<?php

declare(strict_types=1);

namespace App\Relating\Service;

interface RelatingViewPayloadNormalizerInterface
{
    /**
     * @param array<string, mixed> $businessState
     * @return array<string, mixed>
     */
    public function normalizeForBusinessView(string $viewCode, array $businessState): array;
}
