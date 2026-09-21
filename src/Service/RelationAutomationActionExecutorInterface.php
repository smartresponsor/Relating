<?php

declare(strict_types=1);

namespace App\Relating\Service;

interface RelationAutomationActionExecutorInterface
{
    /**
     * @param array<string, mixed> $context
     */
    public function executeBusinessAction(string $actionReference, array $context): string;
}
