<?php

declare(strict_types=1);


namespace App\Service\ReadModel;

use App\ReadModel\CaseSlaReadModel;

interface CaseSlaReadModelProjectorInterface
{
    /**
     * @param array<string, mixed> $context
     */
    public function projectCaseSla(string $caseReference, array $context = []): CaseSlaReadModel;
}
