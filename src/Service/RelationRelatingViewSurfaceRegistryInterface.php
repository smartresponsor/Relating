<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\Enum\RelationRelatingViewSurface;

interface RelationRelatingViewSurfaceRegistryInterface
{
    /**
     * @return list<RelationRelatingViewSurface>
     */
    public function businessSurfaces(): array;

    public function supports(RelationRelatingViewSurface $surface): bool;
}
