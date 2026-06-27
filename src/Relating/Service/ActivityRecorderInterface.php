<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\Entity\Activity;

interface ActivityRecorderInterface
{
    /**
     * @param array<string, mixed> $payload
     */
    public function recordBusinessActivity(string $targetType, string $targetReference, string $activityType, array $payload = []): Activity;
}
