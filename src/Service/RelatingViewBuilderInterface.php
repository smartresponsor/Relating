<?php

declare(strict_types=1);

namespace App\Service;

use App\Snapshot\View\RelatingViewInterface;

interface RelatingViewBuilderInterface
{
    /**
     * @param array<string, mixed> $criteria
     */
    public function buildBusinessView(string $viewCode, array $criteria = []): RelatingViewInterface;
}
