<?php

declare(strict_types=1);

namespace App\Relating\Repository;

use App\Relating\Entity\RelationshipEntity;
use Doctrine\ORM\EntityManagerInterface;

final readonly class RelationDoctrineRelationshipRepository implements RelationshipRepositoryInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {
    }

    public function rememberStarted(RelationshipEntity $relationship): void
    {
        $this->persistAndFlush($relationship);
    }

    public function rememberLinkedToVendor(RelationshipEntity $relationship): void
    {
        $this->persistAndFlush($relationship);
    }

    public function rememberLifecycleStageChanged(RelationshipEntity $relationship): void
    {
        $this->persistAndFlush($relationship);
    }

    public function rememberHealthScoreChanged(RelationshipEntity $relationship): void
    {
        $this->persistAndFlush($relationship);
    }

    public function relationshipOf(string $relationshipReference): ?RelationshipEntity
    {
        $relationship = $this->entityManager->find(RelationshipEntity::class, $relationshipReference);

        return $relationship instanceof RelationshipEntity ? $relationship : null;
    }

    public function relationshipForVendor(string $vendorReference): ?RelationshipEntity
    {
        $relationship = $this->entityManager->getRepository(RelationshipEntity::class)
            ->createQueryBuilder('relationship')
            ->andWhere('relationship.vendorReference = :vendorReference')
            ->setParameter('vendorReference', $vendorReference)
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();

        return $relationship instanceof RelationshipEntity ? $relationship : null;
    }

    public function relationshipsNeedingActionBefore(\DateTimeImmutable $deadline): array
    {
        $relationships = $this->entityManager->getRepository(RelationshipEntity::class)
            ->createQueryBuilder('relationship')
            ->andWhere('relationship.nextActionAt IS NOT NULL')
            ->andWhere('relationship.nextActionAt <= :deadline')
            ->setParameter('deadline', $deadline)
            ->orderBy('relationship.nextActionAt', 'ASC')
            ->getQuery()
            ->getResult();

        return array_values(array_filter($relationships, static fn (mixed $item): bool => $item instanceof RelationshipEntity));
    }

    private function persistAndFlush(RelationshipEntity $relationship): void
    {
        $this->entityManager->persist($relationship);
        $this->entityManager->flush();
    }
}
