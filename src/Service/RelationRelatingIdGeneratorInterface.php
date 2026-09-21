<?php

declare(strict_types=1);

namespace App\Relating\Service;

interface RelationRelatingIdGeneratorInterface
{
    public function nextRelationshipId(): string;

    public function nextLeadId(): string;

    public function nextOpportunityId(): string;

    public function nextActivityId(): string;

    public function nextTimelineRecordId(): string;
}
