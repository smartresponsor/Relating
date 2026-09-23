<?php

declare(strict_types=1);

namespace App\Relating\Repository;

use App\Relating\Entity\RelationLeadEntity;
use App\Relating\Enum\RelationLeadStatus;
use Doctrine\ORM\EntityManagerInterface;

final readonly class RelationDoctrineLeadRepository implements RelationLeadRepositoryInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {
    }

    public function rememberCaptured(RelationLeadEntity $lead): void
    {
        $this->persistAndFlush($lead);
    }

    public function rememberEnriched(RelationLeadEntity $lead): void
    {
        $this->persistAndFlush($lead);
    }

    public function rememberQualified(RelationLeadEntity $lead): void
    {
        $this->persistAndFlush($lead);
    }

    public function rememberRejected(RelationLeadEntity $lead): void
    {
        $this->persistAndFlush($lead);
    }

    public function rememberConverted(RelationLeadEntity $lead): void
    {
        $this->persistAndFlush($lead);
    }

    public function leadOf(string $leadReference): ?RelationLeadEntity
    {
        $lead = $this->entityManager->find(RelationLeadEntity::class, $leadReference);

        return $lead instanceof RelationLeadEntity ? $lead : null;
    }

    public function activeLeadsForRelationship(string $relationshipReference): array
    {
        $leads = $this->entityManager->getRepository(RelationLeadEntity::class)
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

        return array_values(array_filter($leads, static fn (mixed $item): bool => $item instanceof RelationLeadEntity));
    }

    public function leadsForRelationship(string $relationshipReference): array
    {
        $leads = $this->entityManager->getRepository(RelationLeadEntity::class)
            ->createQueryBuilder('lead')
            ->andWhere('lead.relationshipReference = :relationshipReference')
            ->setParameter('relationshipReference', $relationshipReference)
            ->orderBy('lead.updatedAt', 'DESC')
            ->addOrderBy('lead.createdAt', 'DESC')
            ->getQuery()
            ->getResult();

        return array_values(array_filter($leads, static fn (mixed $item): bool => $item instanceof RelationLeadEntity));
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

        $leads = $this->entityManager->getRepository(RelationLeadEntity::class)
            ->createQueryBuilder('lead')
            ->andWhere(\sprintf('lead.%s = :signalValue', $field))
            ->setParameter('signalValue', trim($signalValue))
            ->setMaxResults(25)
            ->getQuery()
            ->getResult();

        return array_values(array_filter($leads, static fn (mixed $item): bool => $item instanceof RelationLeadEntity));
    }

    private function persistAndFlush(RelationLeadEntity $lead): void
    {
        $this->entityManager->persist($lead);
        $this->entityManager->flush();
    }
}
