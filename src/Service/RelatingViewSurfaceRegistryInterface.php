<?php

declare(strict_types=1);

namespace App\Service;

use App\Enum\RelatingViewSurface;

interface RelatingViewSurfaceRegistryInterface
{
    /**
     * @return list<RelatingViewSurface>
     */
    public function businessSurfaces(): array;

    public function supports(RelatingViewSurface $surface): bool;
}
