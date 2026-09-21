<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\Snapshot\View\RelationRelatingViewInterface;

interface RelationRelatingViewBuilderInterface
{
    /**
     * @param array<string, mixed> $criteria
     */
    public function buildBusinessView(string $viewCode, array $criteria = []): RelationRelatingViewInterface;
}
