<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\Enum\NeighborComponent;
use App\Relating\Enum\NeighborReferenceKind;

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
