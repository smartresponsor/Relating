<?php

declare(strict_types=1);

namespace App\Relating\Repository;

use App\Relating\Entity\RelationshipEntity;

interface RelationshipRepositoryInterface
{
    public function rememberStarted(RelationshipEntity $relationship): void;

    public function rememberLinkedToVendor(RelationshipEntity $relationship): void;

    public function rememberLifecycleStageChanged(RelationshipEntity $relationship): void;

    public function rememberHealthScoreChanged(RelationshipEntity $relationship): void;

    public function relationshipOf(string $relationshipReference): ?RelationshipEntity;

    public function relationshipForVendor(string $vendorReference): ?RelationshipEntity;

    /** @return list<RelationshipEntity> */
    public function relationshipsNeedingActionBefore(\DateTimeImmutable $deadline): array;
}
