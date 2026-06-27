<?php

declare(strict_types=1);

namespace App\Service;

use App\View\CaseSlaView;

interface CaseSlaRecalculatorInterface
{
    /**
     * @param array<string, mixed> $context
     */
    public function recalculateCaseSla(string $caseReference, array $context = []): CaseSlaView;
}
