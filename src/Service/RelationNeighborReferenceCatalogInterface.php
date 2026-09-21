<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\Enum\RelationNeighborComponent;
use App\Relating\Enum\RelationNeighborReferenceKind;

interface RelationNeighborReferenceCatalogInterface
{
    /**
     * @return list<RelationNeighborComponent>
     */
    public function knownComponents(): array;

    /**
     * @return list<RelationNeighborReferenceKind>
     */
    public function supportedKindsFor(RelationNeighborComponent $component): array;

    public function accepts(RelationNeighborComponent $component, RelationNeighborReferenceKind $kind): bool;
}
