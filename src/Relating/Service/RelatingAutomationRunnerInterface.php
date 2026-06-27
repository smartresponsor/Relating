<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\Entity\AutomationRun;

interface RelatingAutomationRunnerInterface
{
    /**
     * @param array<string, mixed> $payload
     */
    public function runAutomationForBusinessTrigger(string $ruleReference, array $payload = []): AutomationRun;
}
