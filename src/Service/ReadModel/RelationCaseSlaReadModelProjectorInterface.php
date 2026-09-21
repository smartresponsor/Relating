<?php

declare(strict_types=1);

namespace App\Relating\Service\ReadModel;

use App\Relating\Snapshot\RelationCaseSlaReadModel;

interface RelationCaseSlaReadModelProjectorInterface
{
    /**
     * @param array<string, mixed> $context
     */
    public function projectCaseSla(string $caseReference, array $context = []): RelationCaseSlaReadModel;
}
