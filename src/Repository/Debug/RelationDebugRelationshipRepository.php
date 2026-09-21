<?php

declare(strict_types=1);

namespace App\Relating\Repository\Debug;

use App\Relating\Entity\Relationship;
use App\Relating\Repository\RelationshipRepositoryInterface;

final readonly class RelationDebugRelationshipRepository implements RelationshipRepositoryInterface
{
    private const BUCKET = 'relationship';

    public function __construct(
        private RelationDebugRelatingObjectStore $store,
    ) {
    }

    public function rememberStarted(Relationship $relationship): void
    {
        $this->remember($relationship);
    }

    public function rememberLinkedToVendor(Relationship $relationship): void
    {
        $this->remember($relationship);
    }

    public function rememberLifecycleStageChanged(Relationship $relationship): void
    {
        $this->remember($relationship);
    }

    public function rememberHealthScoreChanged(Relationship $relationship): void
    {
        $this->remember($relationship);
    }

    public function relationshipOf(string $relationshipReference): ?Relationship
    {
        $relationship = $this->store->one(self::BUCKET, $relationshipReference);

        return $relationship instanceof Relationship ? $relationship : null;
    }

    public function relationshipForVendor(string $vendorReference): ?Relationship
    {
        foreach ($this->store->all(self::BUCKET) as $relationship) {
            if ($relationship instanceof Relationship && $relationship->vendorReference() === $vendorReference) {
                return $relationship;
            }
        }

        return null;
    }

    public function relationshipsNeedingActionBefore(\DateTimeImmutable $deadline): array
    {
        return array_values(array_filter(
            $this->store->all(self::BUCKET),
            static fn (mixed $item): bool => $item instanceof Relationship,
        ));
    }

    private function remember(Relationship $relationship): void
    {
        $this->store->remember(self::BUCKET, $relationship->id(), $relationship);
    }
}
