<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\View\RelatingViewInterface;

interface RelatingViewBuilderInterface
{
    /**
     * @param array<string, mixed> $criteria
     */
    public function buildBusinessView(string $viewCode, array $criteria = []): RelatingViewInterface;
}
