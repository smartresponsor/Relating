<?php

declare(strict_types=1);

namespace App\Service\ReadModel;

use App\Snapshot\ReadModelProjectionResult;
use App\Snapshot\RelatingReadModelInterface;

interface RelatingReadModelPublisherInterface
{
    public function publishProjectedReadModel(RelatingReadModelInterface $readModel): ReadModelProjectionResult;
}
