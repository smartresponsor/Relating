<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\AutomationRun;

interface RelatingAutomationRunnerInterface
{
    /**
     * @param array<string, mixed> $payload
     */
    public function runAutomationForBusinessTrigger(string $ruleReference, array $payload = []): AutomationRun;
}
