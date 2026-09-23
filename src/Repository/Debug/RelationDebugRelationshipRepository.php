<?php

declare(strict_types=1);

namespace App\Relating\Repository\Debug;

use App\Relating\Entity\RelationshipEntity;
use App\Relating\Repository\RelationshipRepositoryInterface;

final readonly class RelationDebugRelationshipRepository implements RelationshipRepositoryInterface
{
    private const BUCKET = 'relationship';

    public function __construct(
        private RelationDebugRelatingObjectStore $store,
    ) {
    }

    public function rememberStarted(RelationshipEntity $relationship): void
    {
        $this->remember($relationship);
    }

    public function rememberLinkedToVendor(RelationshipEntity $relationship): void
    {
        $this->remember($relationship);
    }

    public function rememberLifecycleStageChanged(RelationshipEntity $relationship): void
    {
        $this->remember($relationship);
    }

    public function rememberHealthScoreChanged(RelationshipEntity $relationship): void
    {
        $this->remember($relationship);
    }

    public function relationshipOf(string $relationshipReference): ?RelationshipEntity
    {
        $relationship = $this->store->one(self::BUCKET, $relationshipReference);

        return $relationship instanceof RelationshipEntity ? $relationship : null;
    }

    public function relationshipForVendor(string $vendorReference): ?RelationshipEntity
    {
        foreach ($this->store->all(self::BUCKET) as $relationship) {
            if ($relationship instanceof RelationshipEntity && $relationship->vendorReference() === $vendorReference) {
                return $relationship;
            }
        }

        return null;
    }

    public function relationshipsNeedingActionBefore(\DateTimeImmutable $deadline): array
    {
        return array_values(array_filter(
            $this->store->all(self::BUCKET),
            static fn (mixed $item): bool => $item instanceof RelationshipEntity,
        ));
    }

    private function remember(RelationshipEntity $relationship): void
    {
        $this->store->remember(self::BUCKET, $relationship->id(), $relationship);
    }
}
