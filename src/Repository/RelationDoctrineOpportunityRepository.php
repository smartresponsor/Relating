<?php

declare(strict_types=1);

namespace App\Relating\Repository;

use App\Relating\Entity\RelationOpportunity;
use App\Relating\Enum\RelationOpportunityStatus;
use Doctrine\ORM\EntityManagerInterface;

final readonly class RelationDoctrineOpportunityRepository implements RelationOpportunityRepositoryInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {
    }

    public function rememberOpened(RelationOpportunity $opportunity): void
    {
        $this->persistAndFlush($opportunity);
    }

    public function rememberStageChanged(RelationOpportunity $opportunity): void
    {
        $this->persistAndFlush($opportunity);
    }

    public function rememberForecastRecalculated(RelationOpportunity $opportunity): void
    {
        $this->persistAndFlush($opportunity);
    }

    public function rememberWon(RelationOpportunity $opportunity): void
    {
        $this->persistAndFlush($opportunity);
    }

    public function rememberLost(RelationOpportunity $opportunity): void
    {
        $this->persistAndFlush($opportunity);
    }

    public function opportunityOf(string $opportunityReference): ?RelationOpportunity
    {
        $opportunity = $this->entityManager->find(RelationOpportunity::class, $opportunityReference);

        return $opportunity instanceof RelationOpportunity ? $opportunity : null;
    }

    public function activeOpportunitiesForRelationship(string $relationshipReference): array
    {
        $opportunities = $this->entityManager->getRepository(RelationOpportunity::class)
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

        return array_values(array_filter($opportunities, static fn (mixed $item): bool => $item instanceof RelationOpportunity));
    }

    private function persistAndFlush(RelationOpportunity $opportunity): void
    {
        $this->entityManager->persist($opportunity);
        $this->entityManager->flush();
    }
}
