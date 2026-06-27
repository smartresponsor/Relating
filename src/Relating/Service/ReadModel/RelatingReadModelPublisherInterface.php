<?php

declare(strict_types=1);


namespace App\Relating\Service\ReadModel;

use App\Relating\ReadModel\ReadModelProjectionResult;
use App\Relating\ReadModel\RelatingReadModelInterface;

interface RelatingReadModelPublisherInterface
{
    public function publishProjectedReadModel(RelatingReadModelInterface $readModel): ReadModelProjectionResult;
}
