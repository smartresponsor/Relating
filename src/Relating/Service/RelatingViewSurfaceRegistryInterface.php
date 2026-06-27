<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\Enum\RelatingViewSurface;

interface RelatingViewSurfaceRegistryInterface
{
    /**
     * @return list<RelatingViewSurface>
     */
    public function businessSurfaces(): array;

    public function supports(RelatingViewSurface $surface): bool;
}
