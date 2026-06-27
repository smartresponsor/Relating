<?php

declare(strict_types=1);

namespace App\Service;

use App\Enum\NeighborComponent;
use App\Enum\NeighborReferenceKind;

interface NeighborReferenceCatalogInterface
{
    /**
     * @return list<NeighborComponent>
     */
    public function knownComponents(): array;

    /**
     * @return list<NeighborReferenceKind>
     */
    public function supportedKindsFor(NeighborComponent $component): array;

    public function accepts(NeighborComponent $component, NeighborReferenceKind $kind): bool;
}
