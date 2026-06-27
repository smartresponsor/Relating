<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Opportunity;
use App\Enum\OpportunityStatus;
use Doctrine\ORM\EntityManagerInterface;

final readonly class DoctrineOpportunityRepository implements OpportunityRepositoryInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {
    }

    public function rememberOpened(Opportunity $opportunity): void
    {
        $this->persistAndFlush($opportunity);
    }

    public function rememberStageChanged(Opportunity $opportunity): void
    {
        $this->persistAndFlush($opportunity);
    }

    public function rememberForecastRecalculated(Opportunity $opportunity): void
    {
        $this->persistAndFlush($opportunity);
    }

    public function rememberWon(Opportunity $opportunity): void
    {
        $this->persistAndFlush($opportunity);
    }

    public function rememberLost(Opportunity $opportunity): void
    {
        $this->persistAndFlush($opportunity);
    }

    public function opportunityOf(string $opportunityReference): ?Opportunity
    {
        $opportunity = $this->entityManager->find(Opportunity::class, $opportunityReference);

        return $opportunity instanceof Opportunity ? $opportunity : null;
    }

    public function activeOpportunitiesForRelationship(string $relationshipReference): array
    {
        $opportunities = $this->entityManager->getRepository(Opportunity::class)
            ->createQueryBuilder('opportunity')
            ->andWhere('opportunity.relationshipReference = :relationshipReference')
            ->andWhere('opportunity.status IN (:activeStatuses)')
            ->setParameter('relationshipReference', $relationshipReference)
            ->setParameter('activeStatuses', [
                OpportunityStatus::Open->value,
                OpportunityStatus::Paused->value,
            ])
            ->orderBy('opportunity.updatedAt', 'DESC')
            ->getQuery()
            ->getResult();

        return array_values(array_filter($opportunities, static fn (mixed $item): bool => $item instanceof Opportunity));
    }

    private function persistAndFlush(Opportunity $opportunity): void
    {
        $this->entityManager->persist($opportunity);
        $this->entityManager->flush();
    }
}
