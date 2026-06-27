<?php

declare(strict_types=1);

namespace App\Tests;

use App\Entity\Lead;
use App\Entity\Opportunity;
use App\Entity\Relationship;
use App\Enum\ForecastCategory;
use App\Enum\LeadTemperature;
use App\Enum\RelationshipKind;
use PHPUnit\Framework\TestCase;

final class RelationshipSkeletonTest extends TestCase
{
    public function testRelationshipCanBeStarted(): void
    {
        $relationship = new Relationship('relationship_1', 'vendor_1', RelationshipKind::Prospect);

        self::assertSame('relationship_1', $relationship->id());
        self::assertSame('vendor_1', $relationship->vendorReference());
    }

    public function testLeadCanBeQualified(): void
    {
        $lead = new Lead('lead_1', ['source' => 'demo']);
        $lead->qualify(80, LeadTemperature::Hot);

        self::assertSame(80, $lead->score());
        self::assertSame('qualified', $lead->status());
    }

    public function testOpportunityCanMoveThroughBusinessStage(): void
    {
        $opportunity = new Opportunity('opportunity_1', 'relationship_1', 'pipeline_1', 'stage_discovery', 'Initial opportunity');
        $opportunity->moveToStage('stage_proposal', 55, ForecastCategory::BestCase);

        self::assertSame('relationship_1', $opportunity->relationshipReference());
    }
}
