<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\Snapshot\View\RelationCaseSlaView;

interface RelationCaseSlaRecalculatorInterface
{
    /**
     * @param array<string, mixed> $context
     */
    public function recalculateCaseSla(string $caseReference, array $context = []): RelationCaseSlaView;
}
