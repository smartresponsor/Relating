<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Relationship;

interface RelationshipRepositoryInterface
{
    public function rememberStarted(Relationship $relationship): void;

    public function rememberLinkedToVendor(Relationship $relationship): void;

    public function rememberLifecycleStageChanged(Relationship $relationship): void;

    public function rememberHealthScoreChanged(Relationship $relationship): void;

    public function relationshipOf(string $relationshipReference): ?Relationship;

    public function relationshipForVendor(string $vendorReference): ?Relationship;

    /** @return list<Relationship> */
    public function relationshipsNeedingActionBefore(\DateTimeImmutable $deadline): array;
}
