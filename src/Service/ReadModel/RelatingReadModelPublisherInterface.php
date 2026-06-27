<?php

declare(strict_types=1);


namespace App\Service\ReadModel;

use App\ReadModel\ReadModelProjectionResult;
use App\ReadModel\RelatingReadModelInterface;

interface RelatingReadModelPublisherInterface
{
    public function publishProjectedReadModel(RelatingReadModelInterface $readModel): ReadModelProjectionResult;
}
