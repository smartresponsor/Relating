<?php

declare(strict_types=1);

namespace App\Relating\Repository;

use App\Relating\Entity\RelationOpportunityEntity;
use App\Relating\Enum\RelationOpportunityStatus;
use Doctrine\ORM\EntityManagerInterface;

final readonly class RelationDoctrineOpportunityRepository implements RelationOpportunityRepositoryInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {
    }

    public function rememberOpened(RelationOpportunityEntity $opportunity): void
    {
        $this->persistAndFlush($opportunity);
    }

    public function rememberStageChanged(RelationOpportunityEntity $opportunity): void
    {
        $this->persistAndFlush($opportunity);
    }

    public function rememberForecastRecalculated(RelationOpportunityEntity $opportunity): void
    {
        $this->persistAndFlush($opportunity);
    }

    public function rememberWon(RelationOpportunityEntity $opportunity): void
    {
        $this->persistAndFlush($opportunity);
    }

    public function rememberLost(RelationOpportunityEntity $opportunity): void
    {
        $this->persistAndFlush($opportunity);
    }

    public function opportunityOf(string $opportunityReference): ?RelationOpportunityEntity
    {
        $opportunity = $this->entityManager->find(RelationOpportunityEntity::class, $opportunityReference);

        return $opportunity instanceof RelationOpportunityEntity ? $opportunity : null;
    }

    public function activeOpportunitiesForRelationship(string $relationshipReference): array
    {
        $opportunities = $this->entityManager->getRepository(RelationOpportunityEntity::class)
            ->createQueryBuilder('opportunity')
            ->andWhere('opportunity.relationshipReference = :relationshipReference')
            ->andWhere('opportunity.status IN (:activeStatuses)')
            ->setParameter('relationshipReference', $relationshipReference)
            ->setParameter('activeStatuses', [
                RelationOpportunityStatus::Open->value,
                RelationOpportunityStatus::Paused->value,
            ])
            ->orderBy('opportunity.updatedAt', 'DESC')
            ->getQuery()
            ->getResult();

        return array_values(array_filter($opportunities, static fn (mixed $item): bool => $item instanceof RelationOpportunityEntity));
    }

    private function persistAndFlush(RelationOpportunityEntity $opportunity): void
    {
        $this->entityManager->persist($opportunity);
        $this->entityManager->flush();
    }
}
