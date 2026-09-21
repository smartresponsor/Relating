<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\Entity\RelationAutomationRun;

interface RelationRelatingAutomationRunnerInterface
{
    /**
     * @param array<string, mixed> $payload
     */
    public function runAutomationForBusinessTrigger(string $ruleReference, array $payload = []): RelationAutomationRun;
}
