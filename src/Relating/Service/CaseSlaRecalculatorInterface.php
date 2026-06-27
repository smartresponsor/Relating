<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\View\CaseSlaView;

interface CaseSlaRecalculatorInterface
{
    /**
     * @param array<string, mixed> $context
     */
    public function recalculateCaseSla(string $caseReference, array $context = []): CaseSlaView;
}
