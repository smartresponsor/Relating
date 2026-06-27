<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Lead;
use App\Enum\LeadStatus;
use Doctrine\ORM\EntityManagerInterface;

final readonly class DoctrineLeadRepository implements LeadRepositoryInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {
    }

    public function rememberCaptured(Lead $lead): void
    {
        $this->persistAndFlush($lead);
    }

    public function rememberEnriched(Lead $lead): void
    {
        $this->persistAndFlush($lead);
    }

    public function rememberQualified(Lead $lead): void
    {
        $this->persistAndFlush($lead);
    }

    public function rememberRejected(Lead $lead): void
    {
        $this->persistAndFlush($lead);
    }

    public function rememberConverted(Lead $lead): void
    {
        $this->persistAndFlush($lead);
    }

    public function leadOf(string $leadReference): ?Lead
    {
        $lead = $this->entityManager->find(Lead::class, $leadReference);

        return $lead instanceof Lead ? $lead : null;
    }

    public function activeLeadsForRelationship(string $relationshipReference): array
    {
        $leads = $this->entityManager->getRepository(Lead::class)
            ->createQueryBuilder('lead')
            ->andWhere('lead.relationshipReference = :relationshipReference')
            ->andWhere('lead.status IN (:activeStatuses)')
            ->setParameter('relationshipReference', $relationshipReference)
            ->setParameter('activeStatuses', [
                LeadStatus::Captured->value,
                LeadStatus::Enriched->value,
                LeadStatus::Qualified->value,
            ])
            ->orderBy('lead.updatedAt', 'DESC')
            ->getQuery()
            ->getResult();

        return array_values(array_filter($leads, static fn (mixed $item): bool => $item instanceof Lead));
    }

    public function duplicateCandidatesForSignal(string $signalKind, string $signalValue): array
    {
        $field = match ($signalKind) {
            'email' => 'email',
            'phone' => 'phone',
            default => null,
        };

        if ($field === null || trim($signalValue) === '') {
            return [];
        }

        $leads = $this->entityManager->getRepository(Lead::class)
            ->createQueryBuilder('lead')
            ->andWhere(sprintf('lead.%s = :signalValue', $field))
            ->setParameter('signalValue', trim($signalValue))
            ->setMaxResults(25)
            ->getQuery()
            ->getResult();

        return array_values(array_filter($leads, static fn (mixed $item): bool => $item instanceof Lead));
    }

    private function persistAndFlush(Lead $lead): void
    {
        $this->entityManager->persist($lead);
        $this->entityManager->flush();
    }
}
