<?php

declare(strict_types=1);

namespace App\Relating\Repository;

use App\Relating\Entity\RelationLead;
use App\Relating\Enum\RelationLeadStatus;
use Doctrine\ORM\EntityManagerInterface;

final readonly class RelationDoctrineLeadRepository implements RelationLeadRepositoryInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {
    }

    public function rememberCaptured(RelationLead $lead): void
    {
        $this->persistAndFlush($lead);
    }

    public function rememberEnriched(RelationLead $lead): void
    {
        $this->persistAndFlush($lead);
    }

    public function rememberQualified(RelationLead $lead): void
    {
        $this->persistAndFlush($lead);
    }

    public function rememberRejected(RelationLead $lead): void
    {
        $this->persistAndFlush($lead);
    }

    public function rememberConverted(RelationLead $lead): void
    {
        $this->persistAndFlush($lead);
    }

    public function leadOf(string $leadReference): ?RelationLead
    {
        $lead = $this->entityManager->find(RelationLead::class, $leadReference);

        return $lead instanceof RelationLead ? $lead : null;
    }

    public function activeLeadsForRelationship(string $relationshipReference): array
    {
        $leads = $this->entityManager->getRepository(RelationLead::class)
            ->createQueryBuilder('lead')
            ->andWhere('lead.relationshipReference = :relationshipReference')
            ->andWhere('lead.status IN (:activeStatuses)')
            ->setParameter('relationshipReference', $relationshipReference)
            ->setParameter('activeStatuses', [
                RelationLeadStatus::Captured->value,
                RelationLeadStatus::Enriched->value,
                RelationLeadStatus::Qualified->value,
            ])
            ->orderBy('lead.updatedAt', 'DESC')
            ->getQuery()
            ->getResult();

        return array_values(array_filter($leads, static fn (mixed $item): bool => $item instanceof RelationLead));
    }

    public function duplicateCandidatesForSignal(string $signalKind, string $signalValue): array
    {
        $field = match ($signalKind) {
            'email' => 'email',
            'phone' => 'phone',
            default => null,
        };

        if (null === $field || '' === trim($signalValue)) {
            return [];
        }

        $leads = $this->entityManager->getRepository(RelationLead::class)
            ->createQueryBuilder('lead')
            ->andWhere(\sprintf('lead.%s = :signalValue', $field))
            ->setParameter('signalValue', trim($signalValue))
            ->setMaxResults(25)
            ->getQuery()
            ->getResult();

        return array_values(array_filter($leads, static fn (mixed $item): bool => $item instanceof RelationLead));
    }

    private function persistAndFlush(RelationLead $lead): void
    {
        $this->entityManager->persist($lead);
        $this->entityManager->flush();
    }
}
