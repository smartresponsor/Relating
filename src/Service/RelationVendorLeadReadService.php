<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\Entity\RelationLead;
use App\Relating\Repository\RelationshipRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

final readonly class RelationVendorLeadReadService implements RelationVendorLeadReadServiceInterface
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

        $leads = $this->entityManager->getRepository(RelationLead::class)->createQueryBuilder('lead')
            ->andWhere('lead.relationshipReference = :relationshipReference')
            ->setParameter('relationshipReference', $relationship->id())
            ->orderBy('lead.updatedAt', 'DESC')
            ->addOrderBy('lead.createdAt', 'DESC')
            ->getQuery()
            ->getResult();

        return array_values(array_filter($leads, static fn (mixed $lead): bool => $lead instanceof RelationLead));
    }
}
