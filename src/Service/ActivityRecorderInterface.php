<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Activity;

interface ActivityRecorderInterface
{
    /**
     * @param array<string, mixed> $payload
     */
    public function recordBusinessActivity(string $targetType, string $targetReference, string $activityType, array $payload = []): Activity;
}
