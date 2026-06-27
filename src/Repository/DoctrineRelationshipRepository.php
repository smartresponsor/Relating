<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Relationship;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;

final readonly class DoctrineRelationshipRepository implements RelationshipRepositoryInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {
    }

    public function rememberStarted(Relationship $relationship): void
    {
        $this->persistAndFlush($relationship);
    }

    public function rememberLinkedToVendor(Relationship $relationship): void
    {
        $this->persistAndFlush($relationship);
    }

    public function rememberLifecycleStageChanged(Relationship $relationship): void
    {
        $this->persistAndFlush($relationship);
    }

    public function rememberHealthScoreChanged(Relationship $relationship): void
    {
        $this->persistAndFlush($relationship);
    }

    public function relationshipOf(string $relationshipReference): ?Relationship
    {
        $relationship = $this->entityManager->find(Relationship::class, $relationshipReference);

        return $relationship instanceof Relationship ? $relationship : null;
    }

    public function relationshipForVendor(string $vendorReference): ?Relationship
    {
        $relationship = $this->entityManager->getRepository(Relationship::class)
            ->createQueryBuilder('relationship')
            ->andWhere('relationship.vendorReference = :vendorReference')
            ->setParameter('vendorReference', $vendorReference)
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();

        return $relationship instanceof Relationship ? $relationship : null;
    }

    public function relationshipsNeedingActionBefore(DateTimeImmutable $deadline): array
    {
        $relationships = $this->entityManager->getRepository(Relationship::class)
            ->createQueryBuilder('relationship')
            ->andWhere('relationship.nextActionAt IS NOT NULL')
            ->andWhere('relationship.nextActionAt <= :deadline')
            ->setParameter('deadline', $deadline)
            ->orderBy('relationship.nextActionAt', 'ASC')
            ->getQuery()
            ->getResult();

        return array_values(array_filter($relationships, static fn (mixed $item): bool => $item instanceof Relationship));
    }

    private function persistAndFlush(Relationship $relationship): void
    {
        $this->entityManager->persist($relationship);
        $this->entityManager->flush();
    }
}
