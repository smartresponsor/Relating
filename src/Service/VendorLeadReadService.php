<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Lead;
use App\Repository\RelationshipRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

final readonly class VendorLeadReadService implements VendorLeadReadServiceInterface
{
    public function __construct(
        private RelationshipRepositoryInterface $relationships,
        private EntityManagerInterface $entityManager,
    ) {
    }

    public function leadsForVendor(string $vendorReference): array
    {
        $vendorReference = trim($vendorReference);
        if ('' === $vendorReference) {
            return [];
        }

        $relationship = $this->relationships->relationshipForVendor($vendorReference);
        if (null === $relationship) {
            return [];
        }

        $leads = $this->entityManager->getRepository(Lead::class)->createQueryBuilder('lead')
            ->andWhere('lead.relationshipReference = :relationshipReference')
            ->setParameter('relationshipReference', $relationship->id())
            ->orderBy('lead.updatedAt', 'DESC')
            ->addOrderBy('lead.createdAt', 'DESC')
            ->getQuery()
            ->getResult();

        return array_values(array_filter($leads, static fn (mixed $lead): bool => $lead instanceof Lead));
    }
}
