<?php

declare(strict_types=1);

namespace App\Relating\Service\ReadModel;

use App\Relating\Snapshot\RelationReadModelProjectionResult;
use App\Relating\Snapshot\RelationRelatingReadModelInterface;

interface RelationRelatingReadModelPublisherInterface
{
    public function publishProjectedReadModel(RelationRelatingReadModelInterface $readModel): RelationReadModelProjectionResult;
}
